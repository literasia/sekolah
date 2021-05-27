<div class="modal fade modal-flex p-0" id="modal-soal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Tambah Soal
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-soal" action="" method="">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="point">Poin</label>
                                <input type="number" name="point" id="point" class="form-control form-control-sm" value="1">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="question_type">Jenis Soal</label>
                                <select name="question_type" id="question_type" class="form-control form-control-sm">
                                    <option value="">-- Pilih --</option>
                                    <option value="single-choice">Single choice</option>
                                    <option value="multiple-choice">Multiple choice</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="quiz_name">Nama Kuis</label>
                                <select name="quiz_name" id="quiz_name" class="form-control form-control-sm">
                                    <option value="">-- Pilih --</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="questions">Pertanyaan</label>
                                <textarea name="questions" id="questions" cols="10" rows="3" class="form-control form-control-sm" placeholder="Pertanyaan" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row answer" id="multiple-choice" style="display: none;">
                        <div class="col">
                            <div class="form-group m-0" id="questions-group">
                                <label for="questions">Jawaban</label>
                                <div id="questions-form1">
                                    <div class="row">
                                        <div class="col-8">
                                            <input type="text" name="point" id="point1" class="form-control form-control-sm mb-3">
                                        </div>
                                        <div class="col-4">
                                            <input type="checkbox" name="" class="d-inline-block">
                                            <p class="ml-2 d-inline-block">Jawaban yang benar</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 1.25em">
                                <div class="col-12">
                                    <input type='button' value='Tambah Jawaban' id='addButton' class="btn btn-primary btn-sm">
                                    <input type='button' value='Hapus Jawaban' id='removeButton' class="btn btn-outline-primary btn-sm">
                                </div>
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
                                                <label for="publish_date">Tanggal</label>
                                                <input type="text" name="publish_date" id="publish_date" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="time">Jam</label>
                                                <input type="text" name="time" id="time" class="form-control form-control-sm clockpicker" readonly>
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