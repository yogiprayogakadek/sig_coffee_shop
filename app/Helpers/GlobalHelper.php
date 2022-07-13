<?php

use App\Models\Kedai;
use App\Models\Maintenance;
use App\Models\MaintenanceHistori;
use App\Models\Pengadaan;
use App\Models\PengadaanHistori;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

function randomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function convertDate($date, $printDate = false)
{
    //explode / pecah tanggal berdasarkan tanda "-"
    $exp = explode("-", $date);

    $day = array(
        1 =>    'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );

    $month = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    // return $exp[2] . ' ' . $month[(int)$exp[1]] . ' ' . $exp[0];

    $split       = explode('-', $date);
    $convertDate = $split[2] . ' ' . $month[(int)$split[1]] . ' ' . $split[0];

    if ($printDate) {
        $num = date('N', strtotime($date));
        return $day[$num] . ', ' . $convertDate;
    }
    return $convertDate;
}

function convertToRupiah($jumlah)
{
    return 'Rp' . number_format($jumlah, 0, '.', '.');
}

function fotoAkun()
{
    return asset(auth()->user()->foto);
}

function nama()
{
    return auth()->user()->nama;
}

function subtractingDate($date1, $date2)
{
    $datetime1 = strtotime($date1);
    $datetime2 = strtotime($date2);

    $secs = $datetime2 - $datetime1;// == <seconds between the two times>
    $days = $secs / 86400;
    return $days;
}


function menu()
{
    $menu = [
        'Kedai', 'Produk', 'Promo'
    ];

    if(auth()->user()->role->nama == 'Admin') {
        $menu[] = 'Owner';
    }

    return $menu;
}

function RouteURL()
{
    $url = [
        0 => 'owner.kedai.index', 
        1 => 'owner.produk.index', 
        2 => 'owner.promo.index',
    ];

    if(auth()->user()->role->nama == 'Admin') {
        $url[] =  'admin.owner.index';
    }

    return $url;
}

function totalData($model)
{
    $a = 'App\Models\\' . $model;
    // if($model == 'Perbaikan'){
    //     $total = Maintenance::where('kategori_maintenance', 'Perawatan dan Perbaikan')->count();
    // }
    // elseif($model == 'Kerusakan'){
    //     $total = Maintenance::where('kategori_maintenance', 'Kerusakan')->count();
    // }
    // else{
    //     $total = $a::count();
    // }

    if($model == 'Owner'){
        $role = Role::where('nama', 'Owner')->first();
        $total = User::where('id_role', $role->id_role)->count();
    }
    else{
        if(auth()->user()->role->nama == 'Admin'){
            $total = $a::count();
        }
        else{
            if($model == 'Kedai') {
                $total = $a::where('id_user', auth()->user()->id_user)->count();
            } else {
                $kedai = Kedai::where('id_user', auth()->user()->id_user)->get();
                $total = $a::whereIn('id_kedai', $kedai->pluck('id_kedai'))->count();
            }
        }
        // $total = $a::count();
    }

    return $total;
}

function bulan()
{
    $bulan = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];

    return $bulan;
}