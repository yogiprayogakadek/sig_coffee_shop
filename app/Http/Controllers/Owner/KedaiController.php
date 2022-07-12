<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\KedaiRequest;
use App\Models\Kedai;
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
        $view = [
            'data' => view('owner.kedai.create')->render()
        ];

        return response()->json($view);
    }

    public function store(KedaiRequest $request)
    {
        try {
            $data = [
                'id_user' => auth()->user()->id_user,
                'nama_kedai' => $request->nama_kedai,
                'alamat_kedai' => $request->alamat_kedai,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ];

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
        $kedai = Kedai::find($id);
        $view = [
            'data' => view('owner.kedai.edit', compact('kedai'))->render()
        ];

        return response()->json($view);
    }

    public function update(KedaiRequest $request)
    {
        try {
            $kedai = Kedai::find($request->id_kedai);
            $data = [
                'id_user' => auth()->user()->id_user,
                'nama_kedai' => $request->nama_kedai,
                'alamat_kedai' => $request->alamat_kedai,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ];

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
}
