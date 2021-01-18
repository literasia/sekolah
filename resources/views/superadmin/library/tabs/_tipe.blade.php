<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-12">
                @if (session('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h5>Tipe Buku</h5>
                <form id="form-tipe">
                    @csrf
                    <div class="row">
                        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
                            <div class="form-group">
                                <input type="text" name="tipe" id="tipe" class="form-control" placeholder="Tipe">
                                <span class="text-danger" id="tipe_result"></span>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2">
                            <input type="hidden" name="hidden_id">
                            <input type="hidden" value="add" id="action">
                            <input type="submit" value="Simpan" class="btn btn-sm btn-success btn-block shadow-sm">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xl-12">
                <hr>
                <table class="table table-sm table-bordered" id="table-tipe">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Tipe</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($tipes as $key => $tipe)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $tipe->name }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info shadow-sm edit"><i class="fa fa-pencil-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>