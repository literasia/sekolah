@extends('layouts.admin')

{{-- config 1 --}}
@section('title', 'Pelajaran | Jadwal Pelajaran')
@section('title-2', 'Jadwal Pelajaran')
@section('title-3', 'Jadwal Pelajaran')

@section('describ')
    Ini adalah halaman jadwal pelajaran untuk admin
@endsection

@section('icon-l', 'fa fa-list-alt')
@section('icon-r', 'icon-home')

@section('link')
    {{ route('admin.pelajaran.jadwal-pelajaran') }}
@endsection

{{-- main content --}}
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="card-block">
                        <div class="dt-responsive">

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="jk">Kelas</label>
                                        <select name="jk" id="jk" class="form-control form-control-sm">
                                            <option disabled="" value="">-- Kelas --</option>
                                            <option value="Laki-Laki">XII</option>
                                            <option value="Perempuan">X TKJ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="agama">Pelajaran</label>
                                        <select name="agama" id="agama" class="form-control form-control-sm">
                                            <option disabled="" value="">-- Pelajaran --</option>
                                            <option value="Islam">PPKN | Nama Guru</option>
                                            <option value="Budha">Penjas | Nama Guru</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="is_menikah">Hari</label>
                                        <select name="is_menikah" id="is_menikah" class="form-control form-control-sm">
                                            <option disabled="" value="">-- Hari --</option>
                                            <option value="1">Senin</option>
                                            <option value="0">Minggu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="jk">Semester</label>
                                        <select name="jk" id="jk" class="form-control form-control-sm">
                                            <option disabled="" value="">-- Semester --</option>
                                            <option value="Laki-Laki">Ganjil</option>
                                            <option value="Perempuan">Genap</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="agama">Tahun Ajaran</label>
                                        <select name="agama" id="agama" class="form-control form-control-sm">
                                            <option disabled="" value="">-- Tahun Ajaran --</option>
                                            <option value="Islam">2019/2020</option>
                                            <option value="Budha">2020/2021</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label id="lblketerangan" class="bmd-label-floating">Keterangan</label>
                                    <span class="bmd-form-group"><textarea name="keterangan" id="keterangan" class="form-control" autocomplete="off"></textarea></span>
                                  </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <label>Jam Ke</label>
                                    </div>
                                  </div>
                                  <div class="row" style="margin-top: -10px;">
                                    <div class="col-sm-6">
                                        <div id="side_left"><div class="form-check"><label class="form-check-label"><input class="form-check-input" id="id_jp0" type="checkbox" value="6934328">00 (07:30 - 08:00) <span class="form-check-sign"><span class="check"></span></span></label></div><div class="form-check"><label class="form-check-label"><input class="form-check-input" id="id_jp1" type="checkbox" value="6934329">01 (08:00 - 08:45) <span class="form-check-sign"><span class="check"></span></span></label></div><div class="form-check"><label class="form-check-label"><input class="form-check-input" id="id_jp2" type="checkbox" value="6934330">02 (08:45 - 09:30) <span class="form-check-sign"><span class="check"></span></span></label></div><div class="form-check"><label class="form-check-label"><input class="form-check-input" id="id_jp3" type="checkbox" value="6934331">03 (09:30 - 10:15) <span class="form-check-sign"><span class="check"></span></span></label></div><div class="form-check"><label class="form-check-label"><input class="form-check-input" id="id_jp4" type="checkbox" value="6934332"> (10:15 - 10:30) <span class="form-check-sign"><span class="check"></span></span></label></div><div class="form-check"><label class="form-check-label"><input class="form-check-input" id="id_jp5" type="checkbox" value="6934333">04 (10:30 - 11:15) <span class="form-check-sign"><span class="check"></span></span></label></div><div class="form-check"><label class="form-check-label"><input class="form-check-input" id="id_jp6" type="checkbox" value="6934334">05 (11:15 - 12:00) <span class="form-check-sign"><span class="check"></span></span></label></div></div>
                                    </div>
                                    <div class="col-sm-6" id="side_right"><div class="form-check"><label class="form-check-label"><input class="form-check-input" id="id_jp7" type="checkbox" value="6934335"> (12:00 - 12:15) <span class="form-check-sign"><span class="check"></span></span></label></div><div class="form-check"><label class="form-check-label"><input class="form-check-input" id="id_jp8" type="checkbox" value="6934336">06 (12:15 - 13:00) <span class="form-check-sign"><span class="check"></span></span></label></div><div class="form-check"><label class="form-check-label"><input class="form-check-input" id="id_jp9" type="checkbox" value="6934337">07 (13:00 - 13:45) <span class="form-check-sign"><span class="check"></span></span></label></div><div class="form-check"><label class="form-check-label"><input class="form-check-input" id="id_jp10" type="checkbox" value="6934338"> (13:45 - 14:00) <span class="form-check-sign"><span class="check"></span></span></label></div><div class="form-check"><label class="form-check-label"><input class="form-check-input" id="id_jp11" type="checkbox" value="6934339">08 (14:00 - 14:45) <span class="form-check-sign"><span class="check"></span></span></label></div><div class="form-check"><label class="form-check-label"><input class="form-check-input" id="id_jp12" type="checkbox" value="6934341">09 (14:45 - 15:30) <span class="form-check-sign"><span class="check"></span></span></label></div></div>
                                  </div>
                                </div>
                              </div>
                              <br>
                              <div class="row">
                                <div class="col">
                                    <input type="hidden" name="hidden_id" id="hidden_id">
                                    <button type="submit" class="btn btn-sm btn-outline-success">Simpan</button>
                                    <button type="reset" class="btn btn-sm btn-danger">Batal</button>
                                </div>
                            </div>


                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="card-block">
                        <div class="dt-responsive ">




                            <div class="row">
                                <div class="col">
                                    <label for="nama_calon">Tampil Jadwal</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="jk">Kelas</label>
                                    <select name="jk" id="jk" class="form-control form-control-sm">
                                        <option value="">-- Kelas --</option>
                                        <option value="Laki-Laki">XII</option>
                                        <option value="Perempuan">X TKJ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="jk">Semester</label>
                                    <select name="jk" id="jk" class="form-control form-control-sm">
                                        <option value="">-- Semester --</option>
                                        <option value="Laki-Laki">Ganjil</option>
                                        <option value="Perempuan">Genap</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="agama">Tahun Ajaran</label>
                                    <select name="agama" id="agama" class="form-control form-control-sm">
                                        <option value="">-- Tahun Ajaran --</option>
                                        <option value="Islam">2019/2020</option>
                                        <option value="Budha">2020/2021</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                <input type="submit" class="btn btn-sm btn-outline-success" value="Tampil" id="tampil">
                            </div>
                            </div>
                        </div>


                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="row" id="showjpcard">
        <div class="col-md-12">

        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                  <h4 class="card-title">Senin</h4>
                </div>
              </div>
              <div class="card-body ">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr>
                        <th>Les</th>
                        <th>Jadwal</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="senin" data="1">
                             <tr class="senin1">
                               <td>01</td>
                               <td>Pendidikan Agama Islam</td>
                               <td>
                               <div class="dropdown dropright show">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown" aria-expanded="true">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 <div class="ripple-container"></div></button>
                               <div class="dropdown-menu show" style="margin: auto; position: absolute; top: -56px; left: -21px; will-change: top, left;" x-placement="top-start">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(17);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin2">
                               <td>02</td>
                               <td>Pendidikan Agama Islam</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(19);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin3">
                               <td>03</td>
                               <td>Pendidikan Agama Islam</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(18);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin4">
                               <td>04</td>
                               <td>Seni Budaya</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(20);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin5">
                               <td>05</td>
                               <td>Seni Budaya</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(21);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin6">
                               <td>06</td>
                               <td>Seni Budaya</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(22);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin7">
                               <td>07</td>
                               <td>Bahasa Inggris</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(23);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin8">
                               <td>08</td>
                               <td>Bahasa Inggris</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(24);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin9">
                               <td>09</td>
                               <td>Bahasa Inggris</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(25);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>

                             </tr></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                  <h4 class="card-title">Selasa</h4>
                </div>
              </div>
              <div class="card-body ">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr>
                        <th>Les</th>
                        <th>Jadwal</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="selasa" data="1">
                             <tr class="senin1">
                               <td>01</td>
                               <td>PPKn</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(35);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin2">
                               <td>02</td>
                               <td>PPKn</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(36);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin3">
                               <td>03</td>
                               <td>PJOK</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(37);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin4">
                               <td>04</td>
                               <td>PJOK</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(38);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin5">
                               <td>05</td>
                               <td>Kimia</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(39);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin6">
                               <td>06</td>
                               <td>Kimia</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(40);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin7">
                               <td>07</td>
                               <td>Kimia</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(41);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin8">
                               <td>08</td>
                               <td>Komputer dan Jaringan Dasar</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(42);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin9">
                               <td>09</td>
                               <td>Komputer dan Jaringan Dasar</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(43);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>

                             </tr></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                  <h4 class="card-title">Rabu</h4>
                </div>
              </div>
              <div class="card-body ">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr>
                        <th>Les</th>
                        <th>Jadwal</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="rabu" data="1">
                             <tr class="senin1">
                               <td>01</td>
                               <td>Dasar Desain Grafis</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(53);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin2">
                               <td>02</td>
                               <td>Dasar Desain Grafis</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(54);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin3">
                               <td>03</td>
                               <td>Dasar Desain Grafis</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(55);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin4">
                               <td>04</td>
                               <td>Matematika</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(56);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin5">
                               <td>05</td>
                               <td>Matematika</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(57);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin6">
                               <td>06</td>
                               <td>Sistem Komputer</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(58);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin7">
                               <td>07</td>
                               <td>Sistem Komputer</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(59);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin8">
                               <td>08</td>
                               <td>Bahasa Indonesia</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(60);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin9">
                               <td>09</td>
                               <td>Bahasa Indonesia</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(61);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>

                             </tr></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                  <h4 class="card-title">Kamis</h4>
                </div>
              </div>
              <div class="card-body ">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr>
                        <th>Les</th>
                        <th>Jadwal</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="kamis" data="1">
                             <tr class="senin1">
                               <td>01</td>
                               <td>Komputer dan Jaringan Dasar</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(62);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin2">
                               <td>02</td>
                               <td>Komputer dan Jaringan Dasar</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(63);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin3">
                               <td>03</td>
                               <td>Sejarah Indonesia</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(64);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin4">
                               <td>04</td>
                               <td>Sejarah Indonesia</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(65);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin5">
                               <td>05</td>
                               <td>Sejarah Indonesia</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(66);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin6">
                               <td>06</td>
                               <td>Matematika</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(67);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin7">
                               <td>07</td>
                               <td>Matematika</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(68);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin8">
                               <td>08</td>
                               <td>Simulasi Dan Komunikasi Digital</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(69);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin9">
                               <td>09</td>
                               <td>Simulasi Dan Komunikasi Digital</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(70);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin10">
                               <td>10</td>
                               <td>Simulasi Dan Komunikasi Digital</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(71);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>

                             </tr></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                  <h4 class="card-title">Jumat</h4>
                </div>
              </div>
              <div class="card-body ">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr>
                        <th>Les</th>
                        <th>Jadwal</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="jumat" data="1">
                             <tr class="senin1">
                               <td>01</td>
                               <td>Fisika</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(112);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin2">
                               <td>02</td>
                               <td>Fisika</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(113);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin3">
                               <td>03</td>
                               <td>Fisika</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(114);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin4">
                               <td>04</td>
                               <td>Bahasa Indonesia</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(115);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin5">
                               <td>05</td>
                               <td>Bahasa Indonesia</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(116);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>

                             </tr></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                  <h4 class="card-title">Sabtu</h4>
                </div>
              </div>
              <div class="card-body ">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr>
                        <th>Les</th>
                        <th>Jadwal</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="sabtu" data="1">
                             <tr class="senin1">
                               <td>01</td>
                               <td>Mulok</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(93);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin2">
                               <td>02</td>
                               <td>Mulok</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(94);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin3">
                               <td>03</td>
                               <td>Mulok</td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(95);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin4">
                               <td>04</td>
                               <td>Pemograman Dasar </td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(96);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin5">
                               <td>05</td>
                               <td>Pemograman Dasar </td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(97);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>


                             </tr><tr class="senin6">
                               <td>06</td>
                               <td>Pemograman Dasar </td>
                               <td>
                               <div class="dropdown dropright">
                                 <button type="button" class="btn btn-just-icon btn-white btn-fab btn-round" data-toggle="dropdown">
                                   <i class="material-icons text_align-center">more_vert</i>
                                 </button>
                               <div class="dropdown-menu" style="margin: auto;">
                                 <button type="button" class="btn btn-link btn-danger " onclick="del_jadwal(98);"><i class="material-icons">delete</i></button>
                               </div>
                               </div>
                               </td>

                             </tr>
                            </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        </div>
      </div>

    @endsection

{{-- addons css --}}
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <style>
        .btn i {
            margin-right: 0px;
        }
    </style>
@endpush

{{-- addons js --}}
@push('js')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>



    <script>
        $(document).ready(function () {
            $('#order-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.pelajaran.mata-pelajaran') }}",
                },
                columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'guru',
                    name: 'guru'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
                ]
            });

            $('#form-pelajaran').on('submit', function (event) {
                event.preventDefault();
                var url = '';

                if ($('#action').val() == 'add') {
                    url = "{{ route('admin.pelajaran.mata-pelajaran') }}";
                    text = "Data sukses ditambahkan";
                }

                if ($('#action').val() == 'edit') {
                    url = "{{-- route('admin.pelajaran.mata-pelajaran-update') --}}";
                    text = "Data sukses diupdate";
                }

                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'JSON',
                    data: $(this).serialize(),
                    success: function (data) {
                        var html = '';
                        if (data.errors) {
                            // for (var count = 0; count <= data.errors.length; count++) {
                            html = data.errors[0];
                            // }
                            $('#pelajaran').addClass('is-invalid');
                            toastr.error(html);
                        }

                        if (data.success) {
                            toastr.success('Data sukses ditambahkan');
                            $('#pelajaran').removeClass('is-invalid');
                            $('#form-pelajaran')[0].reset();
                            $('#action').val('add');
                            $('#btn')
                                .removeClass('btn-outline-info')
                                .addClass('btn-outline-success')
                                .val('Simpan');
                            $('#order-table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                });
            });


            $(document).on('click', '.tampil', function () {
            var x = document.getElementById("showjpcard");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            });

            $(document).on('click', '.edit', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: '/admin/referensi/mata-pelajaran/'+id,
                    dataType: 'JSON',
                    success: function (data) {
                        console.log(data.pelajaran);
                        $('#pelajaran').val(data.pelajaran.name);
                        $('#hidden_id').val(data.pelajaran.id);
                        $('#action').val('edit');
                        $('#btn')
                            .removeClass('btn-outline-success')
                            .addClass('btn-outline-info')
                            .val('Update');
                    }
                });
            });

            var user_id;
            $(document).on('click', '.delete', function () {
                user_id = $(this).attr('id');
                $('#ok_button').text('Hapus');
                $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function () {
                $.ajax({
                    url: '/admin/referensi/mata-pelajaran/hapus/'+user_id,
                    beforeSend: function () {
                        $('#ok_button').text('Menghapus...');
                    }, success: function (data) {
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            $('#order-table').DataTable().ajax.reload();
                            toastr.success('Data berhasil dihapus');
                        }, 1000);
                    }
                });
            });
        });
    </script>
@endpush
