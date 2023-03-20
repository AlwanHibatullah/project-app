@extends('admin.master')

@push('styles')
    <link href="{{ asset('/template/assets/libs/magnific-popup/dist/magnific-popup.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset ('/template/assets/libs/select2/dist/css/select2.min.cs') }}s">
    <link rel="stylesheet" type="text/css" href="{{asset ('/template/assets/libs/jquery-minicolors/jquery.minicolors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset ('/template/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset ('/template/assets/libs/quill/dist/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ ('/template/assets/assets/extra-libs/multicheck/multicheck.css') }}">
    <link href="{{ ('/template/assets/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ ('/template/assets/dist/css/style.min.css" rel="stylesheet') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.13.2/datatables.min.css"/>
@endpush

@push('scripts')
    <script src="{{ asset('/template/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('/template/assets/libs/magnific-popup/meg.init.js') }}"></script>
    <!-- This Page JS -->
    <script src="{{asset ('/template/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{asset ('/template/dist/js/pages/mask/mask.init.js') }}"></script>
    <script src="{{asset ('/template/assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{asset ('/template/assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{asset ('/template/assets/libs/jquery-asColor/dist/jquery-asColor.min.js') }}"></script>
    <script src="{{asset ('/template/assets/libs/jquery-asGradient/dist/jquery-asGradient.js') }}"></script>
    <script src="{{asset ('/template/assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js') }}"></script>
    <script src="{{asset ('/template/assets/libs/jquery-minicolors/jquery.minicolors.min.js') }}"></script>
    <script src="{{asset ('/template/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{asset ('/template/assets/libs/quill/dist/quill.min.js') }}"></script>
    <script>
        //***********************************//
        // For select 2
        //***********************************//
        $(".select2").select2();

        /*colorpicker*/
        $('.demo').each(function () {
            //
            // Dear reader, it's actually very easy to initialize MiniColors. For example:
            //
            //  $(selector).minicolors();
            //
            // The way I've done it below is just for the demo, so don't get confused
            // by it. Also, data- attributes aren't supported at this time...they're
            // only used for this demo.
            //
            $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                position: $(this).attr('data-position') || 'bottom left',

                change: function (value, opacity) {
                    if (!value) return;
                    if (opacity) value += ', ' + opacity;
                    if (typeof console === 'object') {
                        console.log(value);
                    }
                },
                theme: 'bootstrap'
            });

        });
        /*datwpicker*/
        jQuery('.mydatepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
    </script>
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.13.2/datatables.min.js"></script>
@endpush

@section('judul')
Paket pelatihan
@endsection

@section('kembali')
    <li class="breadcrumb-item"><a href="/paketpelatihan">Kembali</a></li>
@endsection

@section('content')
<div class="">
    @if (Auth::user()->role == 'superadmin')
        <a href="/paketpelatihan/create" class="btn btn-info btn-md mb-3 ">
            <div class="">
                <i class="fas fa-plus"></i> Tambah Paket Pelatihan
            </div>
        </a>
    @endif
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#apbn"
                role="tab"><span class="hidden-sm-up"></span> <span
                    class="hidden-xs-down">APBN</span></a> </li>
        <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#apbd"
                role="tab"><span class="hidden-sm-up"></span> <span
                    class="hidden-xs-down">APBD</span></a> </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content tabcontent-border">
        <div class="tab-pane active" id="apbn" role="tabpanel">
            <div class="card">
                <div style="overflow: auto">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Paket Pelatihan</h5>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelatihan</th>
                                            <th>Subkejuruan</th>
                                            <th>Pendanaan</th>
                                            <th>tahun</th>
                                            <th>Angkatan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ( $paketpelatihan1 as $key=>$value )
                                            <tr>
                                                <th>{{ $key+=1 }}</th>
                                                <th>{{$value->namapelatihan}}</th>
                                                <th>{{$value->subkejuruan->subkejuruan}}</th>
                                                <td>{{$value->dana->dana}}</td>
                                                <td>{{$value->tahun}}</td>
                                                <td>{{$value->angkatan}}</td>
                                                <td>
                                                    @if ($value->status == 1)
                                                        Belum di Publish
                                                    @elseif ($value->status == 2)
                                                        Publish untuk Pendaftran
                                                    @elseif ($value->status == 3)
                                                        Pelatihan sedang Berjalan
                                                    @elseif ($value->status == 4)
                                                        Pelatihan Selsai
                                                    @endif
                                                </td>
                                                <td class="">
                                                    <a href="/paketpelatihan/{{$value->id}}" class="btn btn-info btn-sm my-1">Detail</a>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelatihan</th>
                                            <th>Subkejuruan</th>
                                            <th>Pendanaan</th>
                                            <th>Tahun</th>
                                            <th>Angkatan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="apbd" role="tabpanel">
            <div class="card">
                <div style="overflow: auto">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Paket Pelatihan</h5>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelatihan</th>
                                            <th>Subkejuruan</th>
                                            <th>Pendanaan</th>
                                            <th>tahun</th>
                                            <th>Angkatan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ( $paketpelatihan2 as $key=>$value )
                                            <tr>
                                                <th>{{ $key+=1 }}</th>
                                                <th>{{$value->namapelatihan}}</th>
                                                <th>{{$value->subkejuruan->subkejuruan}}</th>
                                                <td>{{$value->dana->dana}}</td>
                                                <td>{{$value->tahun}}</td>
                                                <td>{{$value->angkatan}}</td>
                                                <td>
                                                    @if ($value->status == 1)
                                                        Belum di Publish
                                                    @elseif ($value->status == 2)
                                                        Publish untuk Pendaftran
                                                    @elseif ($value->status == 3)
                                                        Pelatihan sedang Berjalan
                                                    @elseif ($value->status == 4)
                                                        Pelatihan Selsai
                                                    @endif
                                                </td>
                                                <td class="">
                                                    <a href="/paketpelatihan/{{$value->id}}" class="btn btn-info btn-sm my-1">Detail</a>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelatihan</th>
                                            <th>Subkejuruan</th>
                                            <th>Pendanaan</th>
                                            <th>Tahun</th>
                                            <th>Angkatan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
