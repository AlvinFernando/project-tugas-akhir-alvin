<?php

namespace App\Http\Controllers;

use App\TugasSiswa;
use App\User;
use Illuminate\Http\Request;
use App\Mapel;
use App\Guru;
use App\Kelas;
use Illuminate\Support\Facades\Auth;

class TugasSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $tugas_siswa = TugasSiswa::paginate(10);

        return view('tugas_siswa.index', compact('tugas_siswa', 'userLogin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $guru = Guru::where('user_id', auth()->user()->id)->first();
        $kelas = Kelas::all();
        $mapels = Mapel::with('guru')->where('guru_id', $guru->id)->get();
        return view('tugas_siswa.create', compact('userLogin', 'guru', 'kelas', 'mapels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request->all());
        $errors = [
            'required' => ':attribute wajib diisi !',
            'min' => ':attribute harus diisi dengan minimal :min karakter !',
            'max' => ':attribute harus diisi dengan maksimal :max karakter !',
            'numeric' => ':attribute harus diisi angka saja !',
        ];

        $this->validate($request, [
            'judul' => 'required|max:100',
            'mapel_id' => 'required',
            'isi_tugas' => 'required',
            // 'file_tugas.*' => 'required|mimes:doc,docx,PDF,xlsx,pdf,jpg,jpeg,png|max:2000',
            'kelas_id' => 'required'
        ], $errors);

        TugasSiswa::Create([
            'judul' => $request->judul,
            'mapel_id' =>  $request->mapel_id,
            'isi_tugas' =>  $request->isi_tugas,
            'kelas_id' =>  $request->kelas_id,
            'users_id' => Auth::id()
        ]);

        return redirect('tugas_siswa')->with('success','tugas berhasil Diupload !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TugasSiswa  $tugasSiswa
     * @return \Illuminate\Http\Response
     */
    public function show(TugasSiswa $tugasSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TugasSiswa  $tugasSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(TugasSiswa $tugasSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TugasSiswa  $tugasSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TugasSiswa $tugasSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TugasSiswa  $tugasSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(TugasSiswa $tugasSiswa)
    {
        //
    }
}
