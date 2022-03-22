@extends('layouts.template')
@section('sub-judul', 'Tugas Siswa | E-Learning SKPK')
@section('panel-heading')
    <div class="panel-heading">
        <h3 class="panel-title">@yield('sub-judul')</h3>
        <a href="/dashboards" class="back-hover">
            <i class="fa fa-angle-left fa-lg"></i> Kembali Ke Dashboard
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
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Tugas Siswa</h3>
                </div>
                <div class="panel-body" style="margin-top: -15px;">
                    <ul class="list-unstyled todo-list">
                        @foreach ($tugas_siswas as $result => $r)
                            @if ($r->mapel == $mapels)
                                <li>
                                    <img src="{{ $r->users->guru->getProfile() }}" alt="Avatar"
                                    class="img-circle pull-left avatar"
                                    style="margin-top: 40px;
                                            margin-left: 10px;
                                            width:70px; height: 70px;">
                                    <h3 style="padding: -10px; margin-left:113px;">{{ $r->users->name }}</h3>
                                    <div style="margin-top: -20px;">
                                        <p class="title" style="margin-left: -1px;">{{ $r->judul }}</p>
                                        <div style="margin-top: -40px;">
                                            {!! $r->isi_tugas !!}
                                            <br>
                                            <p class="date" style="margin-top: -40px; margin-left: 79px;">
                                                {{ $r->updated_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div class="controls">
                                            <a href="{{ route('agenda_siswa_show', $r->id) }}" class="btn btn-info btn-sm" style="width: 20px;">
                                                <i class="fas fa-eye fa-lg" aria-hidden="true" style="margin-left: -9px;"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            {{ $tugas_siswas->links() }}
        </div>
    </div>

@endsection
