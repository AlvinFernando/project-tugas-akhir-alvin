@extends('layouts.template')
@section('sub-judul', 'Materi | E-Learning SKPK')
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
                <h3 class="panel-title">Materi</h3>
                <div class="right">
                    <a href="{{ route('materi.create') }}" class="btn btn-sm btn-info">
                        <i class="fas fa-plus text-light"></i>
                        &nbsp;Tambah Materi Baru
                    </a>
                </div>
            </div>
            <div class="panel-body" style="margin-top: -15px;">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-unstyled todo-list">
                            @foreach ($materi as $result => $r)
                                <li>
                                    <div class="col-sm-2">
                                        <img src="{{ $r->users->guru->getProfile() }}" alt="Avatar"
                                        class="img-circle pull-left avatar"
                                        style="margin-top: 40px;
                                                margin-left: 10px;
                                                width:70px; height: 70px;">
                                    </div>
                                    <div class="col-sm-9">
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

                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="controls" style="margin-top: 50px;">
                                            <form action="{{ route('materi.destroy', $r->id )}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('materi.show', $r->id) }}" class="btn btn-info btn-sm" style="width: 20px;">
                                                    <i class="fas fa-eye fa-lg" aria-hidden="true" style="margin-left: -8px;"></i>
                                                </a>
                                                <a href="{{ route('materi.edit', $r->id ) }}" class="btn btn-warning btn-sm" style="width: 20px;">
                                                    <i class="fas fa-edit fa-lg" aria-hidden="true" style="margin-left: -8px;"></i>
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-sm" style="width: 20px; margin-left: 5px;">
                                                    <i class="fas fa-trash-alt fa-lg" aria-hidden="true" style="margin-left: -8px;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        {{-- {{ $materi->links() }} --}}
    </div>
</div>

@endsection
