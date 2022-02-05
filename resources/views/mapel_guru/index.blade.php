{{-- @extends('layouts.template')
@section('sub-judul', 'Mata Pelajaran Yang Diampu | E-Learning SKPK')
@section('panel-heading')
      <div class="panel-heading">
            <h3 class="panel-title">@yield('sub-judul')</h3>
      </div>
@stop
@section('content')
      <style>
            .bg-default{
                  background-color: rgb(235, 235, 235);
                  width: 100%;
                  padding: 10px;
            }
      </style>
      <div class="row">
            <div class="col-lg-12">
                  <div class="col-sm-12">
                        <div class="profile-info">
                              <h4 class="heading">Mata Pelajaran Yang Diajar Oleh {{ Auth::user()->name }}</h4>
                              <ul class="list-unstyled list-justify">
                                    @forelse ($mapels as $mapel)
                                          <li>
                                                <a href="{{ route('materi.index', $mapel->id) }}" class="btn btn-primary btn-lg">
                                                      <i class="fas fa-book" aria-hidden="true"></i>      
                                                      {{$mapel->nama_mapel}} - {{ $mapel->kelas['nama_kelas'] }}
                                                </a>
                                          </li>
                                    @empty
                                          <div class="card">
                                                <div class="card-body">
                                                      <h4 class="text-center bg-default">Belum Ada Mata Pelajaran Yang Diajarkan !!</h4>
                                                </div>
                                          </div>
                                    @endforelse
                              </ul>
                                    
                        </div>
                  </div>
            </div>
      </div>
@endsection --}}