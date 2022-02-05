@extends('layouts.template')
@section('sub-judul', 'Agenda Siswa | E-Learning SKPK')
@section('panel-heading')
      <div class="panel-heading">
            <h3 class="panel-title">@yield('sub-judul')</h3>
      </div>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-title bg-primary">
                    {{ $agenda->judul }}
                </div>
                <div class="card-body">
                    {!! $agenda->isi_agenda !!}
                </div>
            </div>
        </div>
    </div>
@endsection
