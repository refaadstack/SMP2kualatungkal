@extends('layouts.master')
@section('title','Transkrip Nilai')
@section('content')
    <div class="container mb-5">
    <div class="card mt-2 mb-3">
        <div class="card-header bg-danger text-white">
            Identitas Siswa
        </div>
        <div class="card-body">
            <p>Nama  : <span class="text-capitalize">{{ $siswa->nama }}</span></p>
            <p>Kelas : {{ $siswa->kelas->namakelas }}</p>
            <p>NISN  : {{ $siswa->nisn }}</p>
            <p>Jenis kelamin  : {{ $siswa->jeniskelamin }}</p>
            <p>NIPD  : {{ $siswa->nis }}</p>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Kode MP</th>
            <th scope="col">Mata Pelajaran</th>
            <th scope="col">Nilai</th>
        </tr>
        <tr>
            <th colspan="4" class="bg-gradient-danger text-white"> Semester 1</th>
        </tr>
        </thead>
        <tbody>
            <tr>
            @foreach ($semester1 as $key)
            <td>{{$loop->iteration}}</td>
            <td>{{$key->kode}}</td>
            <td>{{$key->nama}}</td>
            <td>{{$key->pivot->nilai}}</td>
            @endforeach
            </tr>
        </tbody>
        <thead>
        <tr>
            <th colspan="4" class="bg-gradient-danger text-white"> Semester 2</th>
        </tr>
        </thead>
        <tbody>
            <tr>
            @foreach ($semester2 as $key)
            <td>{{$loop->iteration}}</td>
            <td>{{$key->kode}}</td>
            <td>{{$key->nama}}</td>
            <td>{{$key->pivot->nilai}}</td>
            @endforeach
            </tr>
        </tbody>
        <thead>
        <tr>
            <th colspan="4" class="bg-gradient-danger text-white"> Semester 3</th> 
        </tr>
        </thead>
        <tbody>
            <tr>
            @foreach ($semester3 as $key)
            <td>{{$loop->iteration}}</td>
            <td>{{$key->kode}}</td>
            <td>{{$key->nama}}</td>
            <td>{{$key->pivot->nilai}}</td>
            @endforeach
            </tr>
        </tbody>
        <thead>
        <tr>
            <th colspan="4" class="bg-gradient-danger text-white"> Semester 4</th> 
        </tr>
        </thead>
        <tbody>
            <tr>
            @foreach ($semester4 as $key)
            <td>{{$loop->iteration}}</td>
            <td>{{$key->kode}}</td>
            <td>{{$key->nama}}</td>
            <td>{{$key->pivot->nilai}}</td>
            @endforeach
            </tr>
        </tbody>
        <thead>
        <tr>
            <th colspan="4" class="bg-gradient-danger text-white"> Semester 5</th> 
        </tr>
        </thead>
        <tbody>
            <tr>
            @foreach ($semester5 as $key)
            <td>{{$loop->iteration}}</td>
            <td>{{$key->kode}}</td>
            <td>{{$key->nama}}</td>
            <td>{{$key->pivot->nilai}}</td>
            @endforeach
            </tr>
        </tbody>
        <thead>
        <tr>
            <th colspan="4" class="bg-gradient-danger text-white"> Semester 6</th> 
        </tr>
        </thead>
        <tbody>
            <tr>
            @foreach ($semester6 as $key)
            <td>{{$loop->iteration}}</td>
            <td>{{$key->kode}}</td>
            <td>{{$key->nama}}</td>
            <td>{{$key->pivot->nilai}}</td>
            @endforeach
            </tr>
        </tbody>

    </table>
    </div>
@endsection