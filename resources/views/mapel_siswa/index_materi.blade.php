@extends('layouts.template')
@section('sub-judul', 'Materi Siswa | E-Learning SKPK')
@section('panel-heading')
<div class="panel-heading">
    <h3 class="panel-title">@yield('sub-judul')</h3>
    <a href="{{ route('list_mapel_siswa') }}" class="back-hover">
        <i class="fa fa-angle-left fa-lg"></i> Kembali Ke Mata Pelajaran
    </a>
</div>
@stop
@section('content')
    <div class="row">
        <div class="col-bg-12">
            <div class="container-fluid">
                <table class="table table-striped table-hover table-sm table-bordered">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Materi</h3>
                            {{-- <div class="right">
                            <a href="#" class="btn btn-sm btn-info">
                            <i class="fas fa-plus text-light"></i>
                            &nbsp;Tambah Materi Baru
                            </a>
                            </div> --}}
                        </div>
                    </div>
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">Judul Materi</th>
                            <th scope="col">Isi Materi</th>
                            <th scope="col">File Materi</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @forelse ($materi as $result => $r)
                                @if ($r->mapel == $mapels)
                                    <tr>
                                        <td>{{ $result + $materi->firstitem() }}</td>
                                        <td>{{ $r->mapel['nama_mapel'] }}</td>
                                        <td>{{ $r->judul_materi }}</td>
                                        <td>{!! $r->isi_materi !!}</td>
                                        <td>
                                            @foreach ($r->files as $file)
                                                <p>
                                                    <a href="{{ 'storage/'.$file->url }}">{{ $file->file }}</a>
                                                </p>
                                            @endforeach
                                        </td>
                                        <td>{{ $r->kelas['nama_kelas'] }}</td>
                                        <td>{{ $r->created_at }}</td>
                                        <td>
                                            <a href="{{ route('show_materi_siswa', $r->id) }}" class="btn btn-info btn-sm" style="width: 20px;">
                                                <i class="fas fa-eye fa-lg" aria-hidden="true" style="margin-left: -9px;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="8" align="center" bgcolor="#EEEEEE">Belum Ada Materi yang Diupload</td>
                                </tr>
                            @endforelse
                        </tr>
                    </tbody>
                </table>
                {{ $materi->links() }}
            </div>
        </div>
    </div>
@endsection
