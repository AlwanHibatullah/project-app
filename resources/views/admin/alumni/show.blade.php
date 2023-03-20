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
Detail Data Siswa Pelatihan
@endsection

@section('kembali')
    <li class="breadcrumb-item"><a href="/bukuinduk">Kembali</a></li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <Label>Nama Pendaftar</Label>
            </div>
            <div class="col-8">
                <h6>{{ $bukuinduk->nama_pendaftar }}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>NIK</Label>
            </div>
            <div class="col-8">
                <p>{{ $bukuinduk->nik}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Tempat Lahir</Label>
            </div>
            <div class="col-8">
                <p>{{ $bukuinduk->tempat_lahir}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Tanggal Lahir</Label>
            </div>
            <div class="col-8">
                <p>{{ $bukuinduk->tgl_lahir}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Status Pernikahan</Label>
            </div>
            <div class="col-8">
                <p>
                    @if ($bukuinduk->status_pernikahan == 1)
                        Menikah
                    @elseif ($bukuinduk->status_pernikahan == 2)
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
                <p>{{ $bukuinduk->telp}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>No Telpon Wali</Label>
            </div>
            <div class="col-8">
                <p>{{ $bukuinduk->telpwali}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Email</Label>
            </div>
            <div class="col-8">
                <p>{{ $bukuinduk->email}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Tinggi Badan</Label>
            </div>
            <div class="col-8">
                <p>{{ $bukuinduk->tb}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Berat Badan</Label>
            </div>
            <div class="col-8">
                <p>{{ $bukuinduk->bb}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Nama Orang Tua/Wali</Label>
            </div>
            <div class="col-8">
                <p>{{ $bukuinduk->orangtua}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Alamat</Label>
            </div>
            <div class="col-8">
                <p>{{ $bukuinduk->alamat_detail}}, {{ $bukuinduk->desa }}, {{ $bukuinduk->kecamtan}}, {{ $bukuinduk->kabupaten }}, {{ $bukuinduk->provinsi }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Pendidikan Terakhir</Label>
            </div>
            <div class="col-8">
                <p>{{ $bukuinduk->pendidikan_terakhir}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Nama Sekolah</Label>
            </div>
            <div class="col-8">
                <p>{{ $bukuinduk->nama_sekolah}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Jurusan</Label>
            </div>
            <div class="col-8">
                <p>{{ $bukuinduk->jurusan_prodi}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Tahun Lulus</Label>
            </div>
            <div class="col-8">
                <p>{{ $bukuinduk->tahun_lulus}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Nilai Rata-Rata</Label>
            </div>
            <div class="col-8">
                <p>{{ $bukuinduk->nilai_rata}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Label>Paket Pelatihan yang Didaftar</Label>
            </div>
            <div class="col-8">
                <p>{{ $bukuinduk->paketpelatihan->namapelatihan}}</p>
            </div>
        </div>
        @if ($alumni == null)
            <a href="/alumni/{{$bukuinduk->id}}/edit" class="btn btn-info btn-md my-1">Sertifikat</a>
        @else
            <div class="row">
                <div class="col-4">
                    <Label>Predikat</Label>
                </div>
                <div class="col-8">
                    <p>{{ $alumni->predikat}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <Label>No Sertifikat</Label>
                </div>
                <div class="col-8">
                    <p>{{ $alumni->no_sertifikat}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <Label>File Sertikat</Label>
                </div>
                <div class="col-8">
                    <p>{{ $alumni->file_sertifikat}}</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
