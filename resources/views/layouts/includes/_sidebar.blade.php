<div id="sidebar-nav" class="sidebar" style="position: fixed; margin-top: -100px; height:1200px;">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav" style="margin-top: 105px;">
                <li>
                    <a href="{{ url('/dashboards') }}" class="">
                        <i class="fa fa-tachometer-alt"></i> <span>Dashboard</span>
                    </a>
                </li>
                @if (Auth::user()->level == 'admin' || Auth::user()->level == 'kepsek')
                    <li class="dropdown">
                        <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-user"></i> <span>Manajemen User</span> <i class="icon-submenu lnr lnr-chevron-left float-right"></i></a>
                        <div id="subPages" class="collapse">
                            <ul class="nav">
                                {{-- <li><a href="{{ route('admin.index') }}" class=""></i> <span>Data Admin</span></a></li> --}}
                                {{-- <li><a href="{{ route('kepsek.index') }}" class=""><span>Data Kepala Sekolah</span></a></li> --}}
                                <li><a href="{{ route('guru.index') }}" class=""></i> <span>Data Guru</span></a></li>
                                <li><a href="{{ route('siswa.index') }}" class=""><span>Data Siswa</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#subPages2" data-toggle="collapse" class="collapsed">
                            <i class="fas fa-clipboard"></i> <span>&nbsp;Manajemen Data</span>
                            <i class="icon-submenu lnr lnr-chevron-left float-right"></i>
                        </a>
                        <div id="subPages2" class="collapse">
                            <ul class="nav">
                                <li><a href="{{ route('pengumuman.index') }}" class=""><span>Pengumuman</span></a></li>
                                <li><a href="{{ route('mapel.index') }}" class=""><span>Data Mata Pelajaran</span></a></li>
                                <li><a href="{{ route('kelas.index') }}" class=""><span>Data Kelas</span></a></li>
                                <li><a href="{{ route('tahun_ajaran.index') }}" class=""><span>Tahun Ajaran</span></a></li>
                            </ul>
                        </div>
                    </li>
                @endif

                <!-- Jika Level User adalah Guru-->
                @if (Auth::user()->level == 'guru')
                    <li class="dropdown">
                        <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="fa fa-bars"></i> <span>Menu Utama</span> <i class="icon-submenu lnr lnr-chevron-left float-right"></i></a>
                        <div id="subPages" class="collapse">
                            <ul class="nav">
                                <li><a href="{{ route('materi.index') }}" class=""> <span>Manajemen Materi</span></a></li>
                                <li><a href="{{ route('agenda.index') }}" class=""><span>Agenda Kelas</span></a></li>
                                <li><a href="{{ route('tugas_siswa.index') }}" class=""><span>Manajemen Tugas Siswa</span></a></li>
                            </ul>
                        </div>
                    </li>
                @endif

                <!-- Jika Level User adalah Siswa -->
                @if (Auth::user()->level == 'siswa')
                    <li class="dropdown">
                        <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="fa fa-book"></i> <span>Pembelajaran</span> <i class="icon-submenu lnr lnr-chevron-left float-right"></i></a>
                        <div id="subPages" class="collapse">
                            <ul class="nav">
                                <li><a href="{{ route('list_mapel_siswa') }}" class=""> <span>Mata Pelajaran</span></a></li>
                                <li><a href="{{ route('agenda_siswa') }}" class=""><span>Agenda Siswa</span></a></li>
                            </ul>
                        </div>
                    </li>
                @endif
                <li><a href="{{ route('logout') }}" class=""><i class="lnr lnr-exit"></i> <span>LOGOUT</span></a></li>
            </ul>
        </nav>
    </div>
</div>
