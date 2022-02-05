@extends('layouts.template')
@section('sub-judul', 'Materi | E-Learning SKPK')
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
                                    <h3>Materi</h3>
                                    <div class="right">
                                          <a href="{{ route('materi.create') }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-plus text-light"></i>
                                                &nbsp;Tambah Materi Baru
                                          </a>
                                    </div>
                              </div>
                        </div>
                        <thead>
                              <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Mata Pelajaran</th>
                                    <th scope="col">Judul Materi</th>
                                    <th scope="col">Isi Materi</th>
                                    <th scope="col">File Materi</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Aksi</th>
                              </tr>
                        </thead>
                        <tbody>
                              <tr>
                                    @forelse ($materi as $result => $r)
                                          <tr>
                                                <td>{{ $result + $materi->firstitem() }}</td>
                                                <td>{{ $r->mapel['nama_mapel'] }}</td>
                                                <td>{{ $r->judul_materi }}</td>
                                                <td>{!! $r->isi_materi !!}</td>
                                                <td>
                                                    @foreach ($r->files as $file)
                                                        <p>
                                                            <a href="{{ 'storage/'.$file->url }}">  {{ $file->file }}</a>
                                                        </p>
                                                    @endforeach
                                                </td>
                                                <td>{{ $r->kelas['nama_kelas'] }}</td>
                                                <td>
                                                      <form action="{{ route('mapel.destroy', $r->id )}}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="{{ route('materi.show', $r->id) }}" class="btn btn-info btn-sm" style="width: 20px;">
                                                                  <i class="fas fa-eye fa-lg" aria-hidden="true" style="margin-left: -9px;"></i>
                                                            </a>
                                                            <a href="{{ route('mapel.edit', $r->id ) }}" class="btn btn-warning btn-sm" style="width: 20px;">
                                                                  <i class="fas fa-edit fa-lg" aria-hidden="true" style="margin-left: -9px;"></i>
                                                            </a>
                                                            <button type="submit" class="btn btn-danger btn-sm" style="width: 20px;">
                                                                  <i class="fas fa-trash-alt fa-lg" aria-hidden="true" style="margin-left: -9px;"></i>
                                                            </button>
                                                      </form>
                                                </td>
                                          </tr>
                                    @empty
                                          <tr>
                                                <td colspan="8" align="center" bgcolor="#EEEEEE">Belum Ada Materi yang Diupload</td>
                                          </tr>
                                    @endforelse
                              </tr>
                        </tbody>
                  </table>
                  {{ $materi->links() }}
            </div>
      </div>

@endsection
