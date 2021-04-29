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
                                <select name="mata_pelajaran" id="mata_pelajaran" class="form-control form-control-sm">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" id="kelas" class="form-control form-control-sm">
                                    <option value=""></option>
                                </select>
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
                                <label for="keterangan">Materi</label>
                                <textarea name="keterangan" id="keterangan" cols="10" rows="3" class="form-control form-control-sm" placeholder="Keterangan" required></textarea>
                            </div>
                        </div>
                    </div>

                    <a class="text-info" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><span class="rotate">Tanggal Terbit <i class="fa fa-chevron-right rotate"></i></span></a>

                    <div class="collapse mt-2" id="collapseExample">
                        <div class="row" >
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="tanggal_terbit" id="tanggal_terbit" class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="poin_lama" id="poin_lama">
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <input type="hidden" id="action" val="add">
                        <input type="submit" class="btn btn-sm btn-outline-success" value="Simpan" id="btn">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
