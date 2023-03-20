@extends('admin.master')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset ('/template/assets/libs/select2/dist/css/select2.min.cs') }}s">
    <link rel="stylesheet" type="text/css" href="{{asset ('/template/assets/libs/jquery-minicolors/jquery.minicolors.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{asset ('/template/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset ('/template/assets/libs/quill/dist/quill.snow.css') }}">
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
@endpush

@section('judul')
Detail Data Pendaftar
@endsection

@section('kembali')
    <li class="breadcrumb-item"><a href="/pendaftaran">Kembali</a></li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <Label>Nama Pendaftar</Label>
            </div>
            <div class="col-8">
                <h6>{{ $riwayat->nama_pendaftar }}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>NIK</Label>
            </div>
            <div class="col-8">
                <p>{{ $riwayat->nik}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Tempat Lahir</Label>
            </div>
            <div class="col-8">
                <p>{{ $riwayat->tempat_lahir}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Tanggal Lahir</Label>
            </div>
            <div class="col-8">
                <p>{{ $riwayat->tgl_lahir}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Status Pernikahan</Label>
            </div>
            <div class="col-8">
                <p>
                    @if ($riwayat->status_pernikahan == 1)
                        Menikah
                    @elseif ($riwayat->status_pernikahan == 2)
                        Belum Menikah
                    @endif
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>No Telpon Pendaftar</Label>
            </div>
            <div class="col-8">
                <p>{{ $riwayat->telp}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>No Telpon Wali</Label>
            </div>
            <div class="col-8">
                <p>{{ $riwayat->telpwali}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Email</Label>
            </div>
            <div class="col-8">
                <p>{{ $riwayat->email}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Tinggi Badan</Label>
            </div>
            <div class="col-8">
                <p>{{ $riwayat->tb}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Berat Badan</Label>
            </div>
            <div class="col-8">
                <p>{{ $riwayat->bb}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Nama Orang Tua/Wali</Label>
            </div>
            <div class="col-8">
                <p>{{ $riwayat->orangtua}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Alamat</Label>
            </div>
            <div class="col-8">
                <p>{{ $riwayat->alamat_detail}}, {{ $riwayat->desa }}, {{ $riwayat->kecamtan}}, {{ $riwayat->kabupaten }}, {{ $riwayat->provinsi }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Pendidikan Terakhir</Label>
            </div>
            <div class="col-8">
                <p>{{ $riwayat->pendidikan_terakhir}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Nama Sekolah</Label>
            </div>
            <div class="col-8">
                <p>{{ $riwayat->nama_sekolah}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Jurusan</Label>
            </div>
            <div class="col-8">
                <p>{{ $riwayat->jurusan_prodi}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Tahun Lulus</Label>
            </div>
            <div class="col-8">
                <p>{{ $riwayat->tahun_lulus}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Nilai Rata-Rata</Label>
            </div>
            <div class="col-8">
                <p>{{ $riwayat->nilai_rata}}</p>
            </div>
        </div>
        <form action="/riwayat/{{ $riwayat->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-4">
                    <Label>Paket Pelatihan yang Didaftar</Label>
                </div>
                <div class="col-8">
                    <div class="input-group">
                        <select name="paketpelatihan_id" id="interest" class="form-select" aria-label="select-interest">
                            @foreach ( $subkejuruan as $key=>$value )
                                <optgroup label="{{ $value->subkejuruan }}" data-select2-id="15">
                                    @foreach ( $paketpelatihan as $key1=>$value1 )
                                        @if ($value->id == $value1->subkejuruan_id)
                                            @if ($value1->id == $riwayat->paketpelatihan_id)
                                                <option selected value="{{ $value1->id }}" data-select2-id="16">{{ $value1->namapelatihan }}</option>
                                            @else
                                                <option value="{{ $value1->id }}" data-select2-id="16">{{ $value1->namapelatihan }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <input type="Submit" class="btn btn-info btn-md my-1" value="Update">
        </form>
    </div>
</div>
@endsection
