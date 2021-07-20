<div class="card">
    <div class="card-header card-header-rose card-header-text">
      <div class="card-text">
        <h4 class="card-title">{{ $hari }}</h4>
      </div>
    </div>
    <div class="card-body ">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>Les</th>
              <th>Jadwal</th>
            </tr>
          </thead>
          <tbody id="{{$hari}}">
            @foreach($data as $key => $obj)
                <tr>
                    <td>
                      @if(!empty($obj->jamPelajaran->jam_ke))
                        {{$obj->jamPelajaran->jam_ke}}
                      @endif
                    </td>
                    <td>{{$obj->mataPelajaran->nama_pelajaran ?? ''}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
