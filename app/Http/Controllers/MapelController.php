<?php

namespace App\Http\Controllers;

use App\Mapel;
use App\Kelas;
use App\Materi;
use App\Guru;
use App\Siswa;
use Auth;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapel = Mapel::paginate(10);
        return view('mapel.index', compact('mapel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        $guru = Guru::all();
        return view('mapel.create', compact('kelas', 'guru'));
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
            'nama_mapel' => 'required|min:3|max:40',
            'kelas_id' => 'required',
            'guru_id' => 'required'
        ], $errors);

        $xmapel = Mapel::firstOrCreate([
            'nama_mapel' => $request->nama_mapel,
            'kelas_id' =>  $request->kelas_id,
            'guru_id' =>  $request->guru_id
        ]);

        if ($xmapel->wasRecentlyCreated) {
            return redirect('mapel')->with('success','Data Mata Pelajaran Telah Diinput !!');
        } else {
            return redirect('mapel/create')->with('error', 'Mata Pelajaran dan Guru Pengajar Sudah Ada!');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelas = Kelas::all();
        $guru = Guru::all();
        $mapel = Mapel::findOrFail($id);
        return view('mapel.edit', compact('mapel', 'kelas', 'guru'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mapel  $mapel
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
            'nama_mapel' => 'required|min:3|max:40',
            'kelas_id' => 'required',
            'guru_id' => 'required'
        ], $errors);

        $data_mapel = [
            'nama_mapel' => $request->nama_mapel,
            'kelas_id' =>  $request->kelas_id,
            'guru_id' =>  $request->guru_id
        ];

        Mapel::whereId($id)->update($data_mapel);

        return redirect()->route('mapel.index')->with('success','Data Mata Pelajaran Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mapel = Mapel::findorfail($id);
        $mapel->delete();

        return redirect()->back()->with('success','Mata Pelajaran Berhasil Dihapus');
    }

    // public function daftar_mapel()
    // {
    //     //Guru yang Login
    //     $guru = Guru::where('user_id', auth()->user()->id)->first();

    //     //Mata Pelajaran Yang Diajarkan Guru
    //     $mapels = Mapel::with('guru')->where('guru_id', $guru->id)->get();

    //     //Mata Pelajaran Sesuai kelasjj
    //     $kelas = Kelas::all();
    //     return view('mapel_guru.index', compact('mapels', 'kelas'));
    // }

    public function halaman_mapel_siswa()
    {
        // dd($request->all());
        $siswa = Siswa::where('user_id', auth()->user()->id)->firstOrFail();
        $materi = Materi::with('files')->paginate(10);
        return view('mapel_siswa.index', compact('materi', 'siswa'));
    }

    public function show_materi_siswa($id)
    {
        //
        $materi = Materi::findOrFail($id);
        return view('mapel_siswa.show', compact('materi'));
    }
}
