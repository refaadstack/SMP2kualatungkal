@extends('layouts.master')
@section('title','Data kelas')
@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 text-gray-800">Data kelas SMP Negeri 2 Kuala Tungkal</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Table kelas</h6> 
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
                            <th> No</th>
                            <th >Nama Kelas</th>
                            <th >Wali Kelas</th>
                            <th >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($kelas as $kelas) 
                        <tr>
                            <td style="width: 20px">{{ $loop->iteration }}</td>
                            <td class="text-capitalize"><a href="{{ route('kelas.show',$kelas->id) }}">{{ $kelas->namakelas }}</a></td>
                            <td class="text-capitalize">{{ $kelas->walikelas }}</td>
                            <td>
                              <a href="#edit{{$kelas->id}}" class="btn btn-warning btn-sm text-center" data-toggle="modal">Edit</a>
                              <a href="{{ route('kelas.show',$kelas->id) }}" class="btn btn-success btn-sm text-center">Details</a>
                            </td>                      
                        </tr>
                        {{-- modalEdit  --}}
                          <div class="modal" id="edit{{$kelas->id}}">
                            <div class="modal-dialog">
                              <div class="modal-content">
                          
                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Edit Data kelas</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                          
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="{{ route('kelas.update',$kelas->id) }}" method="POST"class="needs-validation" novalidate role="form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <div class="form-group">
                                          <label for="namakelas">nama kelas</label>
                                          <input type="text" class="form-control"  placeholder="Masukkan namakelas" name="namakelas" value="{{ $kelas->namakelas }}" required>
                                          <div class="valid-feedback">Valid.</div>
                                          <div class="invalid-feedback">nama kelas tidak boleh kosong!</div>
                                        </div>
                                        <div class="form-group">
                                          <label for="agama">Pilih Wali kelas</label>
                                          <select class="form-control" name="walikelas" required>
                                              <option value="" selected disabled hidden>Pilih Wali kelas</option>
                                              @foreach ($guru as $walikelas)
                                              <option class="text-capitalize" value="{{ $walikelas->nama}}" @if($kelas->walikelas == $walikelas->nama) selected @endif>{{ $walikelas->nama }}</option>    
                                              @endforeach
                                          </select> 
                                          <div class="valid-feedback">Valid.</div>
                                          <div class="invalid-feedback">Kelas tidak boleh kosong!</div>
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
                              <h5 class="modal-title" id="exampleModalLabel">Tambah Data kelas</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="modal-body">
                                <form action="{{ route('kelas.store') }}" method="POST" class="needs-validation" novalidate>
                                  {{ csrf_field() }}
                                    <div class="form-group">
                                      <label for="namakelas">Nama kelas</label>
                                      <input type="text" class="form-control"  placeholder="Masukkan Nama kelas" name="namakelas" required>
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">namakelas tidak boleh kosong!</div>
                                    </div>      
                                    <div class="form-group">
                                      <label for="agama">Pilih Wali kelas</label>
                                      <select class="form-control" name="walikelas" required>
                                          <option value="" selected disabled hidden>Pilih Wali kelas</option>
                                          @foreach ($guru as $walikelas)
                                          <option class="text-capitalize" value="{{ $walikelas->nama}}">{{ $walikelas->nama }}</option>    
                                          @endforeach
                                      </select> 
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">Kelas tidak boleh kosong!</div>
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
  <script>
    
    // Disable form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
       
    </script>
    
    

@endsection