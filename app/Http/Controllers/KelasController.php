<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\TahunAjaran;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::paginate(10);
        return view('kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahun_ajaran = TahunAjaran::all();
        return view('kelas.create', compact('tahun_ajaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $errors = [
            'required' => ':attribute wajib diisi !',
            'min' => ':attribute harus diisi dengan minimal :min karakter !',
            'max' => ':attribute harus diisi dengan maksimal :max karakter !',
            'numeric' => ':attribute harus diisi angka saja !',
        ];

        $this->validate($request, [
            'nama_kelas' => 'required|max:6',
            'tahun_ajaran_id' => 'required'
        ], $errors);

        Toastr::success('Data Kelas Telah Diinput !!', 'success');

        $kelas = Kelas::firstOrCreate([
            'nama_kelas' => $request->nama_kelas,
            'tahun_ajaran_id' =>  $request->tahun_ajaran_id
        ]);

        if ($kelas->wasRecentlyCreated) {
            return redirect('kelas')->with('success','Data Kelas Telah Diinput !!');
        } else {
            return redirect('kelas/create')->with('error', 'Data Kelas Sudah Ada!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::findorfail($id);
        $kelas->delete();

        return redirect()->back()->with('success','Kelas Berhasil Dihapus');
    }
}
