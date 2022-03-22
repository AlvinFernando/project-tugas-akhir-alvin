@extends('layouts.template')
@section('sub-judul', 'Data Guru | E-Learning SKPK')
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
                                    <h3>Data Kepala Sekolah</h3>
                                    <div class="right">
                                          <a href="{{ route('kepsek.create') }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-plus text-light"></i>
                                                &nbsp;Tambah Data Kepala Sekolah
                                          </a>
                                    </div>
                              </div>
                        </div>
                        <thead>
                              <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Kepala Sekolah</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Agama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Telp</th>
                                    <th scope="col">Aksi</th>
                              </tr>
                        </thead>
                        <tbody>
                              @forelse ($kepsek as $result => $r)
                                    <tr>
                                          <th scope="row">{{ $result + $kepsek->firstitem() }}</th>
                                          <td>{{ $r->nama_kepsek }}</td>
                                          <td>{{ $r->jk }}</td>
                                          <td>{{ $r->agama }}</td>
                                          <td>{{ $r->alamat }}</td>
                                          <td>{{ $r->no_telp }}</td>
                                          <td>
                                                <form action="{{ route('kepsek.destroy', $r->id )}}" method="POST" style="margin-left: -10px;">
                                                      @csrf
                                                      @method('delete')
                                                      <a href="{{ route('kepsek.show', $r->id) }}" class="btn btn-info btn-sm" style="width: 20px;">
                                                            <i class="fas fa-eye fa-lg" aria-hidden="true" style="margin-left: -9px;"></i>
                                                      </a>
                                                      <a href="{{ route('kepsek.edit', $r->id ) }}" class="btn btn-warning btn-sm" style="width: 20px;">
                                                            <i class="fas fa-user-edit fa-lg" aria-hidden="true" style="margin-left: -8px;"></i>
                                                      </a>
                                                      <button type="submit" class="btn btn-danger btn-sm" style="width: 20px;">
                                                            <i class="fas fa-trash-alt fa-lg" aria-hidden="true" style="margin-left: -7px;"></i>
                                                      </button>
                                                </form>
                                          </td>
                                    </tr>
                              @empty
                                    <tr>
                                          <td colspan="8" align="center" bgcolor="#EEEEEE">Belum Ada Data Yang Dimasukkan</td>
                                    </tr>
                              @endforelse
                        </tbody>
                  </table>
            </div>
      </div>

      <div class="float-right">
            {{ $kepsek->links() }}
      </div>
@endsection
