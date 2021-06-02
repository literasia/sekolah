<div class="modal fade modal-flex" id="modal-profile" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document"> 
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Profile
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-profile" enctype="multipart/form-data">
                    @csrf @method('POST')
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="id_sekolah">ID Sekolah:</label>
                                <input type="text" name="id_sekolah" id="profile_id_sekolah" class="form-control form-control-sm" placeholder="ID Sekolah" readonly>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="name">Nama Sekolah:</label>
                                <input type="text" name="name" id="profile_name" class="form-control form-control-sm" placeholder="Nama Sekolah" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="provinsi">Provinsi:</label>
                                <input type="text" name="provinsi" id="profile_provinsi" class="form-control form-control-sm" placeholder="Nama Sekolah" readonly>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="kabupaten">Kabupaten / Kota:</label>
                                <input type="text" name="kabupaten" id="profile_kabupaten" class="form-control form-control-sm" placeholder="Nama Sekolah" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="jenjang">Jenjang:</label>
                                <input type="text" name="jenjang" id="profile_jenjang" class="form-control form-control-sm" placeholder="Nama Sekolah" readonly>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="tahun_ajaran">T.A:</label>
                                <input type="text" name="tahun_ajaran" id="profile_tahun_ajaran" class="form-control form-control-sm" placeholder="Nama Sekolah" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="alamat">Alamat Sekolah:</label>
                                <textarea class="form-control form-control-sm" name="alamat" id="profile_alamat" rows="3" cols="10" placeholder="Alamat Sekolah"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="profile_username" class="form-control form-control-sm" placeholder="Username" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="file">Foto:</label>
                                <input type="file" name="logo" id="logo" class="d-block">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" id="password-lama-group">
                            <div class="form-group">
                                <label for="password">Password Lama:</label>
                                <input type="password" name="password_lama" id="password_lama" class="form-control form-control-sm" placeholder="Password">
                                <p class="form-text text-muted" id="old-password-message"></p>
                            </div>
                        </div>
                        <div class="col" id="password-baru-group">
                            <div class="form-group">
                                <label for="password">Password Baru:</label>
                                <input type="password" name="password_baru" id="password_baru" class="form-control form-control-sm" placeholder="Password">
                            </div>
                        </div>
                        <div class="col" id="password-konfirmasi-group">
                            <div class="form-group">
                                <label for="password">Konfirmasi Password:</label>
                                <input type="password" name="confirmation_password" id="password_konfirmasi" class="form-control form-control-sm" placeholder="Password">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <input type="submit" class="btn btn-sm btn-info" value="Update" id="btn"> --}}
                        <button type="submit" class="btn btn-sm btn-info" id="btnUpdate">Update</button>
                        <button type="button" class="btn btn-sm btn-outline-info" data-dismiss="modal" id="btnCancel">Batal</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

