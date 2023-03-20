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
Data ALumni
@endsection

@section('kembali')
    <li class="breadcrumb-item"><a href="/alumni">Kembali</a></li>
@endsection

@section('content')
<div class="">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
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
                            <th scope="col">No Induk</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Nama Pelatihan</th>
                            <th scope="col">Subkejuruan</th>
                            <th scope="col">Kejuruan</th>
                            <th scope="col">Kepesertaan</th>
                        </tr>
                    </thead>
                    <tbody class="customtable">
                        @foreach ( $bukuinduk as $key=>$value )
                            <tr>
                                <th>
                                    <label class="customcheckbox">
                                        <input name="action[]" value="{{ $value->id }}" type="checkbox" class="listCheckbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                <td>
                                    <a href="/alumni/{{$value->id}}" class="btn btn-info btn-sm">Detail</a>
                                </td>
                                <td>{{ $value->noinduk }}</td>
                                <td>{{ $value->nama_pendaftar }}</td>
                                <td>{{ $value->paketpelatihan->namapelatihan }}</td>
                                <td>{{ $value->paketpelatihan->subkejuruan->subkejuruan }}</td>
                                <td>{{ $value->paketpelatihan->subkejuruan->kejuruan->kejuruan }}</td>
                                <td>
                                    @if ($value->kepesertaan == 2)
                                        Lulus Pelatihan
                                    @elseif ($value->kepesertaan == 3)
                                        Tidak Lulus Pelatihan
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
