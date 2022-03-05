@extends('layouts.template')
@section('sub-judul', 'Mapel Siswa | E-Learning SKPK')
@section('panel-heading')
    <div class="panel-heading">
        <h3 class="panel-title">@yield('sub-judul')</h3>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-bg-12">
            <div class="container-fluid">
                @foreach ($mapels as $mpl)
                    {{-- <a href="{{ route('list_materi_siswa', $mapels->id) }}"> --}}
                        <a href="#">
                            <div class="metric bg-success myhover" style="border-radius: 20px; width: 50%; align: center; margin-left: 225px;">
                                <span class="icon" style="margin-top: -2px;"><i class="fas fa-book"></i></span>
                                <p>
                                    <span class="h3">{{ $mpl->nama_mapel }}</span>
                                    <br>
                                    <span style="font-size: 20px;">Kelas {{ $mpl->kelas['nama_kelas'] }}</span>
                                </p>
                            </div>
                        </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
