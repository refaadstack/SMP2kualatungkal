@extends('layouts.master')
@section('title','Data Siswa')
@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 text-gray-800">Data Siswa SMP Negeri 2 Kuala Tungkal</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Table Siswa</h6> 
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambah">
              + Tambah Data
            </button>     
        </div>
        <div class="card-header py-6">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Jenis Kelamin</th>
                            <th>NISN</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Agama</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $siswa)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-capitalize"><a href="{{ route('siswa.profile',$siswa->id) }}">{{ $siswa->nama }}</a></td>
                            <td>{{ $siswa->nis}}</td>
                            <td>{{ $siswa->jeniskelamin }}</td>
                            <td>{{ $siswa->nisn }}</td>
                            <td class="text-capitalize">{{ $siswa->tempatlahir }}</td>
                            <td>{{ $siswa->tanggallahir }}</td>
                            <td class="text-capitalize">{{ $siswa->agama }}</td> 
                            <td class="text-capitalize">{{ $siswa->kelas->namakelas }}</td>
                            <td>
                              <a href="#edit{{$siswa->id}}" class="btn btn-warning btn-sm" data-toggle="modal">Edit</a>
                              <a href="#delete{{$siswa->id}}" class="btn btn-danger btn-sm" data-toggle="modal">Delete</a>
                            </td>                      
                          </tr>
                          {{-- modalEdit --}}
                          <div class="modal" id="edit{{$siswa->id}}">
                            <div class="modal-dialog">
                              <div class="modal-content">
                          
                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Edit Data Siswa</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                          
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="{{ route('siswa.update',$siswa->id) }}" method="POST"class="needs-validation" novalidate role="form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <div class="form-group">
                                          <label for="nama">Nama</label>
                                          <input type="text" class="form-control"  placeholder="Masukkan Nama" name="nama" value="{{ $siswa->nama }}" required>
                                          <div class="valid-feedback">Valid.</div>
                                          <div class="invalid-feedback">Nama tidak boleh kosong!</div>
                                        </div>
                                        <div class="form-group">
                                          <label for="nis">NIS</label>
                                          <input type="number" class="form-control" placeholder="Masukkan NIS" name="nis" value="{{ $siswa->nis }}" required>
                                          <div class="valid-feedback">Valid.</div>
                                          <div class="invalid-feedback">NIS tidak boleh kosong!</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jeniskelamin">Jenis Kelamin</label>
                                            <select class="form-control" name="jeniskelamin" required>
                                                <option value="" selected disabled hidden>Pilih Jenis Kelamin</option>
                                                <option value="Laki-laki" @if($siswa->jeniskelamin == 'Laki-laki') selected @endif>Laki-laki</option>
                                                <option value="Perempuan" @if($siswa->jeniskelamin == 'Perempuan') selected @endif>Perempuan</option>
                                            </select> 
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Jenis kelamin tidak boleh kosong!</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nisn">NISN</label>
                                            <input type="number" class="form-control" placeholder="Masukkan NISN" name="nisn" value="{{ $siswa->nisn }}" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">NISN tidak boleh kosong!</div>
                                          </div>
                                        <div class="form-group">
                                            <label for="tempatlahir">Tempat lahir</label>
                                            <input type="text" class="form-control"  placeholder="Masukkan Tempat Lahir" name="tempatlahir" value="{{ $siswa->tempatlahir }}" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Tempat lahir tidak boleh kosong!</div>
                                          </div>
                                        <div class="form-group">
                                            <label for="tanggallahir">Tanggal Lahir</label>
                                            <input type="date" class="form-control"  placeholder="pilih tanggal lahir" name="tanggallahir" value="{{ $siswa->tanggallahir }}" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Tanggal lahir tidak boleh kosong!</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="agama">Pilih Agama</label>
                                            <select class="form-control" name="agama" required>
                                                <option value="" selected disabled hidden>Pilih Agama</option>
                                                <option value="Islam" @if($siswa->agama == 'Islam') selected @endif>Islam</option>
                                                <option value="Kristen Protestan" @if($siswa->agama == 'Kristen Protestan') selected @endif>Kristen Protestan</option>
                                                <option value="Katolik" @if($siswa->agama == 'Katolik') selected @endif>Katolik</option>
                                                <option value="Hindu" @if($siswa->agama == 'Hindu') selected @endif>Hindu</option>
                                                <option value="Buddha"  @if($siswa->agama == 'Buddha') selected @endif>Buddha</option>
                                                <option value="Khonghucu" @if($siswa->agama == 'Khonghucu') selected @endif>Khonghucu</option>
                                            </select> 
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Agama tidak boleh kosong!</div>
                                        </div>
                                        <div class="form-group">
                                          <label for="agama">Pilih Kelas</label>
                                          <select class="form-control" name="kelas_id" required>
                                              <option value="" selected disabled hidden>Pilih Kelas</option>
                                              @foreach ($kelass as $kelas)
                                              <option value="{{ $kelas->id }}" @if($kelas->namakelas == $kelas->namakelas) selected @endif>{{ $kelas->namakelas }}</option>    
                                              @endforeach
                                          </select> 
                                          <div class="valid-feedback">Valid.</div>
                                          <div class="invalid-feedback">Kelas tidak boleh kosong!</div>
                                        </div>
                                      <div class="form-group">
                                            <label for="sekolah">Asal sekolah</label>
                                            <input type="text" class="form-control"  placeholder="Masukkan asal sekolah" name="sekolah" value="{{ $siswa->sekolah }}" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">sekolah tidak boleh kosong! Format sekolah salah!</div>
                                      </div>
                                      <div class="form-group">
                                            <label for="ayah">Ayah</label>
                                            <input type="text" class="form-control"  placeholder="Masukkan nama ayah" name="ayah" value="{{ $siswa->ayah }}" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">nama ayah tidak boleh kosong! Format nama ayah salah!</div>
                                      </div>
                                      <div class="form-group">
                                            <label for="ibu">Ibu</label>
                                            <input type="text" class="form-control"  placeholder="Masukkan nama ibu" name="ibu" value="{{ $siswa->ibu }}" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">nama ibu tidak boleh kosong! Format nama ibu salah!</div>
                                      </div>
                                      <div class="form-group">
                                            <label for="pekerjaanayah">Pekerjaan ayah</label>
                                            <input type="text" class="form-control"  placeholder="Masukkan pekerjaan ayah" name="pekerjaanayah" value="{{ $siswa->pekerjaanayah }}" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">pekerjaan ayah tidak boleh kosong! Format pekerjaan ayah salah!</div>
                                      </div>
                                      <div class="form-group">
                                            <label for="pekerjaanibu">Pekerjaan ibu</label>
                                            <input type="text" class="form-control"  placeholder="Masukkan pekerjaan ibu" name="pekerjaanibu" value="{{ $siswa->pekerjaanibu }}" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">pekerjaan ibu tidak boleh kosong! Format pekerjaan ibu salah!</div>
                                      </div>
                                      <div class="form-group">
                                            <label for="alamat">alamat</label>
                                            <input type="text" class="form-control"  placeholder="Masukkan alamat" name="alamat" value="{{ $siswa->alamat }}" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">alamat tidak boleh kosong! Format alamat salah!</div>
                                      </div>
                                      <div class="form-group">
                                            <label for="hp">hp</label>
                                            <input type="text" class="form-control"  placeholder="Masukkan nomor hp" name="hp" value="{{ $siswa->hp }}" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">nomor hp tidak boleh kosong! Format nomor hp salah!</div>
                                      </div>
                                        <div class="form-group">
                                            <label for="email">E-Mail</label>
                                            <input type="email" class="form-control"  placeholder="e-mail belum ada" name="email" value="{{ $siswa->email }}" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">e-mail tidak boleh kosong! Format e-mail salah!</div>
                                        </div>  
                                        <div class="form-group">
                                          <label for="avatar">Masukkan foto siswa</label>
                                        <input type="file" name="avatar" class="form-control">  
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
                        <div class="modal fade" id="delete{{$siswa->id}}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Apakah Anda yakin menghapus data <b>"{{ $siswa->nama }}"?</b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="form-group">

                                    <form action="{{ route('siswa.destroy',$siswa->id) }}" method="POST">
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
                    <!-- ModalTambah -->
                      <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Tambah Data siswa</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="modal-body">
                                <form action="{{ route('siswa.store') }}" method="POST" class="needs-validation" novalidate>
                                  {{ csrf_field() }}
                                    <div class="form-group">
                                      <label for="nama">Nama</label>
                                      <input type="text" class="form-control"  placeholder="Masukkan Nama" name="nama" required>
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">Nama tidak boleh kosong!</div>
                                    </div>
                                    <div class="form-group">
                                      <label for="nis">NIS</label>
                                      <input type="number" class="form-control" placeholder="Masukkan NIS" name="nis" required>
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">NIS tidak boleh kosong!</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jeniskelamin">Jenis Kelamin</label>
                                        <select class="form-control" name="jeniskelamin" required>
                                            <option value="" selected disabled hidden>Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select> 
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Jenis kelamin tidak boleh kosong!</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nisn">NISN</label>
                                        <input type="number" class="form-control"  placeholder="Masukkan NISN" name="nisn" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">NISN tidak boleh kosong!</div>
                                      </div>
                                    <div class="form-group">
                                        <label for="tempatlahir">Tempat lahir</label>
                                        <input type="text" class="form-control"  placeholder="Masukkan Tempat Lahir" name="tempatlahir" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Tempat lahir tidak boleh kosong!</div>
                                      </div>
                                    <div class="form-group">
                                        <label for="tanggallahir">Tanggal Lahir</label>
                                        <input type="date" min="2000-12-31" class="form-control"  placeholder="pilih tanggal lahir" name="tanggallahir" required>
                                        {{-- <input type="date" class="form-control"  placeholder="pilih tanggal lahir" name="tanggallahir" required> --}}
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Tanggal lahir tidak boleh kosong!</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="agama">Pilih Agama</label>
                                        <select class="form-control" name="agama" required>
                                            <option value="" selected disabled hidden>Pilih Agama</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen Protestan">Kristen Protestan</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Khonghucu">Khonghucu</option>
                                        </select> 
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Agama tidak boleh kosong!</div>
                                    </div>
                                    <div class="form-group">
                                      <label for="kelas_id">Pilih Kelas</label>
                                      <select class="form-control" name="kelas_id" required>
                                          <option value="" selected disabled hidden>Pilih Kelas</option>
                                          @foreach ($kelass as $kelas)
                                          <option value="{{ $kelas->id }}">{{ $kelas->namakelas }}</option>    
                                          @endforeach
                                      </select> 
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">Kelas tidak boleh kosong!</div>
                                  </div>
                                  <div class="form-group">
                                      <label for="sekolah">Asal sekolah</label>
                                      <input type="text" class="form-control"  placeholder="Masukkan asal sekolah" name="sekolah" required>
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">sekolah tidak boleh kosong! Format sekolah salah!</div>
                                  </div>
                                  <div class="form-group">
                                        <label for="ayah">Ayah</label>
                                        <input type="text" class="form-control"  placeholder="Masukkan nama ayah" name="ayah" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">nama ayah tidak boleh kosong! Format nama ayah salah!</div>
                                  </div>
                                  <div class="form-group">
                                        <label for="ibu">Ibu</label>
                                        <input type="text" class="form-control"  placeholder="Masukkan nama ibu" name="ibu" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">nama ibu tidak boleh kosong! Format nama ibu salah!</div>
                                  </div>
                                  <div class="form-group">
                                        <label for="pekerjaanayah">Pekerjaan ayah</label>
                                        <input type="text" class="form-control"  placeholder="Masukkan pekerjaan ayah" name="pekerjaanayah" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">pekerjaan ayah tidak boleh kosong! Format pekerjaan ayah salah!</div>
                                  </div>
                                  <div class="form-group">
                                        <label for="pekerjaanibu">Pekerjaan ibu</label>
                                        <input type="text" class="form-control"  placeholder="Masukkan pekerjaan ibu" name="pekerjaanibu" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">pekerjaan ibu tidak boleh kosong! Format pekerjaan ibu salah!</div>
                                  </div>
                                  <div class="form-group">
                                        <label for="alamat">alamat</label>
                                        <input type="text" class="form-control"  placeholder="Masukkan alamat" name="alamat" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">alamat tidak boleh kosong! Format alamat salah!</div>
                                  </div>
                                  <div class="form-group">
                                        <label for="hp">hp</label>
                                        <input type="text" class="form-control"  placeholder="Masukkan nomor hp" name="hp" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">nomor hp tidak boleh kosong! Format nomor hp salah!</div>
                                  </div>
                                  <div class="form-group">
                                      <label for="email">E-Mail</label>
                                      <input type="email" class="form-control"  placeholder="Masukkan Email" name="email" required>
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">e-mail tidak boleh kosong! Format e-mail salah!</div>
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