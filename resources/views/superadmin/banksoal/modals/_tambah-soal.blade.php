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
                <form id="form-soal">
                    @csrf @method("POST")
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" name="judul" id="judul" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mata_pelajaran">Mata Pelajaran</label>
                                <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="form-control form-control-sm">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($mata_pelajaran as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_pelajaran }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tingkat">Tingkat Pendidikan</label>
                                <select name="tingkat_id" id="tingkat_id" class="form-control form-control-sm">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($tingkat as $item)
                                        <option value="{{ $item->id }}">{{ $item->tingkat }} - {{ $item->name }} </option>
                                    @endforeach
                                </select>
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