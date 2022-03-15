@extends('layouts.template')
@section('sub-judul', 'Agenda | E-Learning SKPK')
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
                    <h3 class="panel-title">Agenda</h3>
                    <div class="right">
                        <a href="{{ route('agenda.create') }}" class="btn btn-sm btn-info">
                              <i class="fas fa-plus text-light"></i>
                              &nbsp;Tambah agenda
                        </a>
                    </div>
                </div>
                <div class="panel-body" style="margin-top: -15px;">
                    <ul class="list-unstyled todo-list">
                        @forelse ($agenda as $result => $r)
                            {{-- Menampilkan agenda yang ditulis hanya user yang login saja --}}
                            @if ($r->users_id == Auth::user()->id)
                                <li>
                                    <p class="title" class="margin-left: 20px; color: blue;">{{ $r->judul }}</p>
                                    <div style="margin-top: -40px;">
                                        {!! $r->isi_agenda !!}
                                        <br>
                                        <p class="date" style="margin-top: -40px;">{{ $r->updated_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="controls">
                                        <form action="{{ route('agenda.destroy', $r->id )}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ route('agenda.show', $r->id) }}" class="btn btn-info btn-sm" style="width: 20px;">
                                                <i class="fas fa-eye fa-lg" aria-hidden="true" style="margin-left: -9px;"></i>
                                            </a>
                                            <a href="{{ route('agenda.edit', $r->id) }}" class="btn btn-warning btn-sm" style="width: 20px;">
                                                <i class="fas fa-user-edit fa-lg" aria-hidden="true" style="margin-left: -8px;"></i>
                                            </a>
                                            <button type="submit" class="btn btn-danger btn-sm" style="width: 20px;">
                                                <i class="fas fa-trash-alt fa-lg" aria-hidden="true" style="margin-left: -7px;"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endif
                        @empty
                            <p>Tidak Ada Agenda</p>
                        @endforelse
                    </ul>
                </div>
            </div>
            {{ $agenda->links() }}
        </div>
    </div>

@endsection
