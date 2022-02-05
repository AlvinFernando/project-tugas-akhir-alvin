<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\Kelas;
use App\Guru;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::paginate(10);
        return view('siswa.index', compact('siswa'));
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
        return view('siswa.create', compact('kelas', 'guru'));
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
            'no_induk' => 'required|max:3',
            'nama_siswa' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users',
            'kelas_id' => 'required',
            'jk' => 'required',
            'agama' => 'required',
            'guru_id' => 'required',
            'alamat' => 'required|min:8|max:100',
            'no_telp' => 'required|numeric',
            'nama_ayah' => 'required|max:50',
            'nama_ibu' => 'required|max:50'
        ], $errors);

        //insert ke table user
        $user = new \App\User;
        $user->level = 'siswa';
        $user->name = $request->nama_siswa;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(60);
        $user->save();

        if($request->input('password')) {
            $password = Hash::make($request->password);
        }
        else{
            $password = bcrypt('siswa1234');
        }

        $request->request->add([ 'user_id' => $user->id ]);

        $siswa = Siswa::create($request->all());

        if($request->hasfile('foto_profil')){
            $request->file('foto_profil')->move('images/', $request->file('foto_profil')->getClientOriginalName());
            $siswa->foto_profil = $request->file('foto_profil')->getClientOriginalName();
            $siswa->save(); 
        }

        return redirect('siswa')->with('success','Data Siswa Telah Diinput !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::findorfail($id);
        $kelas = Kelas::all();
        $guru = Guru::all();
        return view('siswa.edit', compact('siswa', 'kelas', 'guru'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Siswa  $siswa
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
            'no_induk' => 'required|max:3',
            'nama_siswa' => 'required|min:3|max:50',
            'kelas_id' => 'required',
            'jk' => 'required',
            'agama' => 'required',
            'guru_id' => 'required',
            'alamat' => 'required|min:8|max:100',
            'no_telp' => 'required|numeric'
        ], $errors);

        $data_siswa =[
            'no_induk' => $request->no_induk,
            'nama_siswa' => $request->nama_siswa,
            'kelas_id' => $request->kelas_id,
            'jk' => $request->jk,
            'agama' => $request->agama,
            'guru_id' => $request->guru_id,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp
        ];

        Siswa::whereId($id)->update($data_siswa);

        return redirect()->route('siswa.index')->with('success','Data Siswa Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::findorfail($id);
        $siswa->delete();

        return redirect()->back()->with('success','Data Siswa Berhasil Dihapus');
    }
}
