<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Siswa;
use App\Kelas;
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
        $kelas = Kelas::all();
        $materi = Materi::where('users_id', Auth::user()->id);
        $pengumumans = Pengumuman::paginate(5);
        return view('dashboards.index', compact('guru', 'siswa', 'kelas', 'pengumumans', 'materi', 'userLogin'));
    }

    public function show($id)
    {
        //
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $pengumumans = Pengumuman::findOrFail($id);
        return view('dashboards.show_pengumuman', compact('pengumumans', 'userLogin'));
    }
}
