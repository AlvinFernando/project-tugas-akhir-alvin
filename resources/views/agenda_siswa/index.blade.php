@extends('layouts.template')
@section('sub-judul', 'Agenda Siswa | E-Learning SKPK')
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
                                    <h3>Agenda</h3>
                              </div>
                        </div>
                        <thead>
                              <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Isi</th>
                                    <th scope="col">Aksi</th>
                              </tr>
                        </thead>
                        <tbody>
                              <tr>
                                    @forelse ($agenda as $result => $r)
                                          <tr>
                                                <td>{{ $result + $agenda->firstitem() }}</td>
                                                <td>{{ $r->judul }}</td>
                                                <td>{!! $r->isi_agenda !!}</td>
                                                <td>
                                                      <form action="{{ route('agenda.destroy', $r->id )}}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="{{ route('agenda_siswa_show', $r->id) }}" class="btn btn-info btn-sm" style="width: 20px;">
                                                                  <i class="fas fa-eye fa-lg" aria-hidden="true" style="margin-left: -9px;"></i>
                                                            </a>

                                                      </form>
                                                </td>
                                          </tr>
                                    @empty
                                          <tr>
                                                <td colspan="4" align="center" bgcolor="#EEEEEE">Belum Ada agenda Yang Diisi</td>
                                          </tr>
                                    @endforelse
                              </tr>
                        </tbody>
                  </table>
                  {{ $agenda->links() }}
            </div>
      </div>

@endsection
