<div class="modal fade modal-flex p-0" id="modal-kuis" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-kuis-ku">
                @csrf @method("POST")
                <div class="modal-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tambah-ujian" role="tab">Keterangan Ujian</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#pengaturan-ujian" role="tab">Pengaturan</a>
                        </li>
                    </ul>
                    <div class="tab-content modal-body">
                        <div class="tab-pane active" id="tambah-ujian" role="tabpanel">
                            @include('admin.cbt.modals._tambah-ujian')
                        </div>
                        <div class="tab-pane" id="pengaturan-ujian" role="tabpanel">
                            @include('admin.cbt.modals._pengaturan-ujian')
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
