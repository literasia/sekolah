<div class="modal fade modal-flex" id="modal-guru" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Tambah Pelanggaran
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nama_guru">Guru</label>
                                <select name="nama_guru" id="nama_guru" class="form-control form-control-sm">
                                    <option value="">-- Guru --</option>
                                    <option value="5935792">Fraya Dira Hutabarat</option>
                                    <option value="5935745">Lestari Juwita</option>
                                    <option value="5935747">Surya Syahputra</option>
                                    <option value="5935791">Yoga Sanjaya</option>
                                    <option value="5935749">Robby Yetsun Jaya</option>
                                    <option value="5935790">Nuril Akhyar</option>
                                    <option value="5935789">Dwi Renggani</option>
                                    <option value="5935752">Reza Al Kautsar Lubis</option>
                                    <option value="5935788">Raju Siregar</option>
                                    <option value="5935787">Ainul Mardhiah</option>
                                    <option value="5935755">Mutiara Efendi Nst</option>
                                    <option value="5935756">Mirna Muzdalifah</option>
                                    <option value="5935757">Astika Andryani Nst</option>
                                    <option value="5935758">Maysarani Harahap</option>
                                    <option value="5935759">Nur Kholidah Rangkuti</option>
                                    <option value="5935760">Zurriyah</option>
                                    <option value="5935761">Suaidah</option>
                                </select>
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="status_guru">Status Guru</label>
                                <select name="status_guru" id="status_guru" class="form-control form-control-sm">
                                    <option value="">-- Status Guru --</option>
                                    <option value="Guru Tetap">Guru Tetap</option>
                                    <option value="Guru Tidak Tetap">Guru Tidak Tetap</option>
                                    <option value="Guru Honor">Guru Honor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="aktif">Status</label>
                                <select name="aktif" id="aktif" class="form-control form-control-sm">
                                    <option value="">-- Status --</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
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
                                <label for="foto">Foto Pegawai</label>
                                <input type="file" name="foto" id="foto" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-outline-success">Simpan</button>
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>