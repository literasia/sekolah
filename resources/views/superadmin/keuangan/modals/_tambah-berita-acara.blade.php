<div class="modal fade modal-flex" id="modal-berita-acara" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Tambah Faktur
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-berita-acara" method="POST" enctype="multipart/form-data">
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
                                <label for="nama_sekolah">Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control form-control-sm" placeholder="Nama Sekolah">
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
                                <label for="tanggal">Tanggal</label>
                                <input type="text" name="tanggal" id="tanggal" class="form-control form-control-sm" readonly>
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
                                <label for="jenis">Jenis Pesanan</label>
                                <input type="text" class="form-control form-control-sm" id="jenis" placeholder="Jenis">
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
                                <input type="text" name="nip" id="nip" class="form-control form-control-sm" placeholder="NIP">
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