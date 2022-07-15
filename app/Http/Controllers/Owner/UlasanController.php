<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Kedai;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function index()
    {
        return view('owner.ulasan.index');
    }

    public function render()
    {
        if(auth()->user()->role->nama == 'Admin') {
            $ulasan = Ulasan::all();
        } else {
            $kedai = Kedai::where('id_user', auth()->user()->id_user)->pluck('id_kedai');
            $ulasan = Ulasan::whereIn('id_kedai', $kedai)->get();
        }

        $view = [
            'data' => view('owner.ulasan.render')->with([
                'data' => $ulasan
            ])->render()
        ];

        return response()->json($view);
    }

    public function changeStatus(Request $request)
    {
        try {
            $status = $request->status;
            $ulasan = $request->ulasan;
            $ulasan = Ulasan::find($request->id_ulasan);
            $ulasan->update([
                'status' => $status
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Status berhasil di ubah',
                'title' => 'Berhasil'
            ]);
        } catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Status gagal di ubah',
                'title' => 'Gagal'
            ]);
        }
    }
}
