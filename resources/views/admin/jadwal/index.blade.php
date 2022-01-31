@extends('layouts.master')
@section('title','Data Jadwal')
@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 text-gray-800">Data Jadwal SMP Negeri 2 Kuala Tungkal</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-dark">JADWAL</h5> 
            @if (auth()->user()->role == 'admin')
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambah">
              + Tambah Data
            </button>    
            @endif 
        </div>
        <div class="card-header py-6">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th> No</th>
                            <th >Nama Kelas</th>
                            <th >Wali Kelas</th>
                            @if (auth()->user()->role == 'admin')
                            <th >Aksi</th>
                            @endif 

                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($kelas as $kelas) 
                        <tr>
                            <td style="width: 20px">{{ $loop->iteration }}</td>
                            <td class="text-capitalize"><a href="{{ route('jadwal.show',$kelas->id) }}">{{ $kelas->namakelas }}</a></td>
                            <td class="text-capitalize">{{ $kelas->guru->nama}}</td>
                            @if (auth()->user()->role == 'admin')
                            <td>
                              {{-- <a href="#edit{{$kelas->id}}" class="btn btn-warning btn-sm text-center" data-toggle="modal">Edit</a> --}}
                              <a href="{{ route('jadwal.show',$kelas->id) }}" class="btn btn-success btn-sm text-center">Details</a>
                            </td>                      
                            @endif 
                        </tr>
                        {{-- start modal delete --}} 
                        {{-- <div class="modal fade" id="delete{{$kelas->id}}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Apakah Anda yakin menghapus data <b>"{{ $kelas->namakelas }}"?</b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="form-group">

                                    <form action="{{ route('kelas.destroy',$kelas->id) }}" method="POST">
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
                        </div> --}}
                        {{-- end modal hapus--}}
                          @endforeach
                    </tbody>
                    <!-- ModalTambah -->
                      <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Tambah data jadwal</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="modal-body">
                                <form action="{{ route('jadwal.store') }}" method="POST" class="needs-validation" novalidate>
                                  {{ csrf_field() }}
                                    <div class="form-group">
                                      <label for="kelas_id">Pilih Kelas </label>
                                      <select class="form-control" name="kelas_id" required>
                                          <option value="" selected disabled hidden>Pilih Kelas</option>
                                          @foreach ($kelas2 as $kelas)
                                          <option class="text-capitalize" value="{{ $kelas->id}}">{{ $kelas->namakelas }}</option>    
                                          @endforeach
                                      </select> 
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">Kelas tidak boleh kosong!</div>
                                    </div> 
                                    <div class="form-group">
                                      <label for="hari">Pilih Hari</label>
                                      <select class="form-control" name="hari" required>
                                          <option value="" selected disabled hidden>Pilih Hari</option>
                                          <option class="text-capitalize" value="senin">Senin</option>    
                                          <option class="text-capitalize" value="selasa">Selasa</option>    
                                          <option class="text-capitalize" value="rabu">Rabu</option>    
                                          <option class="text-capitalize" value="kamis">Kamis</option>    
                                          <option class="text-capitalize" value="jumat">Jumat</option>    
                                          <option class="text-capitalize" value="sabtu">Sabtu</option>    
                                          
                                      </select> 
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">Kelas tidak boleh kosong!</div>
                                    </div> 

                                    <div class="form-group">
                                     <label for="mapel_id">Pilih Mata Pelajaran</label>
                                     <select class="form-control" name="mapel_id" required>
                                       <option value="" selected disabled hidden>Pilih Mata pelajaran</option>
                                       @foreach ($mapel as $mp)
                                       <option class="text-capitalize" value="{{ $mp->id}}">{{ $mp->nama }}</option>    
                                       @endforeach
                                      </select> 
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">Kelas tidak boleh kosong!</div>
                                    </div>  
                                    <div class="form-group" style="position: relative">
                                      <label for="guru_id">Pilih Guru Mata Pelajaran </label>
                                      <select class="form-control" name="guru_id" required>
                                          <option value="" selected disabled hidden>Pilih Guru Mata Pelajaran</option>
                                          @foreach ($guru as $gmp)
                                          <option class="text-capitalize" value="{{ $gmp->id}}">{{ $gmp->nama }}</option>    
                                          @endforeach
                                      </select> 
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">Kelas tidak boleh kosong!</div>
                                    </div>   
                                    <div class="form-group">
                                      <div class="row">
                                        <div class="col">
                                          <label for="jam_mulai">Jam Mulai</label>
                                          <input type="time" class="form-control"  placeholder="Masukkan jam mulai" name="jam_mulai" required>
                                        </div>
                                        <div class="col">
                                          <label for="jam_selesai">Jam Selesai</label>
                                          <input type="time" class="form-control"  placeholder="Masukkan jam selesai" name="jam_selesai" required>
                                        </div>
                                      </div> 
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
    </div>
</div>
@endsection