<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TahunAjaran;
use App\User;

class TahunAjaranController extends Controller
{
    public function index()
    {
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $tahun_ajaran = TahunAjaran::paginate(5);
        return view('tahun_ajaran.index', compact('tahun_ajaran', 'userLogin'));
    }

    public function input(Request $request)
    {
        $this->validate($request, [
            'thn_ajaran' => 'required'
        ]);


        $tahun_ajaran = TahunAjaran::create([
            'thn_ajaran' => $request->thn_ajaran
        ]);

        return redirect()->back()->with('success','Tahun Ajaran Berhasil Dimasukkan !!');
    }


    public function hapus($id)
    {
        $tahun_ajaran = TahunAjaran::findorfail($id);
        $tahun_ajaran->delete();

        return redirect()->back()->with('success','Tahun Ajaran Berhasil Dihapus');
    }


}
