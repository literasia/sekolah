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
                        <span class="pcoded-mtext">Dashboard Siswa</span>
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
                <li class="{{ request()->is('siswa/pelanggaran') ? 'active' : '' }}">
                    <a href="#" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-vote-yea"></i>
                        </span>
                        <span class="pcoded-mtext">Pelanggaran</span>
                    </a>
                </li>
                <li class="{{ request()->is('siswa/perpustakaan') ? 'active' : '' }}">
                    <a href="#" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-book"></i>
                        </span>
                        <span class="pcoded-mtext">Perpustakaan</span>
                    </a>
                </li>
                <li class="{{ request()->is('siswa/cbt') ? 'active' : '' }}">
                    <a href="#" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-vote-yea"></i>
                        </span>
                        <span class="pcoded-mtext">CBT</span>
                    </a>
                </li>
                <li class="{{ request()->is('siswa/e-learning') ? 'active' : '' }}">
                    <a href="#" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-vote-yea"></i>
                        </span>
                        <span class="pcoded-mtext">E-Learning</span>
                    </a>
                </li>
                <li class="{{ request()->is('siswa/leaderboard') ? 'active' : '' }}">
                    <a href="#" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-vote-yea"></i>
                        </span>
                        <span class="pcoded-mtext">Leaderboard</span>
                    </a>
                </li>
                <li class="{{ request()->is('siswa/kalender') ? 'active' : '' }}">
                    <a href="#" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-vote-yea"></i>
                        </span>
                        <span class="pcoded-mtext">Kalender</span>
                    </a>
                </li>
                <li class="{{ request()->is('siswa/pengumuman') ? 'active' : '' }}">
                    <a href="#" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-vote-yea"></i>
                        </span>
                        <span class="pcoded-mtext">Pengumuman</span>
                    </a>
                </li>
                <li class="{{ request()->is('siswa/nilai') ? 'active' : '' }}">
                    <a href="#" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-vote-yea"></i>
                        </span>
                        <span class="pcoded-mtext">Nilai</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>