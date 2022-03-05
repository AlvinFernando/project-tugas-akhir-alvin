@extends('layouts.template')
@section('sub-judul', 'Data Siswa | E-Learning SKPK')
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
                  <table class="table table-striped table-hover table-sm table-bordered">
                        <div class="row">
                              <div class="col-sm-12">
                                    <h3>Data Siswa</h3>
                                    <div class="right">
                                          <a href="{{ route('siswa.create') }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-plus text-light"></i>
                                                &nbsp;Tambah Data Siswa
                                          </a>
                                    </div>
                              </div>
                        </div>
                        <thead>
                              <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">No Induk</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Agama</th>
                                    <th scope="col">Wali Kelas</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">No. Telp</th>
                                    <th scope="col">Aksi</th>
                              </tr>
                        </thead>
                        <tbody>
                              @forelse ($siswa as $result => $r)
                                    <tr>
                                          <th scope="row">{{ $result + $siswa->firstitem() }}</th>
                                          <td>{{ $r->no_induk }}</td>
                                          <td>{{ $r->nama_siswa }}</td>
                                          <td>{{ $r->kelas['nama_kelas'] }}</td>
                                          <td>{{ $r->jk }}</td>
                                          <td>{{ $r->agama }}</td>
                                          <td>{{ $r->guru['nama_guru'] }}</td>
                                          <td>{{ $r->alamat }}</td>
                                          <td>{{ $r->no_telp }}</td>
                                          <td>
                                                <form action="{{ route('siswa.destroy', $r->id )}}" method="POST" style="margin-left: -10px;">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="#" class="btn btn-info btn-sm" style="width: 20px;">
                                                        <i class="fas fa-eye fa-lg" aria-hidden="true" style="margin-left: -9px;"></i>
                                                    </a>
                                                    <a href="{{ route('siswa.edit', $r->id ) }}" class="btn btn-warning btn-sm" style="width: 20px;">
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
                                          <td colspan="10" align="center" bgcolor="#EEEEEE">Belum Ada Data Yang Dimasukkan</td>
                                    </tr>
                              @endforelse
                        </tbody>
                  </table>
            </div>
      </div>

@endsection
