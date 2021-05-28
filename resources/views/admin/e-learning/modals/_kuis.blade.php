<div class="modal fade modal-flex p-0" id="modal-kuis" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Tambah Kuis
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-materi" action="" method="">

                <div class="modal-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tambah-kuis" role="tab">Keterangan Kuis</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#pengaturan-kuis" role="tab">Pengaturan</a>
                        </li>
                    </ul>
                    <div class="tab-content modal-body">
                        <div class="tab-pane active" id="tambah-kuis" role="tabpanel">
                            @include('admin.e-learning.modals._tambah-kuis')
                        </div>
                        <div class="tab-pane" id="pengaturan-kuis" role="tabpanel">
                            @include('admin.e-learning.modals._pengaturan-kuis')
                        </div>
                    </div> 
                </div>
                    
                <div class="modal-footer mt-3">
                    <input type="hidden" name="poin_lama" id="poin_lama">
                    <input type="hidden" name="hidden_id" id="hidden_id">
                    <input type="hidden" id="action" val="add">
                    <input type="submit" class="btn btn-sm btn-success" value="Simpan" id="btn">
                    <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal" id="btn-cancel">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
