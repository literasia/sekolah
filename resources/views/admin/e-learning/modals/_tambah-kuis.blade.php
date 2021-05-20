<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="judul">Judul Kuis</label>
            <input type="text" name="judul" id="judul" class="form-control form-control-sm" placeholder="Judul Kuis" >
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="jenis_kuis">Jenis Kuis</label>
            <select name="jenis_kuis" id="jenis_kuis" class="form-control form-control-sm">
                <option value="">-- Pilih --</option>
                <option value="">Latihan</option>
                <option value="">Ulangan</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="mata_pelajaran">Mata Pelajaran</label>
            <input type="text" name="mata_pelajaran" id="mata_pelajaran" class="form-control form-control-sm" readonly>
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="kelas">Kelas</label>
            <input type="text" name="kelas" id="kelas" class="form-control form-control-sm" readonly>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="guru">Nama Guru</label>
            <input type="text" name="guru" id="guru" class="form-control form-control-sm" readonly>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" cols="10" rows="3" class="form-control form-control-sm" placeholder="Keterangan" required></textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="duration">Durasi</label>
            <div class="row">
                <div class="col-7 pr-0">
                    <input type="number" value="1" name="duration" id="duration" class="form-control form-control-sm">
                </div>
                <div class="col-5 pl-0">
                    <select name="duration" id="duration" class="form-control form-control-sm duration-option">
                        <option value="">Menit</option>
                        <option value="">Jam</option>
                        <option value="">Hari</option>
                        <option value="">Minggu</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control form-control-sm">
                <option value="">-- Pilih --</option>
                <option value="">Draf</option>
                <option value="">Terbitkan</option>
            </select>
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <a class="text-info rotate-collapse" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Tanggal Terbit <i class="fa fa-chevron-right rotate ml-1"></i></a>
            <div class="collapse mt-2" id="collapseExample">
                <div class="row" >
                    <div class="col-md-6 pr-0">
                        <div class="form-group">
                            <label for="tanggal_terbit">Tanggal</label>
                            <input type="text" name="tanggal_terbit" id="tanggal_terbit" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jam">Jam</label>
                            <input type="text" name="tanggal_terbit" id="tanggal_terbit" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
