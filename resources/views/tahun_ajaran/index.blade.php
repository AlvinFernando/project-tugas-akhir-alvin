@extends('layouts.template')
@section('sub-judul', 'Tahun Ajaran | E-Learning SKPK')
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
                  <div class="row">
                        <form action="{{ route('tahun_ajaran.input') }}" method="POST" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="col-sm-6">
                                    <div class="form-group">
                                          <input class="form-control" placeholder="Masukkan Tahun Ajaran"
                                          placeholder="Masukkan Tahun Ajaran" type="text"
                                          name="thn_ajaran">
                                    </div>
                              </div>
                              <div class="col-sm-6">
                                    <input type="submit" class="btn btn-primary" value="Input Tahun Ajaran">
                              </div>
                        </form>
                  </div>
                  <table class="table table-striped table-hover table-sm table-bordered">
                        <h3>Tahun Ajaran</h3>
                        <thead>
                              <tr>
                                    <th>No</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Aksi</th>
                              </tr>
                        </thead>
                        <tbody>
                              @forelse ($tahun_ajaran as $result => $r)
                                    <tr>
                                          <td>{{ $result + $tahun_ajaran->firstitem() }}</td>
                                          <td>{{ $r->thn_ajaran }}</td>
                                          <td>
                                                <form action="{{ route('tahun_ajaran.hapus', $r->id )}}" method="POST">
                                                      @csrf
                                                      @method('delete')
                                                      <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>

                                          </td>
                                    </tr>
                              @empty
                                    <tr>
                                          <td colspan="3" align="center" bgcolor="#EEEEEE">Belum Ada Data Yang Dimasukkan</td>
                                    </tr>
                              @endforelse
                        </tbody>
                  </table>
            </div>
      </div>
@endsection
