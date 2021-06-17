<div class="modal fade modal-flex" id="modal-qr-code" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah QR Code</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-qr-code">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="qr_name">Nama Kode QR</label>
                                        <input type="text" name="qr_name" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="location">Lokasi</label>
                                        <input type="text" name="location" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="location">Radius</label>
                                        <input type="number" name="location" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="longtitude">Longtitude</label>
                                        <input type="text" name="longtitude" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="langtitude">Langtitude</label>
                                        <input type="text" name="langtitude" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_id" id="hidden_id">
                    <input type="hidden" id="action">
                    <input type="submit" class="btn btn-sm btn-success" value="Simpan" id="btn">
                    <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal" id="btn-cancel">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
