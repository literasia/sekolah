<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                    <label for="id_sekolah">ID Sekolah:</label>
                    <input type="text" name="id_sekolah" id="id_sekolah" class="form-control form-control-sm" placeholder="ID Sekolah">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                    <label for="name">Nama Sekolah:</label>
                    <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Nama Sekolah">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="alamat">Alamat Sekolah:</label>
                    <textarea class="form-control form-control-sm" name="alamat" id="alamat" rows="3" cols="10" placeholder="Alamat Sekolah"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                    <label for="provinsi">Provinsi:</label>
                    <select name="provinsi" id="provinsi" class="form-control form-control-sm">
                        <option value="">-- Provinsi --</option>
                        @foreach($provinsis as $provinsi)
                        <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                    <label for="kabupaten">Kabupaten / Kota:</label>
                    <select name="kabupaten" id="kabupaten" class="form-control form-control-sm">
                        <option value="">-- Kabupaten / Kota --</option>
                        @foreach($kabupaten as $kab)
                        <option value="{{ $kab->id }}">{{ $kab->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                    <label for="jenjang">Jenjang:</label>
                    <select name="jenjang" id="jenjang" class="form-control form-control-sm">
                        <option value="">-- Jenjang --</option>
                        <option value="SMA">SMA</option>
                        <option value="SMK">SMK</option>
                        <option value="SMP">SMP</option>
                        <option value="SD">SD</option>
                    </select>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                    <label for="tahun_ajaran">T.A:</label>
                    <select name="tahun_ajaran" id="tahun_ajaran" class="form-control form-control-sm">
                        <option value="">-- T.A --</option>
                        <option value="2020-2021">2020/2021</option>
                        <option value="2021-2022">2021/2022</option>
                        <option value="2022-2023">2022/2023</option>
                        <option value="2023-2024">2023/2024</option>
                        <option value="2024-2025">2024/2025</option>
                        <option value="2025-2026">2025/2026</option>
                        <option value="2026-2027">2026/2027</option>
                        <option value="2027-2028">2027/2028</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" class="form-control form-control-sm" placeholder="Username">
                </div>
            </div>
            <div class="col" id="default-password-group">
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="Password">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="file">Pilih File:</label>
                    <input type="file" name="logo" id="logo">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col" id="password-lama-group">
                <div class="form-group">
                    <label for="password">Password Lama:</label>
                    <input type="password" name="password_lama" id="password_lama" class="form-control form-control-sm" placeholder="Password">
                    <p class="form-text text-muted" id="old-password-message"></p>
                </div>
            </div>
            <div class="col" id="password-baru-group">
                <div class="form-group">
                    <label for="password">Password Baru:</label>
                    <input type="password" name="password_baru" id="password_baru" class="form-control form-control-sm" placeholder="Password">
                </div>
            </div>
            <div class="col" id="password-konfirmasi-group">
                <div class="form-group">
                    <label for="password">Konfirmasi Password:</label>
                    <input type="password" name="confirmation_password" id="password_konfirmasi" class="form-control form-control-sm" placeholder="Password">
                </div>
            </div>
        </div>
    </div>
</div>