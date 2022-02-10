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
                <ul>
                    @foreach ($mapels as $mpl)
                        <li>{{ $mpl->nama_mapel }} - {{ $mpl->kelas['nama_kelas'] }}</li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
@endsection
