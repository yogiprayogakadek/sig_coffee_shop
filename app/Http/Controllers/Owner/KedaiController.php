<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\KedaiRequest;
use App\Models\Kedai;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Image;

class KedaiController extends Controller
{
    public function index()
    {
        return view('owner.kedai.index');
    }

    public function render()
    {
        if(auth()->user()->role->nama == 'Admin') {
            $kedai = Kedai::all();
        } else {
            $kedai = Kedai::where('id_user', auth()->user()->id_user)->get();
        }

        $view = [
            'data' => view('owner.kedai.render', compact('kedai'))->render()
        ];

        return response()->json($view);
    }

    public function create()
    {
        $role = Role::where('nama', 'Owner')->first();
        if(auth()->user()->role->nama == 'Admin') {
            $user = User::where('id_role', $role->id_role)->pluck('nama', 'id_user');
            $view = [
                'data' => view('owner.kedai.create', compact('user'))->render()
            ];
        } else {
            $view = [
                'data' => view('owner.kedai.create')->render()
            ];
        }

        return response()->json($view);
    }

    public function upload(Request $request)
    {
        try {
            $kedai = Kedai::where('id_kedai', $request->id_kedai)->first();

            if($kedai->suasana_kedai == null) {
                if($request->hasFile('photos')) {
                    for($i = 0; $i < count($request->file('photos')); $i++) {
                        //get filename with extension
                        $filenamewithextension = $request->file('photos')[$i]->getClientOriginalName();
        
                        //get file extension
                        $extension = $request->file('photos')[$i]->getClientOriginalExtension();
        
                        //filename to store
                        $filenametostore = $kedai->nama_kedai . '-' . ($i + 1) . '-' . time() . '.' . $extension;
                        $save_path = 'assets/uploads/media/kedai/suasana';
        
                        if (!file_exists($save_path)) {
                            mkdir($save_path, 666, true);
                        }
                        $foto[] = [
                            // [
                                'id' => ($i + 1),
                                'foto' => $save_path . '/' . $filenametostore,
                            // ]
                        ];
        
                        $img = Image::make($request->file('photos')[$i]->getRealPath());
                        $img->resize(512, 512);
                        $img->save($save_path . '/' . $filenametostore);
                    }
                    $newData = json_encode($foto);
                    // $data['foto'] = $newData;
                }
                $kedai->update([
                    'suasana_kedai' => $newData
                ]);
            } else {
                $foto = json_decode($kedai->suasana_kedai, true);
                if($request->hasFile('photos')) {
                    for($i = 0; $i < count($request->file('photos')); $i++) {
                        //get filename with extension
                        $filenamewithextension = $request->file('photos')[$i]->getClientOriginalName();
        
                        //get file extension
                        $extension = $request->file('photos')[$i]->getClientOriginalExtension();
        
                        //filename to store
                        $filenametostore = $kedai->nama_kedai . '-' . (($i + 1)+count($foto)) . '-' . time() . '.' . $extension;
                        $save_path = 'assets/uploads/media/kedai/suasana';
        
                        if (!file_exists($save_path)) {
                            mkdir($save_path, 666, true);
                        }

                        $foto[] = [
                            'id' => ($i + 1)+count($foto),
                            'foto' => $save_path . '/' . $filenametostore,
                        ];
        
                        $img = Image::make($request->file('photos')[$i]->getRealPath());
                        $img->resize(512, 512);
                        $img->save($save_path . '/' . $filenametostore);
                    }
                    $newData = json_encode($foto);
                }
                $kedai->update([
                    'suasana_kedai' => $newData
                ]);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil tersimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    public function store(KedaiRequest $request)
    {
        try {
            $data = [
                // 'id_user' => auth()->user()->id_user,
                'nama_kedai' => $request->nama_kedai,
                'alamat_kedai' => $request->alamat_kedai,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ];

            if(auth()->user()->role->nama == 'Admin') {
                $data['id_user'] = $request->owner;
            } else {
                $data['id_user'] = auth()->user()->id_user;
            }

            if ($request->hasFile('foto')) {
                //get filename with extension
                $filenamewithextension = $request->file('foto')->getClientOriginalName();

                //get file extension
                $extension = $request->file('foto')->getClientOriginalExtension();

                //filename to store
                $filenametostore = $request->nama_kedai . '-' . time() . '.' . $extension;
                $save_path = 'assets/uploads/media/kedai';

                if (!file_exists($save_path)) {
                    mkdir($save_path, 666, true);
                }
                
                $data['foto'] = $save_path . '/' . $filenametostore;

                $img = Image::make($request->file('foto')->getRealPath());
                $img->resize(600, 600);
                $img->save($save_path . '/' . $filenametostore);
            }

            $contentPath = public_path('assets/uploads/media/content');
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($request->deskripsi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
            libxml_clear_errors();
            $images = $dom->getElementsByTagName('img');
            foreach($images as $img) {
                $src = $img->getAttribute('src');
                if(preg_match('/data:image/', $src)) {
                    //get the mimetype
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimetype = $groups['mime'];

                    //Generating a random filename
                    $filename = uniqid();
                    $filepath = "/assets/uploads/media/content/$filename.$mimetype";

                    if(!file_exists($contentPath)) {
                        mkdir($contentPath, 666, true);
                    }

                    // @see http://image.intervention.io/api/
                    $image = Image::make($src)
                        // resize if required
                        ->resize(600, 600)
                        ->encode($mimetype, 100)  // encode file to the specified mimetype
                        ->save(public_path($filepath));
                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                    $img->setAttribute('class', 'img-responsive');
                }
            }
            $data['deskripsi'] = $dom->saveHTML();

            Kedai::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil tersimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    public function edit($id)
    {
        $role = Role::where('nama', 'Owner')->first();
        $kedai = Kedai::find($id);
        if(auth()->user()->role->nama == 'Admin') {
            $user = User::where('id_role', $role->id_role)->pluck('nama', 'id_user');
            $view = [
                'data' => view('owner.kedai.edit', compact('kedai', 'user'))->render()
            ];
            
        } else {
            // $kedai = Kedai::find($id);
            $view = [
                'data' => view('owner.kedai.edit', compact('kedai'))->render()
            ];
        }


        return response()->json($view);
    }

    public function update(KedaiRequest $request)
    {
        try {
            $kedai = Kedai::find($request->id_kedai);
            $data = [
                // 'id_user' => auth()->user()->id_user,
                'nama_kedai' => $request->nama_kedai,
                'alamat_kedai' => $request->alamat_kedai,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ];

            if(auth()->user()->role->nama == 'Admin') {
                $data['id_user'] = $request->owner;
            } else {
                $data['id_user'] = auth()->user()->id_user;
            }

            if ($request->hasFile('foto')) {
                unlink($kedai->foto);
                //get filename with extension
                $filenamewithextension = $request->file('foto')->getClientOriginalName();

                //get file extension
                $extension = $request->file('foto')->getClientOriginalExtension();

                //filename to store
                $filenametostore = $request->nama_kedai . '-' . time() . '.' . $extension;
                $save_path = 'assets/uploads/media/kedai';

                if (!file_exists($save_path)) {
                    mkdir($save_path, 666, true);
                }
                
                $data['foto'] = $save_path . '/' . $filenametostore;

                $img = Image::make($request->file('foto')->getRealPath());
                $img->resize(600, 600);
                $img->save($save_path . '/' . $filenametostore);
            }

            $contentPath = public_path('assets/uploads/media/content');
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($request->deskripsi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
            libxml_clear_errors();
            $images = $dom->getElementsByTagName('img');
            foreach($images as $img) {
                $src = $img->getAttribute('src');
                if(preg_match('/data:image/', $src)) {
                    //get the mimetype
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimetype = $groups['mime'];

                    //Generating a random filename
                    $filename = uniqid();
                    $filepath = "/assets/uploads/media/content/$filename.$mimetype";

                    // @see http://image.intervention.io/api/
                    $image = Image::make($src)
                        // resize if required
                        ->resize(600, 600)
                        ->encode($mimetype, 100)  // encode file to the specified mimetype
                        ->save(public_path($filepath));
                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                    $img->setAttribute('class', 'img-responsive');
                }
            }
            $data['deskripsi'] = $dom->saveHTML();

            $kedai->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil tersimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $kedai = Kedai::find($id);
            $kedai->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            // dd($request->all());
            $status = $request->status;
            $id_kedai = $request->id_kedai;
            // dd($id_produk);
            $kedai = Kedai::find($id_kedai);
            $kedai->update([
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

    public function detail($id)
    {
        $data = array();
        $kedai = Kedai::find($id);

        foreach(json_decode($kedai->suasana_kedai) as $value) {
            $data[] =[
                'id' => $value->id,
                'foto' => $value->foto
            ];
        }
        return response()->json($data);
    }

    public function deleteImage($id_kedai, $id_foto)
    {
        try {
            $kedai = Kedai::find($id_kedai);
            foreach(json_decode($kedai->suasana_kedai) as $value) {
                if($value->id == $id_foto) {
                    unlink($value->foto);
                    $kedai->suasana_kedai = json_decode($kedai->suasana_kedai);
                    $kedai->suasana_kedai = json_encode(array_values(array_filter($kedai->suasana_kedai, function($value) use ($id_foto) {
                        return $value->id != $id_foto;
                    })));
                    $kedai->save();
                }
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }
}
