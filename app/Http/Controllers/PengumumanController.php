<?php

namespace App\Http\Controllers;

use App\Pengumuman;
use App\User;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $pengumuman = Pengumuman::paginate(10);
        return view('pengumuman.index', compact('pengumuman', 'userLogin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        return view('pengumuman.create', 'userLogin');
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
            'judul' => 'required|max:70',
            'isi_pengumuman' => 'required',
            'kepsek' => 'required'
        ], $errors);

        $pengumuman = Pengumuman::create([
            'judul' => $request->judul,
            'isi_pengumuman' =>  $request->isi_pengumuman,
            'kepsek' =>  $request->kepsek
        ]);

        return redirect('pengumuman')->with('success','Data Mata Pelajaran Telah Diinput !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $pengumuman = Pengumuman::findOrFail($id);
        return view('pengumuman.show', compact('pengumuman', 'userLogin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $pengumuman = Pengumuman::findOrFail($id);
        return view('pengumuman.edit', compact('pengumuman', 'userLogin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $errors = [
            'required' => ':attribute wajib diisi !',
            'min' => ':attribute harus diisi dengan minimal :min karakter !',
            'max' => ':attribute harus diisi dengan maksimal :max karakter !',
            'numeric' => ':attribute harus diisi angka saja !',
        ];

        $this->validate($request, [
            'judul' => 'required|max:70',
            'isi_pengumuman' => 'required',
            'kepsek' => 'required'
        ], $errors);

        $pengumuman = Pengumuman::findOrFail($id)->update([
            'judul' => $request->judul,
            'isi_pengumuman' =>  $request->isi_pengumuman,
            'kepsek' =>  $request->kepsek
        ]);

        return redirect('pengumuman')->with('success','Pengumuman telah Diupdate !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengumuman = Pengumuman::findorfail($id);
        $pengumuman->delete();

        return redirect()->back()->with('success','Pengumuman Berhasil Dihapus');
    }
}
