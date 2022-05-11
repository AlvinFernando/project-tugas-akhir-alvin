<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\Kelas;
use App\Guru;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $siswa = Siswa::paginate(5);
        return view('siswa.index', compact('siswa', 'userLogin'));
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
        $kelas = Kelas::all();
        $guru = Guru::all();
        return view('siswa.create', compact('kelas', 'guru', 'userLogin'));
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
        $user->password = bcrypt($request->password);
        $user->remember_token = Str::random(60);
        $user->save();

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
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $siswa = Siswa::findorfail($id);
        $kelas = Kelas::all();
        $guru = Guru::all();
        return view('siswa.edit', compact('siswa', 'kelas', 'guru', 'userLogin'));
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

        $siswa = Guru::find($id);

        $siswa -> Update($request->all());
        if($request->hasfile('foto_profil')){
            $request->file('foto_profil')->move('images/', $request->file('foto_profil')->getClientOriginalName());
            $siswa->foto_profil = $request->file('foto_profil')->getClientOriginalName();
            $siswa->save();
        }

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

    public function profile($id){

        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $user = \App\User::all();
        $siswa = Siswa::find($id);
        return view('siswa.profile', [
            'siswa' => $siswa,
            'user' => $user,
            'userLogin' => $userLogin
        ]);
    }

    public function biodata_siswas(){
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $siswa = Siswa::where('user_id', auth()->user()->id)->first();
        $user = Auth::user()->siswa;
        return view('siswa.biodata', [
            'siswa' => $siswa,
            'user' => $user,
            'userLogin' => $userLogin
        ]);
    }

    public function edit_biodata_siswas(){
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        // $guru = Guru::where('user_id', auth()->user()->id)->first();
        $siswa = Siswa::where('user_id', auth()->user()->id)->first();
        $kelas = Kelas::all();
        $guru = Guru::all();
        $user = User::find(Auth::id());
        return view('siswa.edit_biodata_siswa', compact('siswa', 'userLogin', 'kelas', 'guru', 'user'));
    }

    public function update_biodata_siswas(Request $request, User $user){
        //User yang sedang Login
        // dd();

        $this->validate($request, [
            'no_induk' => 'required|max:3',
            'nama_siswa' => 'required|min:3',
            'kelas_id' => 'required',
            'jk' => 'required',
            'agama' => 'required',
            'alamat' => 'required|min:8|max:100',
            'no_telp' => 'required|numeric'
        ]);

        $user->update([
            $user->password = bcrypt($request->password)
        ]);

        $siswa = Siswa::where('user_id', auth()->user()->id)->first();

        // $siswa -> update([
        //     'no_induk' => $request->no_induk,
        //     'nama_siswa' => $request->nama_siswa,
        //     'kelas_id' => $request->kelas_id,
        //     'jk' => $request->jk,
        //     'agama' => $request->agama,
        //     'alamat' => $request->alamat,
        //     'no_telp' => $request->no_telp,
        //     'nama_ayah' => $request->nama_ayah,
        //     'nama_ibu' => $request->nama_ibu,
        //     'nama_wali' => $request->nama_wali,
        // ]);
        $siswa -> update($request->all());

        if($request->hasfile('foto_profil')){
            $request->file('foto_profil')->move('images/', $request->file('foto_profil')->getClientOriginalName());
            $siswa->foto_profil = $request->file('foto_profil')->getClientOriginalName();
            $siswa->save();
        }

        return back()->with('success','Biodata Anda Berhasil di Update');
    }


}
