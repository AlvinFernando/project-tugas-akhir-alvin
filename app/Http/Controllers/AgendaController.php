<?php

namespace App\Http\Controllers;

use App\Agenda;
use Auth;
use Illuminate\Http\Request;

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
        $agenda = Agenda::paginate(3);
        return view('agenda_guru.index', compact('agenda'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('agenda_guru.create');
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
            'user_id' => Auth::id()
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
        $agenda = Agenda::findOrFail($id);
        return view('agenda_guru.edit', compact('agenda'));
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
            'kepsek' => Auth::id()
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
        $agenda = Agenda::paginate(3);
        return view('agenda_siswa.index', compact('agenda'));
    }

    public function show_siswa($id)
    {
        //
        $agenda = Agenda::findOrFail($id);
        return view('agenda_siswa.show', compact('agenda'));
    }
}
