<div class="modal fade modal-flex p-0" id="modal-butir-soal" tabindex="-1" role="dialog">
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
                <form id="form-butir-soal">
                    @csrf @method("POST")
                    <div class="row">
                        <input type="hidden" name="soal_id" value="{{ $soal_id }}">

                        <div class="col">
                            <div class="form-group">
                                <label for="point">Poin</label>
                                <input type="number" name="poin" id="point" class="form-control form-control-sm" value="1">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="question_type">Jenis Soal</label>
                                <select name="jenis_soal" id="question_type" class="form-control form-control-sm">
                                    <option value="">-- Pilih --</option>
                                    <option value="single-choice">Single choice</option>
                                    <option value="multiple-choice">Multiple choice</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="pertanyaan">Pertanyaan</label>
                                <textarea name="pertanyaan" id="pertanyaan" cols="10" rows="3" class="form-control form-control-sm" placeholder="Pertanyaan"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row answer" id="multiple-choice" style="display: none;">
                        <div class="col">
                            <div class="form-group m-0" id="answer-group">
                                <label>Jawaban</label>
                                <div id="answer-form0">
                                    <div class="row">
                                        <div class="col-8">
                                            <input type="text" name="jawaban[]" id="jawaban0" class="form-control form-control-sm mb-3">
                                        </div>
                                        <div class="col-4">
                                            <input type="radio" name="kunci_jawaban" value="A" class="d-inline-block">
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