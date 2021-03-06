@extends('layouts.template')
@section('sub-judul', 'Agenda Siswa | E-Learning SKPK')
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
            {{-- <table class="table table-striped table-hover table-sm table-bordered">
                <div class="row">
                    <div class="col-sm-12">
                        <h3>Agenda</h3>
                    </div>
                </div>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Isi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @forelse ($agenda as $result => $r)
                            <tr>
                                <td>{{ $result + $agenda->firstitem() }}</td>
                                <td>{{ $r->judul }}</td>
                                <td>{!! $r->isi_agenda !!}</td>
                                <td>
                                    <form action="{{ route('agenda.destroy', $r->id )}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('agenda_siswa_show', $r->id) }}" class="btn btn-info btn-sm" style="width: 20px;">
                                            <i class="fas fa-eye fa-lg" aria-hidden="true" style="margin-left: -9px;"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" align="center" bgcolor="#EEEEEE">Belum Ada agenda Yang Diisi</td>
                            </tr>
                        @endforelse
                    </tr>
                </tbody>
            </table> --}}
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Agenda Siswa</h3>
                </div>
                <div class="panel-body" style="margin-top: -15px;">
                    <ul class="list-unstyled todo-list">
                        @foreach ($agenda as $result => $r)
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
                                        {!! $r->isi_agenda !!}
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
                        @endforeach
                    </ul>
                </div>
            </div>
            {{ $agenda->links() }}
        </div>
    </div>

@endsection
