<div class="modal fade modal-flex" id="modal-tagihan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Tambah Slider
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-slider" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nama_sekolah">Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control form-control-sm" placeholder="Nama Sekolah">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <select name="provinsi" id="provinsi" class="form-control form-control-sm">
                                    <option value="">-- Pilih --</option>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="kabupaten_kota">Kabupaten / Kota</label>
                                <select name="kabupaten_kota" id="kabupaten_kota" class="form-control form-control-sm">
                                    <option value="">-- Pilih --</option>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="biaya">Biaya</label>
                                <input type="text" name="biaya" id="biaya" class="form-control form-control-sm" placeholder="Biaya" onkeyup="calculate()">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="pembayaran">Metode Pembayaran</label>
                                <select name="pembayaran" id="pembayaran" class="form-control form-control-sm">
                                    <option value="">-- Pilih --</option>
                                    <option value="">Transfer</option>
                                    <option value="">Cash</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="ppn">PPN 10%</label>
                                <input id="ppn" name="ppn" class="form-control form-control-sm" type="text" placeholder="PPN 10%" onkeyup="calculate()" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="pph">PPH 1.5%</label>
                                <input id="pph" name="pph" class="form-control form-control-sm" type="text" placeholder="PPH 1.5%" onkeyup="calculate()" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="siplah2">Siplah</label>
                                <select name="siplah" id="siplah" class="form-control form-control-sm" onkeyup="calculate()">
                                    <option value="">-- Pilih --</option>
                                    <option value="ya">Ya</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <input type="hidden" id="action" value="add">
                        <input type="submit" class="btn btn-sm btn-success" value="Simpan" id="btn">
                        <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal" id="btn-cancel">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
