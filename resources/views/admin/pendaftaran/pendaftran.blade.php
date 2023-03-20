@extends('admin.master')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('/template/assets/extra-libs/multicheck/multicheck.css') }}">
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('/dist/css/style.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.13.2/datatables.min.css"/>
@endpush

@push('scripts')
    <script src="{{ asset('/template/assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{ asset('/template/assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.13.2/datatables.min.js"></script>
@endpush

@section('judul')
Data pendaftaran
@endsection

@section('kembali')
    <li class="breadcrumb-item"><a href="/pandaftaran">Kembali</a></li>
@endsection

@section('content')
<div class="">
    <a href="/pendaftaran/create" class="btn btn-info btn-md mb-3 ">
        <div class="">
            <i class="fas fa-plus"></i> Tambah pendaftar
        </div>
    </a>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <form action="pendaftaran-action" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-3">
                            <select name="hasil" class="select2 form-select shadow-none" style="width: 100%; height:36px;">
                                <option>Pilih Hasil Seleksi</option>
                                <option value="1">Lulus</option>
                                <option value="2">Tidak Lulus</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <input type="submit" value="Tambah" class="btn btn-sm btn-info">
                        </div>
                    </div>
                    <table id="myTable" class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>
                                    <label class="customcheckbox mb-3">
                                        <input type="checkbox" id="mainCheckbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                <th scope="col">Action</th>
                                <th scope="col">No Pendaftaran</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Nama Pelatihan</th>
                                <th scope="col">Subkejuruan</th>
                                <th scope="col">Kejuruan</th>
                            </tr>
                        </thead>
                        <tbody class="customtable">
                            @foreach ( $pendaftaran as $key=>$value )
                                <tr>
                                    <th>
                                        <label class="customcheckbox">
                                            <input name="action[]" value="{{ $value->id }}" type="checkbox" class="listCheckbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </th>
                                    <td>
                                        <a href="/pendaftaran/{{$value->id}}" class="btn btn-info btn-sm">Detail</a>
                                    </td>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->nama_pendaftar }}</td>
                                    <td>{{ $value->paketpelatihan->namapelatihan }}</td>
                                    <td>{{ $value->paketpelatihan->subkejuruan->subkejuruan }}</td>
                                    <td>{{ $value->paketpelatihan->subkejuruan->kejuruan->kejuruan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
