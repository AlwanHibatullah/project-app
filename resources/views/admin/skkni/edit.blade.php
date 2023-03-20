@extends('admin.master')

@section('judul')
Edit SKKNI / Silabus
@endsection

@section('kembali')
    <li class="breadcrumb-item"><a href="/skkni">Kembali</a></li>
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
<div class="card">
   <div class="card-body">
        <div class="row g-3">
            <form class="form-horizontal" action="/skkni/{{$skkni->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-4 mb-3">
                        <label>Subkejuruan : </label>
                        <select name="subkejuruan_id" class="select2 form-select shadow-none select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true">
                           <option value={{$skkni->subkejuruan_id}}>{{$skkni->subkejuruan->subkejuruan}}</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label>Pendanaan : </label>
                        <select name="dana_id" class="select2 form-select shadow-none select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true">
                            <option value={{$skkni->dana_id}}>{{$skkni->dana->dana}}</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label>Kode Unit :</label>
                        <input type="text" class="form-control" name="kode_unit" value="{{ $skkni->kode_unit}}">
                        @error('kode_unit')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label>Unit Kompetensi</label>
                        <input type="text" class="form-control" name="unit_kompetensi" value="{{ $skkni->unit_kompetensi }}">
                        @error('unit_kompetensi')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label>Jam Pelajaran Teori</label>
                        <input type="number" class="form-control" name="jp_teori" value="{{ $skkni->jp_teori }}">
                        @error('jp_teori')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label>Jam Pelajaran Praktik</label>
                        <input type="number" class="form-control" name="jp_praktik" value="{{ $skkni->jp_praktik }}">
                        @error('jp_praktik')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label>Kelompok Unit</label>
                            <select name="kelompok_unit" class="select2 form-select shadow-none select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true">
                                @if ($skkni->kelompok_unit == 1)
                                    <option selected value=1>KOMPETENSI UMUM / DASAR</option>
                                @else
                                    <option selected value=2>KOMPETENS INTI</option>
                                @endif
                                <option value=1>KOMPETENSI UMUM / DASAR</option>
                                <option value=2>KOMPETENS INTI</option>
                            </select>
                    </div>
                    <div class="col-lg-4 my-auto">
                        <input type="submit" class="btn btn-info btn-md text-white " value="Edit">
                    </div>
                </div>
            </form>
        </div>
   </div>
</div>
<div class="card">
    <div style="overflow: auto">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Basic Datatable</h5>
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
                            @forelse ( $skkni_view as $key=>$value )
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <th>{{$value->subkejuruan->subkejuruan}} | {{$value->dana->dana}}</th>
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
{{-- <div class="card">
    <div class="card-body">
        <h5 class="card-title">Nama Hasil Cari</h5>
        <div style="overflow: auto">
            <table class="table table-resposif">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">Subkejuruan| Pendanaan</th>
                        <th scope="col">Kode Unit</th>
                        <th scope="col">Unit Kompetensi</th>
                        <th scope="col">Jam Teori</th>
                        <th scope="col">Jam Praktik</th>
                        <th scope="col">Kelompok Unit</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ( $skkni_view as $key=>$value )
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <th>{{$value->subkejuruan->subkejuruan}} | {{$value->dana->dana}}</th>
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
                        <tr colspan="3">
                            <td>No data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div> --}}
@endsection
