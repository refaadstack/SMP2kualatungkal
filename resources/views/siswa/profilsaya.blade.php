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
                                <b>NIPD</b> <span class="float-right text-capitalize">{{ $siswa->nipd}}</span>
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
                            </div>
                            <div class="card-body">
                                <span><a href="{{ route('siswa.cetak_rapor_pdf',$siswa) }}" target="_blank" class="btn btn-success btn-sm mb-3">Cetak</a></span>
                                
                                <table class="table" id="dataTable" style="margin-top: 10px">
                                    <thead>
                                        <tr>
                                            <th scope="col">Kode</th>
                                            <th scope="col">Mata Pelajaran</th>
                                            <th scope="col">Semester</th>
                                            <th scope="col">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa->mapel as $obj)    
                                        <tr>
                                            <td>{{ $obj->kode }}</td>
                                            <td>{{ $obj->nama }}</td>
                                            <td>{{  $obj->semester  }}</td>
                                            <td>{{ $obj->pivot->nilai }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
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