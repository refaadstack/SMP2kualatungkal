@extends('layouts.master')
@section('title', 'Dashboard | SMP N 2 Kuala Tungkal')
@section('content')
    <div class="container-fluid">
        <h5 style="margin-bottom: 3rem">Selamat datang <i class="text-capitalize">{{ Auth::user()->name }}</i></h5>
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah siswa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $siswa }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Jumlah Guru</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $guru}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Earnings (Monthly) Card Example -->
           
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Jumlah Kelas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kelas }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-home fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Mata Pelajaran</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mapel }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- card --}}
        
                <div class="col-md-12 col">
                    <div class="card shadow" style="margin-bottom: 100px">
                        <h5 class="card-header bg-danger text-center text-white">PENGUMUMAN</h5>
                        <div class="card-body">                            
                            <h5 class="card-title">{{ $pengumuman->judul }}</h5>
                            <p class="card-text text-justify">{!! $pengumuman->isi !!}</p>
                        </div>
                    </div>
                </div>
    </div>    
@endsection