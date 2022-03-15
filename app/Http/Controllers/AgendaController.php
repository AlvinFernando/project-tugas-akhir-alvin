<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\User;
use App\Kelas;
use App\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
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
        $agenda = Agenda::with('users')->paginate(10);
        return view('agenda_guru.index', compact('agenda', 'userLogin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $kelas = Kelas::all();
        return view('agenda_guru.create', compact('userLogin', 'kelas'));
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

        $errors = [
            'required' => ':attribute wajib diisi !',
            'min' => ':attribute harus diisi dengan minimal :min karakter !',
            'max' => ':attribute harus diisi dengan maksimal :max karakter !',
            'numeric' => ':attribute harus diisi angka saja !',
        ];

        $this->validate($request, [
            'judul' => 'required|max:70',
            'isi_agenda' => 'required',
            'kelas_id' => 'required',
        ], $errors);

        Agenda::create([
            'judul' => $request->judul,
            'isi_agenda' =>  $request->isi_agenda,
            'kelas_id' =>  $request->kelas_id,
            'users_id' => Auth::id(),
        ]);

        return redirect('agenda')->with('success','Agenda Telah Diinput !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $agenda = Agenda::findOrFail($id);
        $kelas = Kelas::all();
        return view('agenda_guru.show', compact('agenda', 'userLogin', 'kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $agenda = Agenda::findOrFail($id);
        $kelas = Kelas::all();
        return view('agenda_guru.edit', compact('agenda', 'userLogin', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $errors = [
            'required' => ':attribute wajib diisi !',
            'min' => ':attribute harus diisi dengan minimal :min karakter !',
            'max' => ':attribute harus diisi dengan maksimal :max karakter !',
            'numeric' => ':attribute harus diisi angka saja !',
        ];

        $this->validate($request, [
            'judul' => 'required',
            'isi_agenda' => 'required',
            'kelas_id' => 'required'
        ], $errors);

        Agenda::findOrFail($id)->update([
            'judul' => $request->judul,
            'isi_agenda' =>  $request->isi_agenda,
            'kelas_id' =>  $request->kelas_id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('agenda')->with('success','agenda telah Diupdate !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $agenda = Agenda::findorfail($id);
        $agenda->delete();

        return redirect()->back()->with('success','agenda Berhasil Dihapus');
    }

    /* ===================================================================================  */

    public function index_siswa()
    {
        //
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $siswa = Siswa::where('user_id', auth()->user()->id)->first();
        $agenda = Agenda::with('kelas')->where('kelas_id', $siswa->kelas_id)->paginate(5);
        $kelas = Kelas::all();
        return view('agenda_siswa.index', compact('agenda', 'userLogin', 'siswa', 'kelas'));
    }

    public function show_siswa($id)
    {
        //
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $agenda = Agenda::findOrFail($id);
        return view('agenda_siswa.show', compact('agenda', 'userLogin'));
    }
}
