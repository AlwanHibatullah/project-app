@extends('admin.master')

@section('judul')
Edit Data Pegawai
@endsection

@section('kembali')
    <li class="breadcrumb-item"><a href="/pegawai">Kembali</a></li>
@endsection

@section('content')
<div class="">
    <div class="row flex-lg-row-reverse g-3">
      <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah User</h5>
                <form class="form-horizontal" action="/pegawai/{{ $pegawai->id }}" method="POST">
                    @csrf
                    @method(PUT)
                    <div class="card-body">
                        <div class="form-group ">
                            <div class="col-sm-12 mb-3">
                                <label for="" class="mt-3">Nama Pegawai</label>
                                <input type="text" class="form-control" name="name" value="{{ $pegawai->nama_pegawai }}">
                                @error('name')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="" class="mt-3">NIP</label>
                                <input type="text" class="form-control" name="nip" value="{{ $pegawai->nip }}">
                                @error('nip')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="" class="mt-3">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $pegawai->user->email }}">
                                @error('email')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="" class="mt-3">Password</label>
                                <input type="text" class="form-control" name="password" value="{{ $pegawai->user->password }}">
                                @error('password')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="" class="mt-3">Jabatan</label>
                                <select name="jabatan" class="select2 form-select shadow-none select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true">
                                    @if ($pegawai->jabatan  == 5)
                                        <option value="">Pilih Jabatan</option>
                                        <option value="1" selected>Kepala BLK</option>
                                        <option value="2">Kepala TU</option>
                                        <option value="3">Staff TU</option>
                                        <option value="4">Staff Kejuruan</option>
                                        <option value="5">Instruktur</option>
                                    @elseif ($pegawai->jabatan  == 2)
                                        <option value="">Pilih Jabatan</option>
                                        <option value="1" >Kepala BLK</option>
                                        <option value="2" selected>Kepala TU</option>
                                        <option value="3">Staff TU</option>
                                        <option value="4">Staff Kejuruan</option>
                                        <option value="5">Instruktur</option>
                                    @elseif ($pegawai->jabatan  == 3)
                                        <option value="">Pilih Jabatan</option>
                                        <option value="1" >Kepala BLK</option>
                                        <option value="2">Kepala TU</option>
                                        <option value="3" selected>Staff TU</option>
                                        <option value="4">Staff Kejuruan</option>
                                        <option value="5">Instruktur</option>
                                    @elseif ($pegawai->jabatan  == 4)
                                        <option value="">Pilih Jabatan</option>
                                        <option value="1" >Kepala BLK</option>
                                        <option value="2">Kepala TU</option>
                                        <option value="3" >Staff TU</option>
                                        <option value="4" selected>Staff Kejuruan</option>
                                        <option value="5">Instruktur</option>
                                    @elseif ($pegawai->jabatan  == 5)
                                        <option value="">Pilih Jabatan</option>
                                        <option value="1" >Kepala BLK</option>
                                        <option value="2">Kepala TU</option>
                                        <option value="3" >Staff TU</option>
                                        <option value="4">Staff Kejuruan</option>
                                        <option value="5" selected>Instruktur</option>
                                    @endif
                                </select>
                                <label for="" class="mt-3">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="select2 form-select shadow-none select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true">
                                    @if ($pegawai->jenis_kelamin  == 1)
                                        <option value="1" selected>Perempuan</option>
                                        <option value="2">Laki-laki</option>
                                    @elseif ($pegawai->jenis_kelamin  == 2)
                                        <option value="1" >Perempuan</option>
                                        <option value="2" selected>Laki-laki</option>
                                    @endif
                                </select>
                                <label for="" class="mt-3">Alamat</label>
                                <input type="textarea" class="form-control" name="alamat" placeholder="Masukan Alamat User">
                                @error('alamat')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="" class="mt-3">Role</label>
                                <select name="role" class="select2 form-select shadow-none select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true">
                                    @if ($pegawai->jenis_kelamin  == 1)
                                        <option value="superadmin" selected>Super Admin</option>
                                        <option value="admin">Admin</option>
                                    @elseif ($pegawai->jenis_kelamin  == 2)
                                        <option value="superadmin" >Super Admin</option>
                                        <option value="admin" selected>Admin</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Daftar Pegawai</h5>
                <div style="overflow: auto">
                    <table class="table table-resposif">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Nama Pegawai</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $pegawai as $key=>$value )
                                <tr>
                                    <th scope="row">{{$key + 1}}</th>
                                    <td>{{$value->nama_pegawai}}</td>
                                    <td>{{$value->nip}}</td>
                                    <td>{{$value->jabatan}}</td>
                                    <td>{{$value->alamat}}</td>
                                    <td>{{$value->user->email}}</td>
                                    <td class=""mt-3<form action="/pegawai/{{$value->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger btn-sm text-white my-1" value="Hapus">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr colspan="3">
                                    <td>No data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
