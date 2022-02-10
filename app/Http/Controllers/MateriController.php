<?php

namespace App\Http\Controllers;

use App\FileUpload;
use App\Materi;
use App\Mapel;
use App\Guru;
use App\Kelas;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materi = Materi::where('users_id', Auth::user()->id)->with('files')->paginate(10);
        // //Guru yang Login
        // $guru = Guru::where('user_id', auth()->user()->id)->first();

        // //Mata Pelajaran Yang Diajarkan Guru
        // $mapels = Mapel::with('guru')->where('guru_id', $guru->id)->get();

        // $materi = Materi::findorFail($id)->with('mapel')->where('mapel_id', $mapels->id)->get();

        // //Mata Pelajaran Sesuai kelasjj
        // $kelas = Kelas::all();


        return view('materi.index', compact('materi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guru = Guru::where('user_id', auth()->user()->id)->first();
        $mapels = Mapel::with('guru')->where('guru_id', $guru->id)->get();
        $kelas = Kelas::all();
        return view('materi.create', compact('kelas', 'guru', 'mapels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $errors = [
            'required' => ':attribute wajib diisi !',
            'min' => ':attribute harus diisi dengan minimal :min karakter !',
            'max' => ':attribute harus diisi dengan maksimal :max karakter !',
            'numeric' => ':attribute harus diisi angka saja !',
        ];

        $this->validate($request, [
            'judul_materi' => 'required|max:100',
            'mapel_id' => 'required',
            'isi_materi' => 'required',
            'file_materi.*' => 'required|mimes:doc,docx,PDF,xlsx,pdf,jpg,jpeg,png|max:2000',
            'kelas_id' => 'required'
        ], $errors);

        $materi = Materi::Create([
            'judul_materi' => $request->judul_materi,
            'mapel_id' =>  $request->mapel_id,
            'isi_materi' =>  $request->isi_materi,
            'kelas_id' =>  $request->kelas_id,
            'users_id' => Auth::id()
        ]);


        if ($request->hasFile('file_materi')) {
            foreach ($request->file_materi as $file) {
                // $allFiles = collect();

                // foreach ($request->file('file_materi') as $file ) {
                //     $file_exs = $file->getClientOriginalExtension();

                //     $file_baru = rand(123456, 999999). "." .$file_exs;

                //     $destination_path = public_path('/file_materi_baru');

                //     // $new_materi = time().$file->getClientOriginalName();
                //     $file->move($destination_path, $file_baru);
                //     $allFiles->push($file_baru);
                // }
                // Materi::where('id', $materi->id)->update(['file_materi'=> $allFiles]);

                //nama file original
                $name = $file->getClientOriginalName();

                //buat folder file_mater0_baru
                $targetDir = 'file_materi_baru/';
                $url = $targetDir . $name;

                $file->storeAs($targetDir, $name, 'public');

                FileUpload::create([
                    'url'=>$url,
                    'file'=>$name,
                    'materi_id' => $materi->id,
                ]);
           }
        }

        if ($materi) {
            return redirect('materi')->with('success','Materi berhasil Diupload !!');
        }else{
            return redirect('materi')->with('error', 'Materi Sudah Ada!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $materi = Materi::findOrFail($id);
        return view('materi.show', compact('materi'));
    }

    public function download($fileId){
        $entry = Materi::where('file_id', '=', $fileId)->firstOrFail();
        $pathToFile = storage_path()."file_materi_baru/".$entry->name;
        return response()->download($pathToFile);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $guru = Guru::where('user_id', auth()->user()->id)->first();
        $mapels = Mapel::with('guru')->where('guru_id', $guru->id)->get();
        $kelas = Kelas::all();
        $materi = Materi::where('users_id', Auth::user()->id)->with('files')->findOrFail($id);
        // //Guru yang Login
        // $guru = Guru::where('user_id', auth()->user()->id)->first();

        // //Mata Pelajaran Yang Diajarkan Guru
        // $mapels = Mapel::with('guru')->where('guru_id', $guru->id)->get();

        // $materi = Materi::findorFail($id)->with('mapel')->where('mapel_id', $mapels->id)->get();

        // //Mata Pelajaran Sesuai kelasjj
        // $kelas = Kelas::all();


        return view('materi.edit', compact('materi', 'kelas', 'guru', 'mapels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
            'judul_materi' => 'required|max:100',
            'mapel_id' => 'required',
            'isi_materi' => 'required',
            'file_materi.*' => 'required|mimes:doc,docx,PDF,xlsx,pdf,jpg,jpeg,png|max:2000',
            'kelas_id' => 'required'
        ], $errors);

        $materi = Materi::findOrFail($id);

        $materi_data = [
            'judul_materi' => $request->judul_materi,
            'mapel_id' =>  $request->mapel_id,
            'isi_materi' =>  $request->isi_materi,
            'kelas_id' =>  $request->kelas_id,
            'users_id' => Auth::id()
        ];

        Materi::whereId($id)->update($materi_data);

        if ($request->hasFile('file_materi')) {
            foreach ($request->file_materi as $file) {

                //nama file original
                $name = $file->getClientOriginalName();

                //buat folder file_mater0_baru
                $targetDir = 'file_materi_baru/';
                $url = $targetDir . $name;

                $file->storeAs($targetDir, $name, 'public');

                FileUpload::create([
                    'url'=>$url,
                    'file'=>$name,
                    'materi_id' => $materi->id,
                ]);
           }
        }

        return redirect('materi')->with('success','Materi berhasil Diupdate !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $materi = Materi::findOrFail($id);
        $materi->delete();
        return redirect()->back()->with('success','Materi Berhasil Dihapus');
    }
}
