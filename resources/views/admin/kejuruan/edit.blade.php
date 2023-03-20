@extends('admin.master')

@section('judul')
Kejuruan Edit
@endsection

@section('kembali')
    <li class="breadcrumb-item"><a href="/kejuruan">Kembali</a></li>
@endsection

@section('content')
<div class="">
    <div class="row flex-lg-row-reverse g-3">
      <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Data Kejuruan</h5>
                <form class="form-horizontal" action="/kejuruan/{{$kejuruan_edit->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group ">
                            <div class="col-sm-12 mb-3">
                                <label for="">Kode Kejuruan</label>
                                <input type="text" class="form-control" name="kode_kejuruan" value="{{$kejuruan_edit->kode_kejuruan}}">
                                @error('kode_kejuruan')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label for="">Nama Kejuruan</label>
                                <input type="text" class="form-control" name="kejuruan" value="{{$kejuruan_edit->kejuruan}}">
                                @error('kejuruan')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary">Update</button>
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
                <h5 class="card-title">Daftar Kejuruan</h5>
                <div style="overflow: auto">
                    <table class="table table-resposif">
                        <thead>
                            <tr>
                                <th scope="col">Kode Kejuruan</th>
                                <th scope="col">Nama Kejuruan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $kejuruan as $key=>$value )
                                <tr>
                                    <th scope="row">{{$value->kode_kejuruan}}</th>
                                    <td>{{$value->kejuruan}}</td>
                                    <td class="">
                                        <a href="/kejuruan/{{$value->id}}/edit" class="btn btn-info btn-sm my-1">Edit</a>
                                        <form action="/kejuruan/{{$value->id}}" method="POST">
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
