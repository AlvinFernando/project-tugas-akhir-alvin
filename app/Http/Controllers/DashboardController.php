<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Siswa;
use App\Mapel;
use App\Materi;
use App\Pengumuman;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $guru = Guru::all();
        $siswa = Siswa::all();
        $mapel = Mapel::all();
        $materi = Materi::all();
        $pengumuman = Pengumuman::paginate(5);
        return view('dashboards.index', compact('guru', 'siswa', 'mapel', 'pengumuman', 'materi', 'userLogin'));
    }
}
