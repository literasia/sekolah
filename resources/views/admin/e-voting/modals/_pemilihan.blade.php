<div class="modal fade modal-flex" id="modal-pemilihan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Tambah Pemilihan
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
                                <label for="nama_calon">Nama Calon</label>
                                <select name="nama_calon[]" id="nama_calon" class="form-control form-control-sm" multiple>
                                    <option value="">-- Pilih --</option>
                                    <option value="Setia">Setia</option>
                                    <option value="Budi">Budi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="posisi">Posisi</label>
                                <select name="posisi" id="posisi" class="form-control form-control-sm">
                                    <option value="">Pilih</option>
                                    <option value="Position 1">Position 1</option>
                                    <option value="Position 2">Position 2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="tanggal_mulai">Start Date</label>
                                <input id="tanggal_mulai" name="tanggal_mulai" class="form-control form-control-sm" type="text" placeholder="Start Date" readonly />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tanggal_selesai">End Date</label>
                                <input id="tanggal_selesai" name="tanggal_selesai" class="form-control form-control-sm" type="text" placeholder="End Date" readonly />
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