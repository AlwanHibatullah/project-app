@extends('admin.master')

@section('judul')
Subkejuruan Edit
@endsection

@section('kembali')
    <li class="breadcrumb-item"><a href="/subkejuruan">Kembali</a></li>
@endsection

@section('content')
<div class="">
    <div class="row flex-lg-row-reverse g-3">
      <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Data Subkejuruan</h5>
                <form class="form-horizontal" action="/subkejuruan/{{$subkejuruan_edit->id}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group ">
                            <div class="col-sm-12 mb-3">
                                <div class="col-md-12">
                                    <label>Kejuruan</label>
                                    <select name="kejuruan_id" class="select2 form-select shadow-none select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true">
                                        @forelse ($kejuruan as $key=>$value)
                                            @if ($value->id == $subkejuruan_edit->kejuruan_id )
                                                <option selected value="{{$value->id}}">{{$value->kejuruan}}</option>
                                            @else
                                                <option value="{{$value->id}}">{{$value->kejuruan}}</option>
                                            @endif
                                        @empty
                                            tidak ada data
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label for="">Kode Subkejuruan</label>
                                <input type="text" class="form-control" name="kode_subkejuruan" value="{{$subkejuruan_edit->kode_subkejuruan}}">
                                @error('kode_subkejuruan')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label for="">Nama Subkejuruan</label>
                                <input type="text" class="form-control" name="subkejuruan" value="{{$subkejuruan_edit->subkejuruan}}">
                                @error('subkejuruan')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label for="">Deskripsi Subkejuruan</label>
                                <textarea name="deskripsi" class="form-control" cols="30" rows="10">{{$subkejuruan_edit->deskripsi}}</textarea>
                                @error('deskripsi')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label for="">Foto Thumbnail</label>
                                <input type="file" class="form-control" name="thumnail">
                                @error('thumnail')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary">Edit</button>
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
                                <th scope="col">Kode</th>
                                <th scope="col">Kejuruan</th>
                                <th scope="col">Nama Subkejuruan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $subkejuruan as $key=>$value )
                                <tr>
                                    <th scope="row">{{$value->kode_subkejuruan}}</th>
                                    <th>{{$value->kejuruan->kejuruan}}</th>
                                    <td>{{$value->subkejuruan}}</td>
                                    <td class="">
                                        <a href="/subkejuruan/{{$value->id}}/edit" class="btn btn-info btn-sm my-1">Edit</a>
                                        <form action="/subkejuruan/{{$value->id}}" method="POST">
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
