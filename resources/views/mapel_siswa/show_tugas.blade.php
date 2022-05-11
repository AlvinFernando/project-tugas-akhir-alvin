@extends('layouts.template')
@section('sub-judul', 'Tugas Siswa | E-Learning SKPK')
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
        <div class="col-bg-12">
            <div class="col-sm-12">
                <div class="panel panel-headline rounded">
                    <div class="panel-heading bg-primary">
                        <h1 class="text-light" style="margin-left:10px; margin-top: 4px;">{{ $tugas_siswa->judul }}</h1>
                        <h4 class="text-light" style="margin-left:10px; ">{{ $tugas_siswa->created_at }} | {{ $tugas_siswa->users->name }}</h4>
                    </div>
                    <div class="panel-body" style="margin-left:10px;">
                        <h3>{!! $tugas_siswa->isi_tugas !!}</h3>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body" style="padding: 20px;">
                                        @foreach ($tugas_siswa->files as $file)
                                            <p>
                                                Lampiran : <a href="{{ asset('storage/'.$file->url) }}">  {{ $file->file }}</a>
                                            </p>
                                        @endforeach
                                        <ul>
                                            @foreach ($kumpul_tugas_siswas as $r)
                                                @if (($r->tugas_siswas_id == $tugas_siswa->id) AND ($r->users_id == Auth::user()->id))
                                                    <li>{{ $r->nama_tugas }} - {{ $r->created_at->format('d, M Y') }} - {{ $r->status }}</li>
                                                    {{-- @foreach ($r->files as $file)
                                                        <p>
                                                            <a href="{{ asset('storage/'.$file->url) }}">  {{ $file->file }}</a>
                                                        </p>
                                                    @endforeach --}}
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel">
                                                    <div class="panel-body">
                                                        <h4 style="color: black;">Batas Tanggal Pengumpulan : {{ $tugas_siswa['end_date'] }}</h4>
                                                        <div>
                                                            <div id="countdown">
                                                            </td>
                                                        </div>
                                                        <form action="{{ route('upload_tugas', $tugas_siswa->id) }}" method="POST" enctype="multipart/form-data">
                                                            {{csrf_field()}}

                                                            {{-- file materi --}}
                                                            <div class="form-group">
                                                                <input type="file" id="file_tugas_siswas" name="file_tugas_siswas[]" multiple>
                                                            </div>

                                                            {{-- Nama Tugas --}}
                                                            <div class="form-group {{$errors->has('nama_tugas') ? ' has-error' : ''}}">
                                                                <label>Nama Tugas</label>
                                                                <input name ="nama_tugas" type="text" class="form-control" placeholder="Nama Tugas Siswa"
                                                                value="{{ old('nama_tugas') }}" id="nama_tugas">
                                                                @if ($errors->has('nama_tugas'))
                                                                    <span class="help-block">{{ $errors->first('nama_tugas') }}</span>
                                                                @endif
                                                            </div>

                                                            {{-- isi --}}
                                                            <div class="form-group">
                                                                <label for="isi">Isi</label>
                                                                <textarea class="form-control" name="isi" id="isi"></textarea>
                                                            </div>

                                                            <input type="submit" value="SUBMIT" class="btn btn-primary">
                                                            <script>
                                                                CountDownTimer('{{$tugas_siswa->created_at}}', 'countdown');
                                                                function CountDownTimer(dt, id)
                                                                {
                                                                    var end = new Date('{{$tugas_siswa->end_date}}');
                                                                    var _second = 1000;
                                                                    var _minute = _second * 60;
                                                                    var _hour = _minute * 60;
                                                                    var _day = _hour * 24;
                                                                    var timer;
                                                                    function showRemaining() {
                                                                        var now = new Date();
                                                                        var distance = end - now;
                                                                        if (distance < 0) {

                                                                            clearInterval(timer);
                                                                            document.getElementById(id).innerHTML = '<b style="color: red;">TUGAS TELAH BERAKHIR</b> ';
                                                                            return;
                                                                        }
                                                                        var days = Math.floor(distance / _day);
                                                                        var hours = Math.floor((distance % _day) / _hour);
                                                                        var minutes = Math.floor((distance % _hour) / _minute);
                                                                        var seconds = Math.floor((distance % _minute) / _second);

                                                                        document.getElementById(id).innerHTML = days + 'hari ';
                                                                        document.getElementById(id).innerHTML += hours + 'jam ';
                                                                        document.getElementById(id).innerHTML += minutes + 'menit ';
                                                                        document.getElementById(id).innerHTML += seconds + 'detik';
                                                                        document.getElementById(id).innerHTML +='<h2 class="text-success">TUGAS BELUM BERAKHIR</h2>';
                                                                    }
                                                                    timer = setInterval(showRemaining, 1000);
                                                                }
                                                            </script>
                                                            <script>
                                                                CKEDITOR.replace( 'isi' );
                                                            </script>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
