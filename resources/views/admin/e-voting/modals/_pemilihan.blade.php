<div class="modal fade modal-flex" id="modal-pemilihan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Tambah Pemilihan
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-pemilihan">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                            <label for="posisi">Kelas</label>
                                <select name="posisi" id="posisi" class="form-control form-control-sm">
                                    <option selected disabled class="pilih">-- Pilih --</option>
                                    <option value="Ketua Osis" class="ketua_osis">Ketua Osis</option>
                                    <option value="Ketua Kelas" class="ketua_kelas">Ketua Kelas</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" id="kelas" class="form-control form-control-sm">
                                    <option selected disabled>-- Pilih --</option>
                                    @foreach($kelas as $k)
                                    <option value="{{ $k->id }}" id="{{ $k->id }}" class="k">{{ $k->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nama_calon">Nama Calon</label>
                                <select name="nama_calon[]" id="nama_calon" class="form-control form-control-sm" multiple>
                                    <option value="">-- Pilih --</option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="tanggal_mulai">Start Date</label>
                                <input id="tanggal_mulai" name="tanggal_mulai" class="form-control form-control-sm" type="text" placeholder="Start Date" readonly />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="tanggal_selesai">End Date</label>
                                <input id="tanggal_selesai" name="tanggal_selesai" class="form-control form-control-sm" type="text" placeholder="End Date" readonly />
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
</div>