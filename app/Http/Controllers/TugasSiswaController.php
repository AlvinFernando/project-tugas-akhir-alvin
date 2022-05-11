<?php

namespace App\Http\Controllers;

use App\TugasSiswa;
use App\User;
use Illuminate\Http\Request;
use App\Mapel;
use App\Guru;
use App\Siswa;
use App\FileLampiran;
use App\FileTugasSiswa;
use App\KumpulTugasSiswa;
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
        $tugas_siswa = TugasSiswa::paginate(10)->sortByDesc('created_at');

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

        $tugas_siswa = TugasSiswa::Create([
            'judul' => $request->judul,
            'mapel_id' =>  $request->mapel_id,
            'isi_tugas' =>  $request->isi_tugas,
            'kelas_id' =>  $request->kelas_id,
            'users_id' => Auth::id(),
            'end_date' =>  $request->end_date,
        ]);

        if ($request->hasFile('lampiran')) {
            foreach ($request->lampiran as $file) {
                // upload File
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
                // End Upload File

                //nama file original
                $name = $file->getClientOriginalName();

                //buat folder file_mater0_baru
                $targetDir = 'file_lampiran_baru/';
                $url = $targetDir . $name;

                $file->storeAs($targetDir, $name, 'public');

                FileLampiran::create([
                    'url'=>$url,
                    'file'=>$name,
                    'tugas_siswa_id' => $tugas_siswa->id,
                ]);
           }
        }

        if ($tugas_siswa) {
            return redirect('tugas_siswa')->with('success','Tugas Siswa berhasil Diupload !!');
        }else{
            return redirect('tugas_siswa')->with('error', 'Tugas Siswa Sudah Ada!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TugasSiswa  $tugasSiswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $tugas_siswa = TugasSiswa::findOrFail($id);
        $file2 = FileLampiran::all();
        $kumpul_tugas_siswas = KumpulTugasSiswa::all();
        return view('tugas_siswa.show', compact('tugas_siswa', 'userLogin', 'file2', 'kumpul_tugas_siswas'));
    }

    public function show_kumpul_tugas_siswa($id)
    {
        //
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $kumpul_tugas_siswas = KumpulTugasSiswa::findOrFail($id);
        $file3 = FileTugasSiswa::all();
        return view('tugas_siswa.show_tugas_siswa', compact('kumpul_tugas_siswas', 'userLogin', 'file3'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TugasSiswa  $tugasSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $guru = Guru::where('user_id', auth()->user()->id)->first();
        $mapels = Mapel::with('guru')->where('guru_id', $guru->id)->get();
        $kelas = Kelas::all();
        $tugas_siswa = TugasSiswa::where('users_id', Auth::user()->id)->findOrFail($id);
        // //Guru yang Login
        // $guru = Guru::where('user_id', auth()->user()->id)->first();

        // //Mata Pelajaran Yang Diajarkan Guru
        // $mapels = Mapel::with('guru')->where('guru_id', $guru->id)->get();

        // $materi = Materi::findorFail($id)->with('mapel')->where('mapel_id', $mapels->id)->get();

        // //Mata Pelajaran Sesuai kelasjj
        // $kelas = Kelas::all();


        return view('tugas_siswa.edit', compact('kelas', 'guru', 'mapels', 'userLogin', 'tugas_siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TugasSiswa  $tugasSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            'kelas_id' => 'required'
        ], $errors);

        $tugas_siswa = TugasSiswa::findOrFail($id);

        $tugas_siswa_data = [
            'judul' => $request->judul,
            'mapel_id' =>  $request->mapel_id,
            'isi_tugas' =>  $request->isi_tugas,
            'kelas_id' =>  $request->kelas_id,
            'users_id' => Auth::id(),
            'end_date' =>  $request->end_date,
        ];

        TugasSiswa::whereId($id)->update($tugas_siswa_data);

        return redirect('tugas_siswa')->with('success','Tugas Siswa berhasil Diupdate !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TugasSiswa  $tugasSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $tugas_siswa = TugasSiswa::findOrFail($id);
        $tugas_siswa->delete();
        return redirect()->back()->with('success','Tugas Siswa Berhasil Dihapus');
    }

    //=======================================================================================================

    public function halaman_tugas_siswa($id)
    {
        // dd($request->all();
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $mapels = Mapel::findOrFail($id);
        $siswa = Siswa::where('user_id', auth()->user()->id)->first();
        $tugas_siswa = TugasSiswa::where('kelas_id', $siswa->kelas_id)->orWhere('mapel_id', $mapels->id)->paginate(10);
        $kelas = Kelas::all();
        return view('mapel_siswa.index_tugas', compact('tugas_siswa', 'siswa', 'userLogin', 'mapels', 'kelas'));
    }

    public function show_tugas_siswa($id)
    {
        //User yang sedang Login
        $userLogin = User::where('id', auth()->user()->id)->with(['siswa', 'guru', 'admin'])->get();
        $tugas_siswa = TugasSiswa::findOrFail($id);
        $kumpul_tugas_siswas = KumpulTugasSiswa::all();
        return view('mapel_siswa.show_tugas', compact('materi', 'userLogin', 'tugas_siswa', 'kumpul_tugas_siswas'));
    }

    public function kumpul_tugas_siswa(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request, [
            'nama_tugas' => 'required',
            'file_tugas_siswas.*' => 'required|mimes:doc,docx,pdf,xlsx,pdf,jpg,jpeg,png|max:2000'
        ]);

        $tugas_siswa = TugasSiswa::find($id);
        $kumpul_tugas_siswas = KumpulTugasSiswa::create([
            'nama_tugas' => $request->nama_tugas,
            'isi' => $request->isi,
            'tugas_siswas_id' => $tugas_siswa->id,
            'users_id' => Auth::id(),
            'status' => 'Dikumpulkan'
        ]);

        //dd($request);
        if ($request->hasFile('file_tugas_siswas')) {
            foreach ($request->file_tugas_siswas as $file) {

                //nama file original
                $name = $file->getClientOriginalName();

                //buat folder file_mater0_baru
                $targetDir = 'file_tugas_siswa_baru/';
                $url = $targetDir . $name;

                $file->storeAs($targetDir, $name, 'public');

                FileTugasSiswa::create([
                    'url'=>$url,
                    'file'=>$name,
                    'kumpul_tugas_siswas_id' => $kumpul_tugas_siswas->id
                ]);
           }
        }

        return back()->with('success', 'Tugas Telah Diupload');
    }
}
