@extends('admin.master')

@section('judul')
Jenis Pelatihan
@endsection

@section('kembali')
    <li class="breadcrumb-item"><a href="/jpelatihan">Kembali</a></li>
@endsection

@section('content')
<div class="">
    <div class="row flex-lg-row-reverse g-3">
      <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Data Jenis Pelatihan</h5>
                <form class="form-horizontal" action="/jpelatihan" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group ">
                            <div class="col-sm-12 mb-3">
                                <input type="text" class="form-control" name="kode_jpelatihan" placeholder="Masukan Kode Jenis Pelatihan">
                                @error('kode_jpelatihan')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-12 mb-3">
                                <input type="text" class="form-control" name="jpelatihan" placeholder="Masukan Nama Jenis Pelatihan">
                                @error('jpelatihan')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                <h5 class="card-title">Daftar Jenis Pelatihan</h5>
                <div style="overflow: auto">
                    <table class="table table-resposif">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama Jenis Pelatihan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $jpelatihan as $key=>$value )
                                <tr>
                                    <th scope="row">{{$key + 1}}</th>
                                    <td>{{$value->kode_jpelatihan}}</td>
                                    <td>{{$value->jpelatihan}}</td>
                                    <td class="">
                                        <a href="/jpelatihan/{{$value->id}}/edit" class="btn btn-info btn-sm my-1">Edit</a>
                                        <form action="/jpelatihan/{{$value->id}}" method="POST">
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
