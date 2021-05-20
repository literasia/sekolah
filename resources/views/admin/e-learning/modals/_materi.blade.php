<div class="modal fade modal-flex p-0" id="modal-materi" tabindex="-1" role="dialog"> 
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Tambah Materi
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-materi" action="" method="">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="judul">Judul Materi</label>
                                <input type="text" name="judul" id="judul" class="form-control form-control-sm" placeholder="Judul Materi" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="mata_pelajaran">Mata Pelajaran</label>
                                <input type="text" name="mata_pelajaran" id="mata_pelajaran" class="form-control form-control-sm" readonly>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <input type="text" name="kelas" id="kelas" class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="guru">Nama Guru</label>
                                <input type="text" name="guru" id="guru" class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="materi">Materi</label>
                                <textarea name="materi" id="materi" cols="10" rows="3" class="form-control form-control-sm" placeholder="Materi" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="">-- Pilih --</option>
                                    <option value="">Draf</option>
                                    <option value="">Terbitkan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <a class="text-info rotate-collapse" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Tanggal Terbit <i class="fa fa-chevron-right rotate ml-1"></i></a>
                                <div class="collapse mt-2" id="collapseExample">
                                    <div class="row" >
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_terbit">Tanggal</label>
                                                <input type="text" name="tanggal_terbit" id="tanggal_terbit" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="jam">Jam</label>
                                                <input type="text" name="tanggal_terbit" id="tanggal_terbit" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                </form>
            </div>
        </div>
    </div>
</div>
<!--  -->