<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="soal_id">Soal</label>
            <select name="soal_id" id="soal_id" class="form-control form-control-sm">
                <option value="">-- Pilih --</option>
                @foreach ($soal as $item)
                    <option value="{{ $item->id }}">{{ $item->judul }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="guru_id">Guru</label>
            <select name="guru_id" id="guru_id" class="form-control form-control-sm">
                <option value="">-- Pilih --</option>
                @foreach ($guru as $item)
                    <option value="{{ $item->id }}">{{ $item->pegawai->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="jenis_kuis">Jenis Kuis</label>
            <select name="jenis_kuis" id="jenis_kuis" class="form-control form-control-sm">
                <option value="">-- Pilih --</option>
                <option value="latihan">Latihan</option>
                <option value="ulangan">Ulangan</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" cols="10" rows="3" class="form-control form-control-sm" placeholder="Keterangan"></textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="jumlah_soal_pg">Jumlah Soal Pilihan Berganda</label>
            <input type="number" id="jumlah_soal_pg" name="jumlah_soal_pg" class="form-control form-control-sm">
        </div>
    </div>

</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="text" name="tanggal_mulai" id="tanggal_mulai" class="form-control form-control-sm" readonly>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai</label>
            <input type="text" name="tanggal_selesai" id="tanggal_selesai" class="form-control form-control-sm" readonly>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="jam_mulai">Jam Mulai</label>
            <input type="text" name="jam_mulai" id="jam_mulai" class="form-control form-control-sm clockpicker" readonly>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="jam_selesai">Jam Selesai</label>
            <input type="text" name="jam_selesai" id="jam_selesai" class="form-control form-control-sm clockpicker" readonly>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="durasi">Durasi</label>
            <div class="row">
                <div class="col-7 pr-0">
                    <input type="number" value="1" name="durasi" id="durasi" class="form-control form-control-sm">
                </div>
                <div class="col-5 pl-0">
                    <select  id="duration" class="form-control form-control-sm duration-option">
                        <option value="menit">Menit</option>
                        <option value="jam">Jam</option>
                        <option value="hari">Hari</option>
                        <option value="minggu">Minggu</option>
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
                <option value="Draf">Draf</option>
                <option value="Terbitkan">Terbitkan</option>
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
                            <label for="jam_terbit">Jam</label>
                            <input type="text" name="jam_terbit" id="jam_terbit" class="form-control form-control-sm clockpicker" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
