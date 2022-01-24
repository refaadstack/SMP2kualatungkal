@extends('layouts.master')
@section('title','Profil')
@section('content')
    <div class="content ml-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 mt-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid rounded" style="width: 200px; border-radius: 50%" src="{{$siswa->getAvatar()}}" alt="User profile picture">
                            </div>

                        <h5 class="profile-username text-center text-capitalize">{{ $siswa->nama }}</h5>

                        <p class="text-muted text-center">{{ $siswa->email}}</p>

                        <ul class="list-group list-group-unbordered mb-6">
                            <li class="list-group-item">
                                <b>NISN</b> <span class="float-right text-capitalize">{{ $siswa->nisn}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>NIS</b> <span class="float-right text-capitalize">{{ $siswa->nis}}</span>
                            </li>
                            <li class="list-group-item">
                            <b>Tempat Lahir</b> <span class="float-right text-capitalize">{{ $siswa->tempatlahir }}</span>
                            </li>
                            <li class="list-group-item">
                            <b>Tanggal Lahir</b> <span class="float-right text-capitalize">{{ $siswa->tanggallahir}}</span>
                            </li>
                            <li class="list-group-item">
                            <b>Agama</b> <span class="float-right text-capitalize">{{ $siswa->agama }}</span>
                            </li>
                            <li class="list-group-item">
                            <b>Jenis Kelamin</b> <span class="float-right text-capitalize">{{ $siswa->jeniskelamin }}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Kelas</b> <span class="float-right text-capitalize">{{ $siswa->kelas->namakelas}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Nama Ayah</b> <span class="float-right text-capitalize">{{ $siswa->ayah}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Nama Ibu</b> <span class="float-right text-capitalize">{{ $siswa->ibu}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Pekerjaan Ayah</b> <span class="float-right text-capitalize">{{ $siswa->pekerjaanayah}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Pekerjaan Ibu</b> <span class="float-right text-capitalize">{{ $siswa->pekerjaanibu}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Alamat</b> <span class="float-right text-capitalize">{{ $siswa->alamat}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>HP</b> <span class="float-right text-capitalize">{{ $siswa->hp}}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Asal Sekolah</b> <span class="float-right text-capitalize">{{ $siswa->sekolah}}</span>
                            </li>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-8 mt-4">
                    <div class="container">
                        <div class="card">
                            <div class="card-header bg-danger text-white">
                                Nilai Mata Pelajaran
                                @if (auth()->user()->role == 'admin'||auth()->user()->role == 'guru')
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambah">
                                    + Tambah Data
                                </button>
                                    @if (auth()->user()->guru->walikelas == 'y' && auth()->user()->guru->id == $siswa->kelas->guru_id )    
                                    <a href="{{ route('konfirm',$siswa->id) }}" class="btn btn-warning float-right mr-2">Konfirmasi nilai</a>
                                    @endif
                                @endif
                            </div>
                            <div class="card-body">
                                @if (auth()->user()->role == 'admin')
                                <span><a href="{{ route('siswa.cetak_rapor_pdf',$siswa->id) }}" target="_blank" class="btn btn-success btn-sm mb-3">Cetak</a></span>
                                @endif
                                <table class="table table-bordered table-sm" id="dataTable" style="margin-top: 10px">
                                    <thead>
                                        <tr>
                                            <th scope="col">Kode</th>
                                            <th scope="col">Mata Pelajaran</th>
                                            <th scope="col">Semester</th>
                                            <th scope="col">Nilai</th>
                                            @if (auth()->user()->role == 'admin' || auth()->user()->guru->walikelas == 'y' && auth()->user()->guru->id == $siswa->kelas->guru_id )
                                            <th scope="col">Aksi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa->mapel as $obj)
                                        <tr>
                                            <td>{{ $obj->kode }}</td>
                                            <td>{{ $obj->nama }}</td>
                                            <td>{{  $obj->semester }}</td>
                                            <td>{{ $obj->pivot->nilai }}</td>
                                            @if (auth()->user()->role == 'admin')
                                            <td>
                                                <a href="#edit{{ $obj->id }}" class="btn btn-warning btn-sm" data-toggle="modal">Edit</a>
                                            
                                                <a href="#delete{{ $obj->id }}" class="btn btn-danger btn-sm" data-toggle="modal">Delete</a>
                                            </td>
                                            @endif
                                            @if (auth()->user()->role == 'guru')
                                            @if (auth()->user()->guru->walikelas == 'y' && auth()->user()->guru->id == $siswa->kelas->guru_id)
                                                    <td>
                                                        @if ($obj->pivot->status == 'sudah dikonfirmasi')
                                                        <small class="badge badge-success">{{ $obj->pivot->status }}</small>
                                                            
                                                        @else
                                                        <small class="badge badge-danger">{{ $obj->pivot->status }}</small>
                                                        @endif
                                                    </td>
                                                    @endif
                                            
                                            @endif
                                        </tr>

                                        {{-- modaledit --}}
                                        <div class="modal fade" id="edit{{ $obj->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit nilai {{ $obj->nama }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/siswa/{{ $siswa->id }}/updatenilai" method="POST">
                                                        {{ csrf_field() }}
                                                        {{-- {{method_field('put')}} --}}
                                                        <div class="form-group" hidden>
                                                            <label for="mapel">Pilih Mata Pelajaran</label>
                                                            <select class="form-control" id="mapel" name="mapel" required>
                                                                <option value="" selected disabled hidden>Pilih Mata Pelajaran</option>
                                                                @foreach ($matapelajaran as $mp)
                                                                <option class="text-capitalize text-dark" value="{{ $mp['id'] }}"  @if($obj->id == $mp['id']) selected @endif>{{ $mp['nama'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="nilai">Nilai</label>
                                                                <input type="number" min="0" max="100" name="nilai" class="form-control" value="{{ $obj->pivot->nilai }}"/>
                                                                {{-- <input type="number"  placeholder="Masukkan angka" min="0" max="100"> --}}
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </form>
                                                </div>
                                                <div class="modal-footer">
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                          {{-- end Modal edit --}}
                                          {{-- modal konfirmasi --}}
                                          <div class="modal fade" id="konfirmasi{{ $obj->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">konfirmasi {{ $obj->nama }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/siswa/{{ $siswa->id }}/konfirm" method="POST">
                                                        {{ csrf_field() }}
                                                        {{-- {{method_field('put')}} --}}
                                                        <div class="form-group" hidden>
                                                            <label for="mapel">Pilih Mata Pelajaran</label>
                                                            <select class="form-control" id="mapel" name="mapel" required>
                                                                <option value="" selected disabled hidden>Pilih Mata Pelajaran</option>
                                                                @foreach ($matapelajaran as $mp)
                                                                <option class="text-capitalize text-dark" value="{{ $mp['id'] }}"  @if($obj->id == $mp['id']) selected @endif>{{ $mp['nama'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="nilai">Nilai</label>
                                                                <input disabled type="number" min="0" max="100" name="nilai" class="form-control" value="{{ $obj->pivot->nilai }}"/>
                                                                {{-- <input type="number"  placeholder="Masukkan angka" min="0" max="100"> --}}
                                                        </div>
                                                        <input type="text" name="status" hidden value="sudah dikonfirmasi">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </form>
                                                </div>
                                                <div class="modal-footer">
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                          {{-- end konfirmasi --}}

                                        {{-- modal Hapus --}}

                                        <div class="modal fade" id="delete{{ $obj->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Hapus {{ $obj->nama }}</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <p>Anda yakin ingin menghapus data ini {{ $obj->nama }}</p>
                                                        <form action="/siswa/{{ $siswa->id }}/{{ $obj->id }}/deletenilai" method="POST">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            <div class="form-group">

                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Konfirmasi Hapus</button>
                                                        </form>
                                                       </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        {{-- end modal hapus --}}

                                        @endforeach
                                    </tbody>
                                    {{-- modal tambah --}}
                                    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai Mata Pelajaran</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <div class="modal-body">
                                                <form action="/siswa/{{ $siswa->id }}/addnilai" method="POST">
                                                  {{ csrf_field() }}
                                                    @if (auth()->user()->role == 'admin')
                                                    <div class="form-group">
                                                        <label for="mapel">Pilih Mata Pelajaran</label>
                                                        <select class="form-control" id="mapel" name="mapel" required>
                                                            <option value="" selected disabled hidden>Pilih Mata Pelajaran</option>

                                                            @foreach ($matapelajaran as $mp)
                                                            <option class="text-capitalize text-dark" value="{{$mp['id']}}">{{ $mp['nama'] }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    @elseif (auth()->user()->role == 'guru')
                                                    <div class="form-group">
                                                        <label for="mapel">Pilih Mata Pelajaran</label>
                                                        <select class="form-control" id="mapel" name="mapel" required>
                                                            <option value="" selected disabled hidden>Pilih Mata Pelajaran</option>
                                                            @foreach ($matapelajaran as $mp)
                                                            <option class="text-capitalize text-dark" value="{{$mp['id']}}">{{ $mp['nama'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    @endif
                                                    <div class="form-group">
                                                        <label for="nilai">Nilai</label>
                                                        <input type="number" min="0" max="100" name="nilai" class="form-control"/>
                                                        {{-- <input type="number"  placeholder="Masukkan angka" min="0" max="100"> --}}
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                  </form>
                                            </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      {{-- end modal tambah --}}
                                </table>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div id="chartNilai">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('javascript')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>

Highcharts.chart('chartNilai', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Laporan Nilai Siswa'
    },
    xAxis: {
        categories: {!! json_encode($categories) !!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Nilai'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:#ff0000;padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    colors: ['#ff4d4d'],
    series: [{
        name: 'Nilai',
        data: {!! json_encode($data) !!}

    }]
});

</script>
@endsection
