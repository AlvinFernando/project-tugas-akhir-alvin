@extends('layouts.template')
@section('sub-judul', 'Pengumuman | E-Learning SKPK')
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
                                    <h3>Pengumuman</h3>
                                    <div class="right">
                                          <a href="{{ route('pengumuman.create') }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-plus text-light"></i> 
                                                &nbsp;Tambah Pengumuman
                                          </a>
                                    </div>
                              </div>
                        </div>
                        <thead>
                              <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Isi</th>
                                    <th scope="col">Kepala Sekolah</th>
                                    <th scope="col">Aksi</th>
                              </tr>
                        </thead>
                        <tbody>
                              <tr>
                                    @forelse ($pengumuman as $result => $r)
                                          <tr>
                                                <td>{{ $result + $pengumuman->firstitem() }}</td>
                                                <td>{{ $r->judul }}</td>
                                                <td>{!! $r->isi_pengumuman !!}</td>
                                                <td>{{ $r->kepsek }}</td>
                                                <td>
                                                      <form action="{{ route('pengumuman.destroy', $r->id )}}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="{{ route('pengumuman.show', $r->id) }}" class="btn btn-info btn-sm" style="width: 20px;">
                                                                  <i class="fas fa-eye fa-lg" aria-hidden="true" style="margin-left: -9px;"></i>
                                                            </a>
                                                            <a href="{{ route('pengumuman.edit', $r->id ) }}" class="btn btn-warning btn-sm" style="width: 20px;">
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
                                                <td colspan="6" align="center" bgcolor="#EEEEEE">Belum Ada Pengumuman Yang Diisi</td>
                                          </tr>
                                    @endforelse
                              </tr>
                        </tbody>
                  </table>
                  {{ $pengumuman->links() }}
            </div>
      </div>
      
@endsection