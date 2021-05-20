<div class="modal fade modal-flex" id="modal-sekolah" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Tambah Sekolah
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-sekolah" action="" method="POST" enctype="multipart/form-data">
                @csrf @method("POST")
                <div class="modal-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#data-sekolah" role="tab">Data Sekolah</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#add-ons" role="tab">Add-Ons</a>
                        </li>
                    </ul>
                    <div class="tab-content modal-body">
                        <div class="tab-pane active" id="data-sekolah" role="tabpanel">
                            @include('superadmin.modals._data-sekolah')
                        </div>
                        <div class="tab-pane" id="add-ons" role="tabpanel">
                            @include('superadmin.modals._add-ons')
                        </div>
                    </div> 
                </div>
                
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-right">
                                <input type="hidden" name="hidden_id" id="hidden_id">
                                <input type="hidden" id="action">
                                <input type="submit" class="btn btn-sm btn-success" value="Simpan" id="btn">
                                <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal" id="btn-cancel">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
