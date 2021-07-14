<div class="modal fade modal-flex p-0" id="modal-pengguna" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-pengguna">
                    Pengguna Forum
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-pengguna">
                    @csrf @method("POST")
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="forum_id">Peran</label>
                                <select name="role_id" id="role_id" class="form-control form-control-sm">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($role_forum as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <input type="hidden" id="action" val="add">
                        <input type="submit" class="btn btn-sm btn-success" value="Tambah" id="btn">
                        <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal" id="btn-cancel">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>