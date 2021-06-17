<div class="modal fade modal-flex p-0" id="modal-topik" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Tambah Topik
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-topik">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="judul_topik">Judul Topik</label>
                                <input type="text" name="judul_topik" id="judul_topik" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <textarea name="keterangan_topik" id="keterangan_topik" cols="10" rows="3" class="form-control form-control-sm" placeholder="Keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type_id">Type</label>
                                <select name="type_id" id="type_id" class="form-control form-control-sm">
                                    <option value="">-- Pilih --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status_id">Status</label>
                                <select name="status_id" id="status_id" class="form-control form-control-sm">
                                    <option value="">-- Pilih --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="forum_id">Forum</label>
                                <select name="forum_id" id="forum_id" class="form-control form-control-sm">
                                    <option value="">-- Pilih --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="tautan">Tautan</label>
                                <input data-role="tautaninput" type="text" name="tautan" id="tautan" class="form-control form-control-sm">
                                    <div style="color: grey; font-size:80%">Pisahkan tautan topik dengan koma</div>
                            </div>
                        </div> 
                    </div>

                    <div class="modal-footer mt-3">
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <input type="hidden" id="action" val="add">
                        <input type="submit" class="btn btn-sm btn-success" value="Simpan" id="btn">
                        <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal" id="btn-cancel">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--  -->