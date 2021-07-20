<div class="modal fade modal-flex" id="modal-keuangan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Tambah Data Keuangan
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-keuangan" method="POST" enctype="multipart/form-data">
                    <div class="card bg-light">
                        <div class="card-header pb-0">
                            <h4 class="font-weight-bold text-info">Tagihan</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nomor_tagihan">Nomor Tagihan</label>
                                        <input type="text" name="nomor_tagihan" id="nomor_tagihan" class="form-control form-control-sm" placeholder="Nomor Tagihan">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nama_sekolah">Nama Sekolah</label>
                                        <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control form-control-sm" placeholder="Nama Sekolah">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="provinsi">Provinsi</label>
                                        <select name="provinsi" id="provinsi" class="form-control form-control-sm">
                                            <option value="">-- Pilih --</option>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="kabupaten_kota">Kabupaten / Kota</label>
                                        <select name="kabupaten_kota" id="kabupaten_kota" class="form-control form-control-sm">
                                            <option value="">-- Pilih --</option>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="biaya">Biaya</label>
                                        <input type="text" name="biaya" id="biaya" class="form-control form-control-sm" placeholder="Biaya" onkeyup="calculate()">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pembayaran">Metode Pembayaran</label>
                                        <select name="pembayaran" id="pembayaran" class="form-control form-control-sm">
                                            <option value="">-- Pilih --</option>
                                            <option value="">Transfer</option>
                                            <option value="">Cash</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tanggal_tagihan">Tanggal Tagihan</label>
                                        <input type="text" name="tanggal_tagihan" id="tanggal_tagihan" class="form-control form-control-sm"  readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control form-control-sm" id="keterangan" placeholder="Keterangan"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="ppn">PPN 10%</label>
                                        <input id="ppn" name="ppn" class="form-control form-control-sm" type="text" placeholder="PPN 10%" onkeyup="calculate()" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pph">PPH 1.5%</label>
                                        <input id="pph" name="pph" class="form-control form-control-sm" type="text" placeholder="PPH 1.5%" onkeyup="calculate()" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="siplah2">Siplah</label>
                                        <select name="siplah" id="siplah" class="form-control form-control-sm" onkeyup="calculate()">
                                            <option value="">-- Pilih --</option>
                                            <option value="ya">Ya</option>
                                            <option value="tidak">Tidak</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nama_kepsek">Kepala Sekolah</label>
                                        <input type="text" name="nama_kepsek" id="nama_kepsek" class="form-control form-control-sm" placeholder="Nama Kepala Sekolah">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nip_kepsek">NIP Kepala Sekolah</label>
                                        <input type="text" name="nip_kepsek" id="nip_kepsek" class="form-control form-control-sm" placeholder="NIP Kepala Sekolah">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nama_bendahara">Bendahara</label>
                                        <input type="text" name="nama_bendahara" id="nama_bendahara" class="form-control form-control-sm" placeholder="Nama Bendahara">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nip_bendahara">NIP Bendahara</label>
                                        <input type="text" name="nip_bendahara" id="nip_bendahara" class="form-control form-control-sm" placeholder="NIP Bendahara">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-light">
                        <div class="card-header pb-0">
                            <h4 class="font-weight-bold text-info">Faktur Penjualan</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="no_faktur">Nomor Faktur</label>
                                        <input type="text" name="no_faktur" id="no_faktur" class="form-control form-control-sm" placeholder="Nomor Tagihan">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="npwp">NPWP</label>
                                        <input type="text" name="npwp" id="npwp" class="form-control form-control-sm" placeholder="NPWP">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="jenis">Jenis Pesanan</label>
                                        <input type="text" class="form-control form-control-sm" id="jenis" placeholder="Jenis">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control form-control-sm" id="keterangan" placeholder="Keterangan"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="biaya">Biaya</label>
                                        <input type="text" name="biaya" id="biaya" class="form-control form-control-sm" placeholder="Biaya">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="total">Total Biaya</label>
                                        <input type="text" name="total" id="total" class="form-control form-control-sm" placeholder="Total Biaya">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tanggal_faktur">Tanggal Faktur</label>
                                        <input type="text" name="tanggal_faktur" id="tanggal_faktur" class="form-control form-control-sm" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="penerima">Penerima</label>
                                        <input type="text" name="penerima" id="penerima" class="form-control form-control-sm" placeholder="Penerima">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" name="nip" id="nip" class="form-control form-control-sm" placeholder="NIP Penerima">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-light">
                        <div class="card-header pb-0">
                            <h4 class="font-weight-bold text-info">Berita Acara</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="nama_pemesan">Nama Pemesan</label>
                                        <input type="text" name="nama_pemesan" id="nama_pemesan" class="form-control form-control-sm" placeholder="Nama Pemesan">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="jabatan">Jabatan</label>
                                        <input type="text" name="jabatan" id="jabatan" class="form-control form-control-sm" placeholder="Jabatan">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="kabupaten_kota">Kabupaten / Kota</label>
                                        <select name="kabupaten_kota" id="kabupaten_kota" class="form-control form-control-sm">
                                            <option value="">-- Pilih --</option>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="hari">Hari</label>
                                        <select class="form-control" id="hari" name="hari">
                                            <option value="">-- Pilih --</option>
                                            <option value="">Senin</option>
                                            <option value="">Selasa</option>
                                            <option value="">Rabu</option>
                                            <option value="">Kamis</option>
                                            <option value="">Jumat</option>
                                            <option value="">Sabtu</option>
                                            <option value="">Minggu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tanggal_berita_acara">Tanggal Berita Acara</label>
                                        <input type="text" name="tanggal_berita_acara" id="tanggal_berita_acara" class="form-control form-control-sm" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tanggal_surat">Tanggal Surat Pesanan</label>
                                        <input type="text" name="tanggal_surat" id="tanggal_surat" class="form-control form-control-sm" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi Barang</label>
                                        <textarea class="form-control form-control-sm" id="deskripsi" placeholder="Deskripsi"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control form-control-sm" id="keterangan" placeholder="Keterangan"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-light">
                        <div class="card-header pb-0">
                            <h4 class="font-weight-bold text-info">Pesanan</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="no_pesanan">Nomor Pesanan</label>
                                        <input type="text" name="no_pesanan" id="no_pesanan" class="form-control form-control-sm" placeholder="Nomor Pesanan">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="perihal">Perihal</label>
                                        <input type="text" name="perihal" id="perihal" class="form-control form-control-sm" placeholder="Perihal">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control form-control-sm" id="alamat" placeholder="Alamat"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email">E-Mail</label>
                                        <input type="text" name="email" id="email" class="form-control form-control-sm" placeholder="E-Mail">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="no_telp">Telp./HP</label>
                                        <input type="text" name="no_telp" id="no_telp" class="form-control form-control-sm" placeholder="Telp./HP">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="tanggal_pesanan">Tanggal Pesanan</label>
                                        <input type="text" name="tanggal_pesanan" id="tanggal_pesanan" class="form-control form-control-sm" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <input type="hidden" id="action" value="add">
                        <input type="submit" class="btn btn-sm btn-success" value="Simpan" id="btn">
                        <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal" id="btn-cancel">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
