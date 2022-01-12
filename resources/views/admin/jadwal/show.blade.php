@extends('layouts.master')
@section('title','Jadwal')

@section('css')

@section('content')


<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 text-gray-800">Data Jadwal</h1>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h5 class="m-0 font-weight-bold text-dark">JADWAL</h5> 
      </div>
      <div class="card-header py-6">
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                      <th>No</th>
                      <th >Mata Pelajaran</th>
                      <th >Hari</th>
                      <th>Jam Pelajaran</th>
                      @if (auth()->user()->role == 'admin')      
                      <th>Action</th>
                      @endif
                      
                  </tr>
              </thead>
              <tbody> 
                @foreach ($jadwal as $data)    
                  <tr>
                    <td style="width: 10%">{{ $loop->iteration }}</td>
                    <td>
                         <h6 class="card-title">{{ $data->mapel->nama }}</h6>
                         <p class="card-text"><small class="text-muted">{{ $data->guru->nama }}</small></p>
                     </td>
                    <td class="text-capitalize">{{ $data->hari}}</td>
                    <td>{{ $data->jam_mulai }} WIB - {{ $data->jam_selesai }} WIB</td>
                    @if (auth()->user()->role == 'admin')
                    <td>
                        <a href="#edit{{$data->id}}" class="btn btn-warning btn-sm text-center" data-toggle="modal">Edit</a>
                        <a href="{{ route('jadwal.show',$kelas->id) }}" class="btn btn-success btn-sm text-center">Details</a>
                    </td>
                    @endif
                  </tr>
                  {{-- modal edit jadwal --}}
                  <div class="modal" id="edit{{$data->id}}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                  
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Data jadwal</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                  
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="{{ route('jadwal.update',$data->id) }}" method="POST"class="needs-validation" novalidate role="form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <div class="form-group">
                                  <label for="kelas_id">Pilih Kelas </label>
                                  <select class="form-control" name="kelas_id" required>
                                      <option value="" selected disabled hidden>Pilih Kelas</option>
                                      @foreach ($kelas2 as $kelas)
                                      <option class="text-capitalize" value="{{ $kelas->id}}" @if ($data->kelas_id == $kelas->id)  selected @endif>{{ $kelas->namakelas }}</option>    
                                      @endforeach
                                  </select> 
                                  <div class="valid-feedback">Valid.</div>
                                  <div class="invalid-feedback">Kelas tidak boleh kosong!</div>
                                </div> 
                                <div class="form-group">
                                  <label for="hari">Pilih Hari</label>
                                  <select class="form-control" name="hari" required>
                                      <option value="" selected disabled hidden>Pilih Hari</option>
                                      <option class="text-capitalize" value="senin" @if($data->hari == 'senin') selected @endif>Senin</option>    
                                      <option class="text-capitalize" value="selasa" @if($data->hari == 'selasa') selected @endif>Selasa</option>    
                                      <option class="text-capitalize" value="rabu" @if($data->hari == 'rabu') selected @endif>Rabu</option>    
                                      <option class="text-capitalize" value="kamis" @if($data->hari == 'kamis') selected @endif>Kamis</option>    
                                      <option class="text-capitalize" value="jumat" @if($data->hari == 'jumat') selected @endif>Jumat</option>    
                                      <option class="text-capitalize" value="sabtu" @if($data->hari == 'sabtu') selected @endif>Sabtu</option>    
                                  </select> 
                                  <div class="valid-feedback">Valid.</div>
                                  <div class="invalid-feedback">Kelas tidak boleh kosong!</div>
                                </div> 

                                <div class="form-group">
                                 <label for="mapel_id">Pilih Mata Pelajaran</label>
                                 <select class="form-control" name="mapel_id" id="mapel_id" required>
                                   <option value="" selected disabled hidden>Pilih Mata pelajaran</option>
                                   @foreach ($mapel as $mpl)
                                   <option class="text-capitalize" value="{{ $mpl->id}}" @if ($data->mapel_id == $mpl->id)  selected @endif>{{ $mpl->nama }}</option>    
                                   @endforeach
                                  </select> 
                                  <div class="valid-feedback">Valid.</div>
                                  <div class="invalid-feedback">Kelas tidak boleh kosong!</div>
                                </div>  
                                <div class="form-group" id="guru_id">
                                  <label for="guru_id">Pilih Guru Mata Pelajaran </label>
                                  <select class="form-control" name="guru_id"  required>
                                      <option value="" selected disabled hidden>Pilih Guru Mata Pelajaran</option>
                                      @foreach ($guru as $gmp)
                                      <option class="text-capitalize" value="{{ $gmp->id}}" @if ($data->guru_id == $gmp->id)  selected @endif>{{ $gmp->nama }}</option>    
                                      @endforeach
                                  </select> 
                                  <div class="valid-feedback">Valid.</div>
                                  <div class="invalid-feedback">Kelas tidak boleh kosong!</div>
                                </div>   
                                <div class="form-group">
                                  <div class="row">
                                    <div class="col">
                                      <label for="jam_mulai">Jam Mulai</label>
                                      <input type="time" class="form-control"  placeholder="Masukkan jam mulai" name="jam_mulai" required value="{{ $data->jam_mulai }}">
                                    </div>
                                    <div class="col">
                                      <label for="jam_selesai">Jam Selesai</label>
                                      <input type="time" class="form-control"  placeholder="Masukkan jam selesai" name="jam_selesai" required value="{{ $data->jam_selesai }}">
                                    </div>
                                  </div>
                                  
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
                  {{-- end modal edit --}}
                @endforeach
                  
              </tbody>
            </table>
          </div>
      </div>
  </div>
</div>

@endsection

