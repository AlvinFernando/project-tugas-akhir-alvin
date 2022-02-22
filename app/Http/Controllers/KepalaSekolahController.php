<?php

namespace App\Http\Controllers;

use App\KepalaSekolah;
use App\User;
use Illuminate\Http\Request;

class KepalaSekolahController extends Controller
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
        $kepsek = KepalaSekolah::paginate(5);
        return view('kepsek.index', compact('kepsek', 'userLogin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KepalaSekolah  $kepalaSekolah
     * @return \Illuminate\Http\Response
     */
    public function show(KepalaSekolah $kepalaSekolah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KepalaSekolah  $kepalaSekolah
     * @return \Illuminate\Http\Response
     */
    public function edit(KepalaSekolah $kepalaSekolah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KepalaSekolah  $kepalaSekolah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KepalaSekolah $kepalaSekolah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KepalaSekolah  $kepalaSekolah
     * @return \Illuminate\Http\Response
     */
    public function destroy(KepalaSekolah $kepalaSekolah)
    {
        //
    }
}
