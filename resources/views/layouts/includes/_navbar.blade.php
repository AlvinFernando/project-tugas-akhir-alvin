<nav class="navbar navbar-default navbar-fixed-top p-2">
    <div class="brand">
        <a href="index.html">
            <img src="{{ asset('assets/img/favicon_io/logo elearning skpk.png') }}" alt="Klorofil Logo"
            class="img-responsive logo" style="width: 190px; margin-top:-5px;">
        </a>
    </div>
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth">
                <i class="lnr lnr-arrow-left-circle"></i>
            </button>
        </div>
        <div id="navbar-menu">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle mr-3 text-right" data-toggle="dropdown" >
                        {{-- foto admin --}}
                        @if (Auth::user()->level == 'admin')
                            @if (Auth::user()->admin->getProfile())
                                <img src="{{ Auth::user()->admin->getProfile() }}"
                                class="img-circle" alt="foto profil" style="width: 30px; height: 30px;">
                            @else
                                <img src="{{ asset('images/default.jpg') }}"
                                class="img-circle" alt="foto profil" style="width: 30px; height: 30px;">
                            @endif

                        {{-- foto Guru --}}
                        @elseif (Auth::user()->level == 'guru')
                            @if (Auth::user()->guru->getProfile())
                                <img src="{{ Auth::user()->guru->getProfile() }}"
                                class="img-circle" alt="foto profil" style="width: 30px; height: 30px;">
                            @else
                                <img src="{{ asset('images/default.jpg') }}"
                                class="img-circle" alt="foto profil" style="width: 30px; height: 30px;">
                            @endif

                        {{-- foto Kepsek --}}
                        @elseif (Auth::user()->level == 'kepsek')
                            @if (Auth::user()->kepsek->getProfile())
                                <img src="{{ asset('images/miss_rachel.jpg') }}"
                                class="img-circle" alt="foto profil" style="width: 30px; height: 30px;">
                            @else
                                <img src="{{ asset('images/default.jpg') }}"
                                class="img-circle" alt="foto profil" style="width: 30px; height: 30px;">
                            @endif

                        {{-- Foto Siswa --}}
                        @elseif (Auth::user()->level == 'siswa')
                            @if (Auth::user()->siswa->getProfile())
                                <img src="{{ Auth::user()->siswa->getProfile() }}"
                                class="img-circle" alt="foto profil" style="width: 30px; height: 30px;">
                            @else
                                <img src="{{ asset('images/default.jpg') }}"
                                class="img-circle" alt="foto profil" style="width: 30px; height: 30px;">
                            @endif
                        @endif


                        <span>{{ Auth::user()->name }}</span> -
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
                        <i class="icon-submenu lnr lnr-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        {{-- Jika User sebagai Guru --}}
                        @if (Auth::user()->level == 'guru')
                            <li>
                                <a href="{{ route('biodata_guru', Auth::user()->id) }}">
                                    <i class="lnr lnr-user"></i> <span>Profil Saya</span>
                                </a>
                            </li>
                        @endif

                        {{-- Jika User sebagai Siswa --}}
                        @if (Auth::user()->level == 'siswa')
                            <li>
                                <a href="{{ route('biodata_siswa', Auth::user()->id) }}">
                                    <i class="lnr lnr-user"></i> <span>My Profile</span>
                                </a>
                            </li>
                        @endif

                        <li><a href="{{ route('logout') }}"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                    </ul>
                </li>
                <!-- <li>
                <a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
                </li> -->
            </ul>
        </div>
    </div>
</nav>
