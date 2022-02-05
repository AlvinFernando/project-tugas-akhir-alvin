@extends('layouts.template')
@section('sub-judul', 'Pengumuman | E-Learning SKPK')
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
                        <div class="container">{{ $agenda->judul }}</div>
                    </div>
                </div>
            </div>
        </div>
@endsection
