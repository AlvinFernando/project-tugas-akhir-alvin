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
                    <h3 class="panel-title" style="font-size: 32px; margin-left: 10px;">Tugas Siswa</h3>
                    <div class="right">
                        <a href="{{ route('tugas_siswa.create') }}" class="btn btn-sm btn-info">
                            <i class="fas fa-plus text-light"></i>
                            &nbsp;Tambah Tugas
                        </a>
                    </div>
                </div>
                <div class="panel-body" style="margin-top: -15px;">
                    <ul class="list-unstyled todo-list">
                        @foreach ($tugas_siswa as $result => $r)
                            {{-- Menampilkan agenda yang ditulis hanya user yang login saja --}}
                            @if ($r->users_id == Auth::user()->id)
                                <li>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p class="title text-success" style="margin-left: 15px; font-size: 32px;">{{ $r->mapel['nama_mapel'] }}</p>
                                            <div class="col-md-9">
                                                <p class="title" style="margin-top: -40px; font-size: 22px;"><u>Kelas : {{ $r->kelas['nama_kelas'] }}</u></p>
                                                <p class="title" style="margin-top: -40px; font-size: 24px;">{{ $r->judul }}</p>
                                                <div style="margin-top: -40px; font-size: 20px;">
                                                    {!! $r->isi_tugas !!}
                                                    <br>
                                                    <p class="date" style="margin-top: -40px;">{{ $r->updated_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="controls text-center" style="margin-top: 50px; margin-left: 10px;">
                                                    <form action="{{ route('tugas_siswa.destroy', $r->id )}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="{{ route('tugas_siswa.show', $r->id) }}" class="btn btn-info btn-sm" style="width: 20px;">
                                                            <i class="fas fa-eye fa-lg" aria-hidden="true" style="margin-left: -9px;"></i>
                                                        </a>
                                                        <a href="{{ route('tugas_siswa.edit', $r->id ) }}" class="btn btn-warning btn-sm" style="width: 20px;">
                                                            <i class="fas fa-edit fa-lg" aria-hidden="true" style="margin-left: -9px;"></i>
                                                        </a>
                                                        <button type="submit" class="btn btn-danger btn-sm" style="width: 20px;">
                                                            <i class="fas fa-trash-alt fa-lg" aria-hidden="true" style="margin-left: -9px;"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            {{-- {{ $tugas_siswa->links() }} --}}
        </div>
    </div>

@endsection
