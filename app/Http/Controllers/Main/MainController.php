<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\PendaftaranRequest;
use App\Http\Requests\UlasanRequest;
use App\Models\Kedai;
use App\Models\Role;
use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class MainController extends Controller
{
    public function index()
    {
        $kedaiAcctive = Kedai::where('status', 1)->pluck('id_kedai');
        $ulasan = Ulasan::whereIn('id_kedai', $kedaiAcctive)->where('status', true)->get();
        $kedai = Kedai::take(4)->where('status', 1)->get();
        return view('main.mainpage.landing.index')->with([
            'kedai' => $kedai,
            'ulasan' => $ulasan
        ]);
    }

    public function detail($id)
    {
        $ulasan = Ulasan::where('id_kedai', $id)->where('status', true)->get();
        $kedai = Kedai::with('promo', 'produk')->find($id);

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
        $kedai = Kedai::where('status', 1)->get();
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

    public function register(PendaftaranRequest $request)
    {
        try {
            // dd($request->all());
            $role = Role::where('nama', 'Owner')->first();
            DB::transaction(function () use ($request, $role) {
                $user = [
                    'nama' => $request->nama,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'id_role' => $request->role,
                ];

                if($request->role == $role->id_role) {
                    // if role owner must be activated by admin
                    $user['is_active'] = false;
                } else {
                    $user['is_active'] = true;
                }

                if($request->hasFile('foto')) {
                    $filenamewithextension = $request->file('foto')->getClientOriginalName();
                    $extension = $request->file('foto')->getClientOriginalExtension();

                    $filenametostore = str_replace(' ', '', $request->nama) . '-' . time() . '.' . $extension;
                    $save_path = 'assets/uploads/users/';

                    if (!file_exists($save_path)) {
                        mkdir($save_path, 666, true);
                    }

                    $user['foto'] = $save_path . $filenametostore;
                }

                $img = Image::make($request->file('foto')->getRealPath());
                $img->resize(300, 300);
                $img->save($save_path . $filenametostore);

                // save user
                User::create($user);
            });
            if($request->role == $role->id_role) {
                return redirect()->back()->with([
                    'message' => 'Pendaftaran berhasil, silahkan menunggu konfirmasi dari admin',
                    'title' => 'Berhasil'
                ]);
            } else {
                return redirect()->back()->with([
                    'message' => 'Pendaftaran berhasil, silahkan login',
                    'title' => 'Berhasil'
                ]);
            }
            // return redirect()->back()->with([
            //     'message' => 'Pendaftaran berhasil',
            //     'status' => 'success',
            // ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Pendaftaran gagal',
                // 'message' => $e->getMessage(),
                'status' => 'error',
            ]);
            // return $e->getMessage();
            // return redirect()->route('main')->with('error', 'Pendaftaran gagal');
        }
    }
}
