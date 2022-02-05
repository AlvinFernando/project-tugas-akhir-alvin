@extends('layouts.template')
@section('sub-judul', 'Data Guru | E-Learning SKPK')
@section('panel-heading')
      <div class="panel-heading">
            <h3 class="panel-title">@yield('sub-judul') - 
                  @if (Auth::user()->level == 'guru')
                        <span class="label label-primary">Guru</span>
                  @endif
                  @if (Auth::user()->level == 'siswa')
                        <span class="label label-danger">Siswa</span>
                  @endif
                  @if (Auth::user()->level == 'admin')
                        <span class="label label-success">Admin</span>
                  @endif
                  @if (Auth::user()->level == 'kepsek')
                        <span class="label label-warning">Kepala Sekolah</span>
                  @endif
            </h3>
      </div>
@stop
@section('content')
      <div class="row">
            <div class="col-md-12">
                  <table class="table table-striped table-hover table-sm table-bordered">
                        <div class="row">
                              <div class="col-sm-12">
                                    <h3>Data Guru</h3>
                                    <div class="right"> 
                                          <a href="{{ route('guru.create') }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-plus text-light"></i> 
                                                &nbsp;Tambah Data Guru
                                          </a>
                                    </div>
                              </div>
                        </div>
                        <thead>
                              <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Guru</th>
                                    <th scope="col">Nama Guru</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Agama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Telp</th>
                                    <th scope="col">Aksi</th>
                              </tr>
                        </thead>
                        <tbody>
                              @forelse ($guru as $result => $r)
                                    <tr>
                                          <th scope="row">{{ $result + $guru->firstitem() }}</th>
                                          <td>{{ $r->kode_guru }}</td>
                                          <td>{{ $r->nama_guru }}</td>
                                          <td>{{ $r->jk }}</td>
                                          <td>{{ $r->agama }}</td>
                                          <td>{{ $r->alamat }}</td>
                                          <td>{{ $r->no_telp }}</td>
                                          <td>
                                                <form action="{{ route('guru.destroy', $r->id )}}" method="POST" style="margin-left: -10px;">
                                                      @csrf
                                                      @method('delete')
                                                      <a href="{{ route('profil_guru', $r->id) }}" class="btn btn-info btn-sm" style="width: 20px;">
                                                            <i class="fas fa-eye fa-lg" aria-hidden="true" style="margin-left: -9px;"></i>
                                                      </a>
                                                      <a href="{{ route('guru.edit', $r->id ) }}" class="btn btn-warning btn-sm" style="width: 20px;">
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
            {{ $guru->links() }}
      </div>
@endsection