<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TahunAjaran;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahun_ajaran = TahunAjaran::paginate(5);
        return view('tahun_ajaran.index', compact('tahun_ajaran'));
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
