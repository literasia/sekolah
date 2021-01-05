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
                <li class="pcoded-hasmenu pcoded-trigger">
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
            </ul>
        </div>
    </div>
</nav>