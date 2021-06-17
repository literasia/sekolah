<div class="modal fade modal-flex" id="modal-pengguna" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>
                    Ubah Peran Forum
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-pengguna" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="pf">Peran Form</label>
                                <select name="pf" id="pf" class="form-control form-control-sm">
                                    <option value="">-- Peran Form --</option>
                                    <option value="Key_master">Key master</option>
                                    <option value="Moderator">Moderator</option>
                                    <option value="Participant">Participant</option>
                                    <option value="Blocked">Blocked</option>
                                </select>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_id" id="hidden_id">
                    <input type="hidden" id="action" val="add">
                    <input type="submit" class="btn btn-sm btn-success" value="Simpan" id="btn">
                    <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal" id="btn-cancel">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
