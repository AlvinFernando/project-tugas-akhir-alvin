<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Siswa;
use App\Mapel;
use App\Materi;
use App\Pengumuman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        $siswa = Siswa::all();
        $mapel = Mapel::all();
        $materi = Materi::all();
        $pengumuman = Pengumuman::paginate(5);
        return view('dashboards.index', compact('guru', 'siswa', 'mapel', 'pengumuman', 'materi'));
    }
}
