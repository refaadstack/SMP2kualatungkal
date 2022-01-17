@extends('layouts.master')
@section('title','Profil Guru')
@section('content')
    <div class="content ml-4 mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid rounded" style="width: 200px; border-radius: 50%" src="{{$guru->getAvatar()}}" alt="User profile picture">
                            </div>
                
                        <h5 class="profile-username text-center text-capitalize">{{ $guru->nama }}</h5>
                
                        <p class="text-muted text-center">{{ $guru->email}}</p>
                
                        <ul class="list-group list-group-unbordered mb-6">
                            <li class="list-group-item">
                            <b>Tempat Lahir</b> <span class="float-right text-capitalize">{{ $guru->tempatlahir }}</span>
                            </li>
                            <li class="list-group-item">
                                <b>NIP</b> <span class="float-right text-capitalize">{{ $guru->nip }}</span>
                            </li>
                            <li class="list-group-item">
                                <b>NUPTK</b> <span class="float-right text-capitalize">{{ $guru->nuptk}}</span>
                            </li>
                            <li class="list-group-item">
                            <b>Tanggal Lahir</b> <span class="float-right text-capitalize">{{ $guru->tanggallahir}}</span>
                            </li>
                            <li class="list-group-item">
                            <b>Jenis Kelamin</b> <span class="float-right text-capitalize">{{ $guru->jeniskelamin }}</span>
                            </li>
                            <li class="list-group-item">
                            <b>Status Kepegawaian</b> <span class="float-right text-capitalize">{{ $guru->statuskepegawaian }}</span>
                            </li>
                            <li class="list-group-item">
                            <b>Jenjang</b> <span class="float-right text-capitalize">{{ $guru->jenjang }}</span>
                            </li>
                            <li class="list-group-item">
                            <b>Jurusan</b> <span class="float-right text-capitalize">{{ $guru->jurusan }}</span>
                            </li>
                            <li class="list-group-item">
                            <b>Sertifikasi</b> <span class="float-right text-capitalize">{{ $guru->sertifikasi }}</span>
                            </li>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                
            </div>
        </div>   
    </div>     
    
    
@endsection