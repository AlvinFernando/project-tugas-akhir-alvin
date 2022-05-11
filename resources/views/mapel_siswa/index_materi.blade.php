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
            <div class="col-md-12" style="margin-top: auto; margin-bottom: 10px;">
                <a href="{{ route('halaman_materi_siswa', $mapels->id) }}" class="bg-success text-white" style="padding: 10px; color: white;">
                    <i class="fas fa-eye fa-md" aria-hidden="true" style="margin-left: 2px;"></i> &nbsp;MATERI SISWA
                </a>
                <a href="{{ route('halaman_tugas_siswa', $mapels->id) }}" class="bg-primary text-white" style="padding: 10px; color: white; margin-left: 10px;">
                    <i class="fas fa-eye fa-md" aria-hidden="true" style="margin-left: 2px;"></i> &nbsp;TUGAS SISWA
                </a>
            </div>
            <br>
            <div class="container-fluid" style="margin-top: 30px;">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Materi</h3>
                    </div>
                    <div class="panel-body" style="margin-top: -15px;">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="list-unstyled todo-list">
                                    @foreach ($materis as $result => $r)
                                        @if ($r->mapel == $mapels)
                                            <li>
                                                <div class="col-sm-2">
                                                    <img src="{{ $r->users->guru->getProfile() }}" alt="Avatar"
                                                    class="img-circle pull-left avatar"
                                                    style="margin-top: 40px;
                                                            margin-left: 10px;
                                                            width:70px; height: 70px;">
                                                </div>
                                                <div class="col-sm-10">
                                                    <h3 style="padding: -10px;">{{ $r->users->name }}</h3>
                                                    <h3 style="margin-top: 5px; ">{{ $r->mapel['nama_mapel'] }} - Kelas {{ $r->kelas['nama_kelas'] }}</h3>
                                                    <div style="margin-top: -20px;">
                                                        <p class="title" style="margin-left: -34px;">{{ $r->judul_materi }}</p>
                                                        <div style="margin-top: -70px; margin-left: -34px;">
                                                            <p>{!! $r->isi_materi !!}</p>
                                                            <br>
                                                            <p class="date" style="margin-top: -70px;">
                                                                {{ $r->updated_at->diffForHumans() }}
                                                            </p>
                                                        </div>
                                                        <div class="controls">
                                                            <a href="{{ route('show_materi_siswa', $r->id) }}" class="btn btn-info btn-sm" style="width: 20px;">
                                                                <i class="fas fa-eye fa-lg" aria-hidden="true" style="margin-left: -9px;"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                {{ $materis->links() }}
            </div>
        </div>
    </div>
@endsection
