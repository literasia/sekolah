<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                <h5>Tingkat Kelas</h5>
                <button id="add-tingkat-btn" class="btn-add btn btn-primary btn-sm shadow-sm mb-3">Tambah</button>

                {{-- Form tambah --}}
                <div id="add-tingkat-container" class="add-container">
                    <form id="form-tingkat" method="POST" action="{{ route('superadmin.library-tingkat.index') }}">
                        @method('POST')
                        @csrf
                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="sub-kategori" class="mt-1">
                                        Unit:
                                    </label>
                                </div>
                            </div>

                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
                               <div class="form-group">
                                    <select name="name" id="unit" class="form-control form-control-sm unit">
                                        <option value="">-- Pilih Unit --</option>
                                        <option value="SD" class="unit-sd">SD</option>
                                        <option value="SMP" class="unit-smp">SMP</option>
                                        <option value="SMA" class="unit-sma">SMA</option>
                                        <option value="Umum" class="unit-umum">Umum</option>
                                    </select>                                    
                                    <span class="text-danger" id="sub_kategori_result"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row row-kelas SD SMP SMA Umum" id="row-kelas" style="display: none;">
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="sub-kategori" class="mt-1">
                                        Kelas:
                                    </label>
                                </div>
                            </div>

                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
                               <div class="form-group">
                                    <select name="tingkat" id="kelas" class="form-control form-control-sm kelas">
                                        <option value="">-- Pilih Unit --</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>                                    
                                    <span class="text-danger" id="sub_kategori_result"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                                <input type="submit" value="Simpan" class="btn btn-sm btn-success btn-block shadow-sm">
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Form update --}}
                <button id="cancel-tingkat-btn" class="btn-cancel btn btn-danger btn-sm shadow-sm mb-3">Batal</button>
                <div id="update-tingkat-container" class="update-container">
                    <form id="form-tingkat-update" method="POST" action="{{ route('superadmin.library-tingkat.index') }}">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="sub-kategori" class="mt-1">
                                        Unit:
                                    </label>
                                </div>
                            </div>

                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
                               <div class="form-group">
                                    <select name="name" id="unit-update" class="form-control form-control-sm unit">
                                        <option value="">-- Pilih Unit --</option>
                                        <option value="SD" class="unit-sd">SD</option>
                                        <option value="SMP" class="unit-smp">SMP</option>
                                        <option value="SMA" class="unit-sma">SMA</option>
                                        <option value="Umum" class="unit-umum">Umum</option>
                                    </select>                                    
                                    <span class="text-danger" id="sub_kategori_result"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row row-kelas SD SMP SMA Umum" id="row-kelas-update">
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="sub-kategori" class="mt-1">
                                        Kelas:
                                    </label>
                                </div>
                            </div>

                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
                               <div class="form-group">
                                    <select name="tingkat" id="kelas-update" class="form-control form-control-sm kelas">
                                        <option value="">-- Pilih Unit --</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>                                    
                                    <span class="text-danger" id="sub_kategori_result"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                                <input type="submit" value="Update" class="btn btn-sm btn-info btn-block shadow-sm">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-12">
                <hr>
                <table class="table table-sm table-bordered" id="table-tingkat">
                    <thead class="text-center">
                        <tr>
                            <th>No.</th>
                            <th>Unit</th>
                            <th>Tingkat</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($tingkats as $key => $tingkat)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $tingkat->name }}</td>
                                <td>{{ $tingkat->tingkat }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info shadow-sm" id="edit-tingkat" data-id="{{ $tingkat->id }}"><i class="fa fa-pencil-alt"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger shadow-sm" id="delete-tingkat"
                                        data-url="{{ route('superadmin.library-tingkat.destroy', $tingkat->id) }}" 
                                        data-toggle="modal" data-target="#confirmDeleteModal">
                                            <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
