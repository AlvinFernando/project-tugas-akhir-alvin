@extends('layouts.template')
@section('sub-judul', 'Data Mata Pelajaran | E-Learning SKPK')
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
                                    <h3>Data Mata Pelajaran</h3>
                                    <div class="right">
                                          <a href="{{ route('mapel.create') }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-plus text-light"></i>
                                                &nbsp;Tambah Mata Pelajaran
                                          </a>
                                    </div>
                              </div>
                        </div>
                        <thead>
                              <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Mata Pelajaran</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Guru Pengajar</th>
                                    <th scope="col">Aksi</th>
                              </tr>
                        </thead>
                        <tbody>
                              <tr>
                                    @forelse ($mapel as $result => $r)
                                          <tr>
                                                <td>{{ $result + $mapel->firstitem() }}</td>
                                                <td>{{ $r->nama_mapel }}</td>
                                                <td>{{ $r->kelas['nama_kelas'] }}</td>
                                                <td>{{ $r->guru['nama_guru'] }}</td>
                                                <td>
                                                      <form action="{{ route('mapel.destroy', $r->id )}}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="{{ route('mapel.edit', $r->id ) }}" class="btn btn-warning btn-sm">
                                                                  <i class="fas fa-edit fa-lg" aria-hidden="true"></i>
                                                            </a>
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                  <i class="fas fa-trash-alt fa-lg" aria-hidden="true"></i>
                                                            </button>
                                                      </form>
                                                </td>
                                          </tr>
                                    @empty
                                          <tr>
                                                <td colspan="5" align="center" bgcolor="#EEEEEE">Belum Ada Data Yang Dimasukkan</td>
                                          </tr>
                                    @endforelse
                              </tr>
                        </tbody>
                  </table>
                  {{ $mapel->links() }}
            </div>
      </div>

@endsection
