<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\UlasanRequest;
use App\Models\Kedai;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $ulasan = Ulasan::all();
        $kedai = Kedai::take(4)->get();
        return view('main.mainpage.landing.index')->with([
            'kedai' => $kedai,
            'ulasan' => $ulasan
        ]);
    }

    public function detail($id)
    {
        $ulasan = Ulasan::where('id_kedai', $id)->get();
        $kedai = Kedai::find($id);

        if(auth()->check()) {
            $userHasFeedback = Ulasan::where('id_user', auth()->user()->id_user)->where('id_kedai', $id)->count();
            return view('main.mainpage.single-post.index')->with([
                'kedai' => $kedai,
                'ulasan' => $ulasan,
                'userHasFeedback' => $userHasFeedback
            ]);
        } else {
            return view('main.mainpage.single-post.index')->with([
                'kedai' => $kedai,
                'ulasan' => $ulasan
            ]);
        }

    }

    public function ulasan(UlasanRequest $request)
    {
        if($request->ajax()){
            try {
                $id_kedai = $request->id_kedai;
                $ulasan = $request->feedback;

                Ulasan::create([
                    'id_kedai' => $id_kedai,
                    'ulasan' => $ulasan,
                    'id_user' => auth()->user()->id_user
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Ulasan berhasil dikirim',
                    'title' => 'Berhasil'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                    'title' => 'Gagal'
                ]);
            }
        } else {
            return abort(403);
        }
    }

    public function search()
    {
        $kedai = Kedai::all();
        // dd($kedai);
        return view('main.mainpage.search.index')->with([
            'kedai' => $kedai
        ]);
    }

    public function searchKeyword($keyword)
    {
        $kedai = Kedai::where('nama_kedai', $keyword)->first();
        // dd($kedai);
        return response()->json($kedai);
    }
}
