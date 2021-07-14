<div class="modal fade modal-flex p-0" id="modal-forum" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Tambah Forum
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-forum">
                    @csrf @method("POST")
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" name="judul" id="judul" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="total_balasan">Total Balasan</label>
                                <input type="text" name="total_balasan" id="total_balasan" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="privasi">Privasi</label>
                                <input type="text" name="privasi" id="privasi" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="topik_id">Topik</label>
                                <select name="topik_id" id="topik_id" class="form-control form-control-sm">
                                    <option value="">-- Pilih --</option>
                                    @foreach($topiks as $topik)
                                    <option value="{{ $topik->id }}">{{ $topik->judul }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id">Penulis</label>
                                <select name="user_id" id="user_id" class="form-control form-control-sm">
                                    <option value="">-- Pilih --</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <!-- <input type="hidden" name="poin_lama" id="poin_lama"> -->
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