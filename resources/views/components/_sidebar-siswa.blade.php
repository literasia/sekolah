<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigation-label">Navigation</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ request()->is('siswa') ? 'active' : '' }}">
                    <a href="{{ route('siswa.index') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-home"></i>
                        </span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="{{ request()->is('siswa/pelajaran') ? 'active' : '' }}">
                    <a href="{{ route('siswa.pelajaran.jadwal-pelajaran') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-book"></i>
                        </span>
                        <span class="pcoded-mtext">Jadwal Pelajaran</span>
                    </a>
                </li>

                <li class="{{ request()->is('siswa/nilai') ? 'active' : '' }}">
                     <a href="{{ route('siswa.nilai.nilai-siswa') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-medal"></i>
                        </span>
                        <span class="pcoded-mtext">Nilai</span>
                    </a>
                </li>

                <li class="{{ request()->is('siswa/absensi') ? 'active' : '' }}">
                    <a href="{{ route('siswa.absensi.absensi-siswa') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-clipboard-list"></i>
                        </span>
                        <span class="pcoded-mtext">Absensi</span>
                    </a>
                </li>

                <li class="{{ request()->is('siswa/pelanggaran') ? 'active' : '' }}">
                    <a href="{{ route('siswa.pelanggaran.siswa') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-exclamation-triangle"></i>
                        </span>
                        <span class="pcoded-mtext">Pelanggaran</span>
                    </a>
                </li>

                <li class="{{ request()->is('siswa/e-voting') ? 'active' : '' }}">
                    <a href="{{ route('siswa.e-voting.e-voting') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-vote-yea"></i>
                        </span>
                        <span class="pcoded-mtext">E-Voting</span>
                    </a>
                </li>

                <li class="{{ request()->is('siswa/kalender') ? 'active' : '' }}">
                    <a href="{{ route('siswa.kalender.kalender-akademik') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <span class="pcoded-mtext">Kalender</span>
                    </a>
                </li>
                <li class="{{ request()->is('siswa/pengumuman') ? 'active' : '' }}">
                     <a href="{{ route('siswa.pengumuman.pengumuman') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-bell"></i>
                        </span>
                        <span class="pcoded-mtext">Pengumuman</span>
                    </a>
                </li>
                <li class="{{ request()->is('siswa/perpustakaan') ? 'active' : '' }}">
                    <a href="{{ route('siswa.perpustakaan.perpustakaan') }}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-book"></i>
                        </span>
                        <span class="pcoded-mtext">Perpustakaan</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
