<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigation-label">Navigation</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ request()->is('superadmin') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-home"></i>
                        </span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="{{ request()->is('superadmin/list-sekolah') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.list-sekolah') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-school"></i>
                        </span>
                        <span class="pcoded-mtext">List Sekolah</span>
                    </a>
                </li>
                <li class="{{ request()->is('superadmin/slider') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.slider') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-images"></i>
                        </span>
                        <span class="pcoded-mtext">Slider</span>
                    </a>
                </li>
                <li class="@if (request()->is('superadmin/library') || request()->is('superadmin/library/setting')) pcoded-hasmenu active pcoded-trigger @else pcoded-hasmenu @endif">
                    <a href="#" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="icon-book-open"></i>
                        </span>
                        <span class="pcoded-mtext">Library</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{ request()->is('superadmin/library') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.library.index') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Tambah Baru</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/library/setting') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.library-setting') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Setting</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="@if (request()->is('superadmin/keuangan/tagihan') || request()->is('superadmin/keuangan/faktur') || request()->is('superadmin/keuangan/laporan')) pcoded-hasmenu active pcoded-trigger @else pcoded-hasmenu @endif">
                    <a href="#" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-newspaper"></i>
                        </span>
                        <span class="pcoded-mtext">Keuangan</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{ request()->is('superadmin/keuangan/tagihan') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.keuangan.tagihan') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Tagihan</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/keuangan/faktur') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.keuangan.faktur') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Faktur</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/keuangan/laporan') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.keuangan.laporan') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Laporan</span>
                            </a>
                        </li>
                    </ul>
                </li>
               
                <li class="@if (request()->is('superadmin/referensi/jenis-kelamin') || request()->is('superadmin/referensi/agama') || request()->is('superadmin/referensi/status-nikah') || request()->is('superadmin/referensi/provinsi') || request()->is('superadmin/referensi/kabupaten-kota') || request()->is('superadmin/referensi/kecamatan') || request()->is('superadmin/referensi/suku')) pcoded-hasmenu active pcoded-trigger @else pcoded-hasmenu @endif">
                    <a href="#" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-list-alt"></i>
                        </span>
                        <span class="pcoded-mtext">Referensi</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{ request()->is('superadmin/referensi/jenis-kelamin') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.referensi.jenis-kelamin') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Jenis Kelamin</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/referensi/agama') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.referensi.agama') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Agama</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/referensi/status-nikah') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.referensi.status-nikah') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Status Nikah</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/referensi/provinsi') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.referensi.provinsi') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Provinsi</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/referensi/kabupaten-kota') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.referensi.kabupaten-kota') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Kabupaten/Kota</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/referensi/kecamatan') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.referensi.kecamatan') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Kecamatan</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/referensi/suku') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.referensi.suku') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Suku</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/referensi/matapelajaran') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.referensi.matapelajaran') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Mata Pelajaran</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/referensi/tingkatpendidikan') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.referensi.tingkatpendidikan') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Tingkat Pendidikan</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="@if (request()->is('superadmin/kategori-berita') || request()->is('superadmin/berita/berita')) pcoded-hasmenu active pcoded-trigger @else pcoded-hasmenu @endif">
                    <a href="#" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-newspaper"></i>
                        </span>
                        <span class="pcoded-mtext">Berita</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{ request()->is('superadmin/berita/kategori-berita') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.berita.kategori-berita') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Kategori</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/berita/berita') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.berita.berita') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Berita</span>
                            </a>
                        </li>    
                    </ul>
                </li>
                <li class="@if (request()->is('superadmin/banksoal/soal'))pcoded-hasmenu active pcoded-trigger @else pcoded-hasmenu @endif">
                    <a href="javascript:void(0);" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="fa fa-square-root-alt"></i></span>
                        <span class="pcoded-mtext">Bank Soal</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="{{ request()->is('superadmin/banksoal/soal') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.banksoal.soal') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Soal</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/banksoal/butir-soal') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.banksoal.butir-soal') }}" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Butir Soal</span>
                            </a>
                        </li>                        
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>