@extends('layouts.master')
@section('title','Mata Pelajaran')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 text-gray-800">Data Mata Pelajaran SMP Negeri 2 Kuala Tungkal</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Table mapel</h6> 
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambah">
              + Tambah Data
            </button>     
        </div>
        <div class="card-header py-6">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Mata Pelajaran</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Semester</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($mapel as $mapel) 
                        <tr>
                            <td style="width: 20px">{{ $loop->iteration }}</td>
                            <td class="text-capitalize">{{ $mapel->kode }}</td>
                            <td class="text-capitalize">{{ $mapel->nama }}</td>
                            <td class="text-capitalize">{{ $mapel->semester }}</td>
                            <td>
                              <a href="#edit{{$mapel->id}}" class="btn btn-warning btn-sm text-center" data-toggle="modal">Edit</a>
                            </td>                      
                        </tr>
                        {{-- modalEdit  --}}
                          <div class="modal" id="edit{{$mapel->id}}">
                            <div class="modal-dialog">
                              <div class="modal-content">
                          
                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Edit Data mapel</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                          
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="{{ route('mapel.update',$mapel->id) }}" method="POST"class="needs-validation" novalidate role="form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <div class="form-group">
                                            <label for="kode">Kode Mata Pelajaran</label>
                                            <input type="text" class="form-control"  placeholder="Masukkan Kode Mata Pelajaran" name="kode" required value="{{ $mapel->kode }}">
                                          </div> 
                                            <div class="form-group">
                                              <label for="nama">Nama Mata Pelajaran</label>
                                              <input type="text" class="form-control"  placeholder="Masukkan Nama Mata Pelajaran" name="nama" required value="{{ $mapel->nama }}">
                                            </div>                      
                                            <div class="form-group">
                                                <label for="semester">Semester</label>
                                                <input type="text" class="form-control"  placeholder="Masukkan Semester:(angka)" name="semester" required value="{{ $mapel->semester }}">
                                              </div>              
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                      </form>
                                </div> 
                          
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                          
                              </div>
                            </div>
                        </div>

                        {{-- start modal delete --}} 
                        {{-- <div class="modal fade" id="delete{{$mapel->id}}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Apakah Anda yakin menghapus data <b>"{{ $mapel->namakelas }}"?</b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="form-group">

                                    <form action="{{ route('mapel.destroy',$mapel->id) }}" method="POST">
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
                              <h5 class="modal-title" id="exampleModalLabel">Tambah Data mapel</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="modal-body">
                                <form action="{{ route('mapel.store') }}" method="POST" class="needs-validation" novalidate>
                                  {{ csrf_field() }}
                                  <div class="form-group">
                                    <label for="kode">Kode Mata Pelajaran</label>
                                    <input type="text" class="form-control"  placeholder="Masukkan Kode Mata Pelajaran" name="kode" required>
                                  </div> 
                                    <div class="form-group">
                                      <label for="nama">Nama Mata Pelajaran</label>
                                      <input type="text" class="form-control"  placeholder="Masukkan Nama Mata Pelajaran" name="nama" required>
                                    </div>                      
                                    <div class="form-group">
                                        <label for="semester">Semester</label>
                                        <input type="text" class="form-control"  placeholder="Masukkan Semester:(angka)" name="semester" required>
                                      </div>              
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </form>
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