<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromoRequest;
use App\Models\Kedai;
use App\Models\Promo;
use Illuminate\Http\Request;
use Image;

class PromoController extends Controller
{
    public function index()
    {
        return view('owner.promo.index');
    }

    public function render()
    {
        $data = Promo::all();

        $view = [
            'data' => view('owner.promo.render', compact('data'))->render()
        ];

        return response()->json($view);
    }

    public function print()
    {
        $data = Promo::all();

        $view = [
            'data' => view('owner.promo.print', compact('data'))->render()
        ];

        return response()->json($view);
    }

    public function create()
    {
        $data = Kedai::pluck('nama_kedai', 'id_kedai')->prepend('Pilih Kedai', '');
        $view = [
            'data' => view('owner.promo.create', compact('data'))->render()
        ];

        return response()->json($view);
    }

    public function store(PromoRequest $request)
    {
        try {
            $data = [
                'nama_promo' => $request->nama,
                'id_kedai' => $request->id_kedai,
                'potongan' => $request->potongan
            ];

            if($request->hasFile('foto')) {
                $filenamewithextension = $request->file('foto')->getClientOriginalName();

                //get file extension
                $extension = $request->file('foto')->getClientOriginalExtension();

                //filename to store
                $filenametostore = $request->nama . '-' . time() . '.' . $extension;
                $save_path = 'assets/uploads/media/promo';

                if (!file_exists($save_path)) {
                    mkdir($save_path, 666, true);
                }

                $img = Image::make($request->file('foto')->getRealPath());
                $img->resize(410, 410);
                $img->save($save_path . '/' . $filenametostore);
                $data['foto'] = $save_path . '/' . $filenametostore;
            }

            if($request->has('deskripsi')) {
                $contentPath = public_path('assets/uploads/media/promo/deskripsi/');
                if (!file_exists($contentPath)) {
                    mkdir($contentPath, 666, true);
                }
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
                        $filepath = "/assets/uploads/media/promo/deskripsi/$filename.$mimetype";
        
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
            }

            Promo::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil tersimpan',
                'title' => 'Berhasil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => 'Data gagal tersimpan',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    public function edit($id)
    {
        $data = Promo::find($id);
        $kedai = Kedai::pluck('nama_kedai', 'id_kedai')->prepend('Pilih Kedai', '');
        $view = [
            'data' => view('owner.promo.edit', compact('data', 'kedai'))->render()
        ];

        return response()->json($view);
    }

    public function detail($id)
    {
        $data = Promo::find($id);
        return response()->json($data);
    }

    public function update(PromoRequest $request)
    {
        try {
            $promo = Promo::find($request->id_promo);
            $data = [
                'nama_promo' => $request->nama,
                'id_kedai' => $request->id_kedai,
                'potongan' => $request->potongan,
                // 'deskripsi' => $request->deskripsi,
            ];

            if($request->hasFile('foto')) {
                unlink($promo->foto);
                $filenamewithextension = $request->file('foto')->getClientOriginalName();

                //get file extension
                $extension = $request->file('foto')->getClientOriginalExtension();

                //filename to store
                $filenametostore = $request->nama . '-' . time() . '.' . $extension;
                $save_path = 'assets/uploads/media/promo';

                if (!file_exists($save_path)) {
                    mkdir($save_path, 666, true);
                }

                $img = Image::make($request->file('foto')->getRealPath());
                $img->resize(410, 410);
                $img->save($save_path . '/' . $filenametostore);
                $data['foto'] = $save_path . '/' . $filenametostore;
            }

            if($request->has('deskripsi')) {
                $contentPath = public_path('assets/uploads/media/promo/deskripsi/');
                if (!file_exists($contentPath)) {
                    mkdir($contentPath, 666, true);
                }
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
                        $filepath = "/assets/uploads/media/promo/deskripsi/$filename.$mimetype";
        
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
            }

            $promo->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diperbarui',
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


    public function delete(Request $request)
    {
        try {
            $promo = Promo::find($request->id);
            unlink($promo->foto);
            $promo->delete();

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
