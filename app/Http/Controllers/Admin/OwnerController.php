<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index()
    {
        return view('admin.owner.index');
    }

    public function render()
    {
        $role = Role::where('nama', 'Owner')->first();
        $owner = User::where('id_role', $role->id_role)->get();
        $view = [
            'data' => view('admin.owner.render', compact('owner'))->render()
        ];

        return response()->json($view);
    }

    public function delete($id)
    {
        try{
            $owner = User::find($id);
            if($owner->foto != 'assets/uploads/users/default.png') {
                unlink($owner->foto);
            }
            $owner->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menghapus owner',
                'title' => 'Berhasil'
            ]);
        } catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus owner',
                'title' => 'Gagal'
            ]);
        }
    }

    public function print()
    {
        $owner = User::where('is_admin', false)->get();
        $view = [
            'data' => view('admin.owner.print', compact('pelanggan'))->render()
        ];

        return response()->json($view);
    }
}

