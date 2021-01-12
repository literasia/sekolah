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
                <li class="@if (request()->is('superadmin/library/tambah-buku')) pcoded-hasmenu active pcoded-trigger @else pcoded-hasmenu @endif">
                    <a href="#" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-book"></i>
                        </span>
                        <span class="pcoded-mtext">Library</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="#" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Tambah Baru</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Buku Audio</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Buku Video</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Buku Digital</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Kategori</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Tipe</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="@if (request()->is('superadmin/referensi/jenis-kelamin')) pcoded-hasmenu active pcoded-trigger @else pcoded-hasmenu @endif">
                    <a href="#" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="icon-list"></i>
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
                            <a href="#" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Agama</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/referensi/status-nikah') ? 'active' : '' }}">
                            <a href="#" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Status Nikah</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/referensi/provinsi') ? 'active' : '' }}">
                            <a href="#" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Provinsi</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/referensi/kabupaten-kota') ? 'active' : '' }}">
                            <a href="#" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Kabupaten/Kota</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/referensi/kecamatan') ? 'active' : '' }}">
                            <a href="#" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Kecamatan</span>
                            </a>
                        </li>
                        <li class="{{ request()->is('superadmin/referensi/suku') ? 'active' : '' }}">
                            <a href="#" class="waves-effect waves-dark">
                                <span class="pcoded-mtext">Suku</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>