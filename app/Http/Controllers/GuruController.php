<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Mapel;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $guru = Guru::paginate(10);
        return view('guru.index', compact('guru', 'userLogin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        return view('guru.create', compact('userLogin'));
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
            'kode_guru' => 'required|max:12',
            'nama_guru' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'jk' => 'required',
            'agama' => 'required',
            'alamat' => 'required|min:8|max:100',
            'no_telp' => 'required|numeric',
        ], $errors);

        //insert ke table user
        $user = new \App\User;
        $user->level = 'guru';
        $user->name = $request->nama_guru;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = Str::random(60);
        $user->save();


        $request->request->add([ 'user_id' => $user->id ]);

        $guru = Guru::Create($request->all());

        if($request->hasfile('foto_profil')){
            $request->file('foto_profil')->move('images/', $request->file('foto_profil')->getClientOriginalName());
            $guru->foto_profil = $request->file('foto_profil')->getClientOriginalName();
            $guru->save();
        }

        return redirect('guru')->with('success','Data Guru Telah Diinput !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guru  $guru
     * @return \Illuminate\Http\Response
     */

    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $guru = Guru::findorfail($id);
        return view('guru.edit', compact('guru', 'userLogin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kode_guru' => 'required|max:12',
            'nama_guru' => 'required|min:3',
            'jk' => 'required',
            'agama' => 'required',
            'alamat' => 'required|min:8|max:100',
            'no_telp' => 'required|numeric'
        ]);

        $guru = Guru::find($id);

        $guru -> Update($request->all());
        if($request->hasfile('foto_profil')){
            $request->file('foto_profil')->move('images/', $request->file('foto_profil')->getClientOriginalName());
            $guru->foto_profil = $request->file('foto_profil')->getClientOriginalName();
            $guru->save();
        }

        return redirect()->route('guru.index')->with('success','Data Berhasil di Update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guru = Guru::findorfail($id);
        $guru->delete();

        return redirect()->back()->with('success','Data Guru Berhasil Dihapus');
    }

    public function profile($id){

        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $user = \App\User::all();
        $guru = Guru::find($id);
        $mapel = Mapel::all();
        return view('guru.profile', [
            'guru' => $guru,
            'mapel' => $mapel,
            'user' => $user,
            'userLogin' => $userLogin
        ]);
    }

    public function biodata_guru(){
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $guru = Guru::where('user_id', auth()->user()->id)->first();
        $user = \App\User::all();
        $mapel = Mapel::all();
        return view('guru.biodata', [
            'guru' => $guru,
            'mapel' => $mapel,
            'user' => $user,
            'userLogin' => $userLogin
        ]);
    }

    public function edit_biodata_guru(){
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $guru = Guru::where('user_id', auth()->user()->id)->first();
        return view('guru.edit_biodata_guru', compact('guru', 'userLogin'));
    }

    public function update_biodata_guru(Request $request, $id){
        //User yang sedang Login
        dd($request);
        $this->validate($request, [
            'kode_guru' => 'required|max:12',
            'nama_guru' => 'required|min:3',
            'jk' => 'required',
            'agama' => 'required',
            'alamat' => 'required|min:8|max:100',
            'no_telp' => 'required|numeric'
        ]);

        $guru = Guru::where('user_id', auth()->user()->id)->first();
        
        $guru = Guru::find($id);

        $guru -> Update($request->all());
        if($request->hasfile('foto_profil')){
            $request->file('foto_profil')->move('images/', $request->file('foto_profil')->getClientOriginalName());
            $guru->foto_profil = $request->file('foto_profil')->getClientOriginalName();
            $guru->save();
        }

        // return redirect('/biodata')->with('success','Biodata Anda Berhasil di Update');
    }
}
