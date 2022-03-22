@extends('layouts.template')
@section('sub-judul', 'Data Admin | E-Learning SKPK')
@section('panel-heading')
    <div class="panel-heading">
        <h3 class="panel-title">@yield('sub-judul')</h3>
        <a href="/dashboards" class="back-hover">
            <i class="fa fa-angle-left fa-lg"></i> Kembali Ke Dashboard
        </a>
    </div>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
                <table class="table table-striped table-hover table-sm table-bordered">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Data Admin</h3>
                            <div class="right">
                                <a href="{{ route('admin.create') }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-plus text-light"></i>
                                    &nbsp;Tambah Admin
                                </a>
                            </div>
                        </div>
                    </div>
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Admin</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admin as $result => $r)
                            <tr>
                                <th scope="row">{{ $result + $admin->firstitem() }}</th>
                                <td>{{ $r->nama_admin }}</td>
                                <td>
                                    <a href="{{ route('admin.show', $r->id) }}" class="btn btn-info btn-sm" style="width: 20px;">
                                        <i class="fas fa-eye fa-lg" aria-hidden="true" style="margin-left: -9px;"></i>
                                    </a>
                                    <a href="{{ route('admin.edit', $r->id ) }}" class="btn btn-warning btn-sm" style="width: 20px;">
                                        <i class="fas fa-user-edit fa-lg" aria-hidden="true" style="margin-left: -8px;"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>

    <div class="float-right">
        {{ $admin->links() }}
    </div>
@endsection
