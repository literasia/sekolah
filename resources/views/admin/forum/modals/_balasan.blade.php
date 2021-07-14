<div class="modal fade modal-flex p-0" id="modal-reply" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Tambah Balasan
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-reply">
                    @csrf @method("POST")
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="balasan">Isi Balasan</label>
                                <textarea name="komentar" id="komentar" class="form-control form-control-sm" placeholder="Isi Balasan"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="forum_id">Forum</label>
                                <select name="forum_id" id="forum_id" class="form-control form-control-sm">
                                    <option value="">-- Pilih --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="penulis_id">Penulis</label>
                                <select name="penulis_id" id="penulis_id" class="form-control form-control-sm">
                                    <option value="">-- Pilih --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="dibuat_pada_tanggal">Dibuat pada (Tanggal)</label>
                                <input type="text" name="dibuat_pada_tanggal" id="dibuat_pada_tanggal" class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="dibuat_pada_jam">Dibuat pada (Jam)</label>
                                <input type="text" name="dibuat_pada_jam" id="dibuat_pada_jam" class="form-control form-control-sm clockpicker" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <input type="hidden" name="poin_lama" id="poin_lama">
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <input type="hidden" id="action" val="add">
                        <input type="submit" class="btn btn-sm btn-success" value="Tambah" id="btn">
                        <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal" id="btn-cancel">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>