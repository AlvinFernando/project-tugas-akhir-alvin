@if (Auth::user()->level == 'admin' || Auth::user()->level == 'kepsek')
      <div class="col-md-4">
            <div class="metric bg-danger">
                  <span class="icon"><i class="fa fa-user"></i></span>
                  <p>
                        <span class="number text-light">{{ $guru->count() }}</span>
                        <span class="title text-light">Guru</span>
                  </p>
            </div>
      </div>
      <div class="col-md-4">
            <div class="metric bg-success">
                  <span class="icon"><i class="fa fa-users"></i></span>
                  <p>
                        <span class="number text-light">{{ $siswa->count() }}</span>
                        <span class="title text-light">Siswa</span>
                  </p>
            </div>
      </div>
      <div class="col-md-4">
            <div class="metric bg-primary">
                  <span class="icon"><i class="fa fa-book"></i></span>
                  <p>
                        <span class="number">{{ $mapel->count() }}</span>
                        <span class="title">Mata Pelajaran</span>
                  </p>
            </div>
      </div>
@endif
@if (Auth::user()->level == 'guru')
      <div class="col-md-3">
            <div class="metric bg-danger">
                  <span class="icon"><i class="fa fa-user"></i></span>
                  <p>
                        <span class="number text-light">{{ $siswa->count() }}</span>
                        <span class="title text-light">Siswa</span>
                  </p>
            </div>
      </div>
      <div class="col-md-3">
            <div class="metric bg-warning">
                  <span class="icon"><i class="fa fa-users"></i></span>
                  <p>
                        <span class="number text-light" style="color: rgb(31, 31, 31)">{{ $mapel->count() }}</span>
                        <span class="title text-light" style="color: rgb(31, 31, 31)">Mata Pelajaran</span>
                  </p>
            </div>
      </div>
      <div class="col-md-3">
            <div class="metric bg-success text-light">
                  <span class="icon"><i class="fa fa-book"></i></span>
                  <p>
                        <span class="number">{{ $materi->count() }}</span>
                        <span class="title">Materi</span>
                  </p>
            </div>
      </div>
      <div class="col-md-3">
            <div class="metric bg-primary">
                  <span class="icon"><i class="fa fa-file-alt"></i></span>
                  <p>
                        <span class="number">0</span>
                        <span class="title">Tugas Siswa</span>
                  </p>
            </div>
      </div>
@endif
