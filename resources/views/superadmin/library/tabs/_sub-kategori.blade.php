<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <h5>Sub Kategori Buku</h5>
                <button id="add-sub-kategori-btn" class="btn-add btn btn-primary btn-sm shadow-sm mb-3">Tambah</button>

                {{-- Form tambah --}}
                <div id="add-sub-kategori-container" class="add-container">
                    <form id="form-sub-kategori" method="POST" action="" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="sub-kategori" class="mt-1">
                                        Kategori:
                                    </label>
                                </div>
                            </div>

                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
                               <div class="form-group">
                                    <select name="kategori" id="kategori" class="form-control form-control-sm">
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value=""></option>
                                    </select>                                    
                                    <span class="text-danger" id="sub_kategori_result"></span>
                                </div>
                            </div>

                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="sub-kategori" class="mt-1">
                                        Sub Kategori:
                                    </label>
                                </div>
                            </div>

                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
                               <div class="form-group">
                                    <input type="text" name="sub-kategori" id="sub-kategori" class="form-control" placeholder="Sub Kategori">
                                    <span class="text-danger" id="sub_kategori_result"></span>
                                </div>
                            </div>

                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                                <input type="submit" value="Simpan" class="btn btn-sm btn-success btn-block shadow-sm">
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Form update --}}
                <button id="cancel-sub-kategori-btn" class="btn-cancel btn btn-outline-success btn-sm shadow-sm mb-3">Batal</button>
                <div id="update-sub-kategori-container" class="update-container">
                    <form id="form-sub-kategori-update" method="POST" action="" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="sub-kategori" class="mt-1">
                                        Kategori:
                                    </label>
                                </div>
                            </div>

                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
                               <div class="form-group">
                                    <input type="text" name="sub-kategori" id="sub-kategori-update" class="form-control" placeholder="Kategori">
                                    <span class="text-danger"></span>
                                </div>
                            </div>

                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
                                <input type="file" class="form-control form-control-sm" name="thumbnail" id="thumbnail-sub-kategori-update" accept="image/*" value="" autocomplete="off">
                            </div>

                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                                <input type="submit" value="Update" class="btn btn-sm btn-info btn-block shadow-sm">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-12">
                <hr>
                <table class="table table-sm table-bordered" id="table-sub-kategori">
                    <thead class="text-center">
                        <tr>
                            <th>No.</th>
                            <th>Kategori</th>
                            <th>Sub Kategori</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <!-- <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info shadow-sm" id="edit-sub-kategori" data-id=""><i class="fa fa-pencil-alt"></i></button>
                                <button type="button" class="btn btn-sm btn-danger shadow-sm" id="delete-sub-kategori" data-url="" data-toggle="modal" data-target="#confirmDeleteModal"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr> -->
                        <tr><td colspan="4">Tidak ada data</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>