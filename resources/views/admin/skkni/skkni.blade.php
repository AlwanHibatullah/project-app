@extends('admin.master')

@section('judul')
SKKNI / Silabus
@endsection

@section('kembali')
    <li class="breadcrumb-item"><a href="/skkni-tambah">Kembali</a></li>
@endsection

@push('styles')
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

@section('content')
<div class="row">
    <div class="">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" action="/skkni-tambah" method="POST">
                    @csrf
                    <label>Subkejuruan</label>
                    <select name="subkejuruan_id" class="select2 form-select shadow-none" style="width: 100%; height:36px;">
                        <option>Pilih Subkejuruan</option>
                        @forelse ($kejuruan as $key=>$value)
                            <optgroup label="{{$value->kejuruan}}">
                                @foreach ($subkejuruan as $key1=>$value1 )
                                    @if ($value->id == $value1->kejuruan_id)
                                        <option value="{{$value1->id}}">{{$value1->subkejuruan}}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @empty
                            tidak ada data
                        @endforelse
                    </select>

                    <label class="mt-3">Pendanaan</label>
                        <select name="dana_id" class="select2 form-select shadow-none select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true">
                            <option>Pilih Pendanaan</option>
                            @forelse ($dana as $key=>$value)
                                <option value="{{$value->id}}">{{$value->dana}}</option>
                            @empty
                                tidak ada data
                            @endforelse
                        </select>
                    <label></label>
                    <input type="submit" style="width: 100%" class="btn btn-info btn-md text-white my-1" value="Tambah">
                </form>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div style="overflow: auto">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data SKKNI/Silabus</h5>
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Subkejuruan Pendanaan</th>
                                <th>Kode Unit</th>
                                <th>Unit Kompetensi</th>
                                <th>Jam Teori</th>
                                <th>Jam Praktik</th>
                                <th>Kelompok Unit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $skkni as $key=>$value )
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <th>{{$value->subkejuruan->subkejuruan}}  {{$value->dana->dana}}</th>
                                    <th>{{$value->kode_unit}}</th>
                                    <td>{{$value->unit_kompetensi}}</td>
                                    <td>{{$value->jp_teori}}</td>
                                    <td>{{$value->jp_praktik}}</td>
                                    <td>
                                        @if ($value->kelompok_unit == 1)
                                            KOMPETENSI UMUM / DASAR
                                        @else
                                            KOMPETENS INTI
                                        @endif
                                    </td>
                                    <td class="">
                                        <a href="/skkni/{{$value->id}}/edit" class="btn btn-info btn-sm my-1">Edit</a>
                                        <form action="/skkni/{{$value->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger btn-sm text-white my-1" value="Hapus">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>NO</th>
                                <th>Subkejuruan/ Pendanaan</th>
                                <th>Kode Unit</th>
                                <th>Unit Kompetensi</th>
                                <th>Jam Teori</th>
                                <th>Jam Praktik</th>
                                <th>Kelompok Unit</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
