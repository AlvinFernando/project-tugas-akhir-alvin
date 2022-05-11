@extends('layouts.template')
@section('sub-judul', 'Tugas Siswa | E-Learning SKPK')
@section('panel-heading')
    <div class="panel-heading">
        <h3 class="panel-title">@yield('sub-judul')</h3>
        <a href="{{ route('list_mapel_siswa') }}" class="back-hover">
            <i class="fa fa-angle-left fa-lg"></i> Kembali Ke Mata Pelajaran
        </a>
    </div>
@stop
@section('content')

    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

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
                        <h3 class="panel-title">Tugas Siswa</h3>
                    </div>
                    <div class="panel-body" style="margin-top: -15px;">
                        <ul class="list-unstyled todo-list">
                            @foreach ($tugas_siswa as $result => $r)
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
                                            <p class="title text-success" style="padding: -10px; font-size: 32px; margin-left: -35px;">{{ $r->users->name }}</p>
                                            <h3 class="text-success" style="margin-top: -20px; font-size: 24px;">{{ $r->mapel['nama_mapel'] }} - Kelas {{ $r->kelas['nama_kelas'] }}</h3>
                                            <div style="margin-top: -20px;">
                                                <p class="title" style="margin-left: -35px; font-size: 24px;">{{ $r->judul }}</p>
                                                <div style="margin-top: -40px; margin-left: -35px; font-size: 22px;">
                                                    {!! $r->isi_tugas !!}
                                                    <br>
                                                    <p class="date" style="margin-top: -40px; ">
                                                        {{ $r->updated_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                                <div class="controls">
                                                    <a href="{{ route('show_tugas_siswa', $r->id) }}" class="btn btn-info btn-sm" style="width: 20px;">
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
                {{ $tugas_siswa->links() }}
            </div>
        </div>
    </div>

@endsection
