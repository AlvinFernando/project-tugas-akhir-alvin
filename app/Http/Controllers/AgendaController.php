<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\User;
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
        $agenda = Agenda::with('users')->paginate(3);
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
        return view('agenda_guru.create', compact('userLogin'));
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
            'isi_agenda' => 'required'
        ], $errors);

        $agenda = Agenda::create([
            'judul' => $request->judul,
            'isi_agenda' =>  $request->isi_agenda,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('agenda')->with('success','Agenda Telah Diinput !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        //

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
        return view('agenda_guru.edit', compact('agenda', 'userLogin'));
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
            'isi_agenda' => 'required'
        ], $errors);

        $agenda = Agenda::findOrFail($id)->update([
            'judul' => $request->judul,
            'isi_agenda' =>  $request->isi_agenda,
            'kepsek' => Auth::user()->id,
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

    public function index_siswa()
    {
        //
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $agenda = Agenda::paginate(3);
        return view('agenda_siswa.index', compact('agenda', 'userLogin'));
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
