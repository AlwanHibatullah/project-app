@extends('admin.master')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset ('/template/assets/libs/select2/dist/css/select2.min.cs') }}s">
    <link rel="stylesheet" type="text/css" href="{{asset ('/template/assets/libs/jquery-minicolors/jquery.minicolors.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{asset ('/template/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset ('/template/assets/libs/quill/dist/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/template/assets/extra-libs/multicheck/multicheck.css') }}">
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('/dist/css/style.min.css') }}" rel="stylesheet">
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
Detail Paket pelatihan
@endsection

@section('kembali')
    <li class="breadcrumb-item"><a href="/paketpelatihan">Kembali</a></li>
@endsection

@section('content')
<div class="row flex-lg-row-reverse g-3">
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @if ($paketpelatihan->status == 1)
                        Belum ada data.
                    @elseif ($paketpelatihan->status == 2)
                        <a href="" class="btn btn-sm rounded btn-primary mb-3">Download Data Pendaftar</a>
                        <a href="" class="btn btn-sm rounded btn-success text-white"> Cetak Data Pendaftar</a>
                    @elseif ($paketpelatihan->status == 3)
                        <a href="" class="btn btn-sm rounded btn-primary mb-3">Download Data Siswa</a>
                        <a href="/download-absen-siswa/{{ $paketpelatihan->id }}" class="btn btn-sm rounded btn-success text-white"> Download Absen Siswa</a>
                    @elseif ($paketpelatihan->status == 4)
                        <a href="" class="btn btn-sm rounded btn-primary mb-3">Download Data Alumn</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="me-auto p-2">
                        <p class="btn btn-info btn-sm text-white rounded" style="font-size: 14px" >
                            @if ($paketpelatihan->status == 1)
                                Belum di Publish
                            @elseif ($paketpelatihan->status == 2)
                                Publish untuk Pendaftran
                            @elseif ($paketpelatihan->status == 3)
                                Pelatihan sedang Berjalan
                            @elseif ($paketpelatihan->status == 4)
                                Pelatihan Selsai
                            @endif
                        </p>
                    </div>
                    <div class="p-2">
                        <a href="/paketpelatihan/{{$paketpelatihan->id}}/edit" class="btn btn-sm btn-secondary rounded">Edit</a>
                    </div>
                    @if ($paketpelatihan->status == 1)
                        <div class="p-2">
                            <form action="/paketpelatihan/{{$paketpelatihan->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger btn-sm text-white rounded" value="Hapus">
                            </form>
                        </div>
                    @endif
                  </div>
                <div class="row">
                    <label for="" class="col-4">Nama Pelatihan</label>
                    <h4 class="col-8">{{ $paketpelatihan->namapelatihan }}</h4>

                    <label for="" class="col-4">Subkejuruan</label>
                    <p class="col-8">{{ $paketpelatihan->subkejuruan->kejuruan->kejuruan.' - '.$paketpelatihan->subkejuruan->subkejuruan }}</p>

                    <label for="" class="col-4">Angkatan</label>
                    <p class="col-8">{{ $paketpelatihan->dana->dana.' - '. $paketpelatihan->angkatan }}</p>

                    <label for="" class="col-4">Tahun</label>
                    <p class="col-8">{{ $paketpelatihan->tahun }}</p>

                    <label for="" class="col-4">Jenis Pelatian</label>
                    <p class="col-8">{{ $paketpelatihan->jpelatihan->jpelatihan }}</p>

                    <label for="" class="col-4">Jumlah Siswa</label>
                    <p class="col-8">{{ $paketpelatihan->jumlah_siswa }}</p>

                    <label for="" class="col-4">Tanggal Test / wawancara</label>
                    <p class="col-8">{{date('l', strtotime($paketpelatihan->test)).', '.str_replace('/', ' ', date("d/m/Y", strtotime($paketpelatihan->test)))}}</p>

                    <label for="" class="col-4">Tanggal Pembukaan</label>
                    <p class="col-8">{{date('l', strtotime($paketpelatihan->pembukaan)).', '.str_replace('/', ' ', date("d/m/Y", strtotime($paketpelatihan->pembukaan)))}}</p>

                    <label for="" class="col-4">Tanggal Mulai Pelatihan</label>
                    <p class="col-8">{{date('l', strtotime($paketpelatihan->awalpelatihan)).', '.str_replace('/', ' ', date("d/m/Y", strtotime($paketpelatihan->awalpelatihan)))}}</p>

                    <label for="" class="col-4">Tanggal Selesai Pelatihan</label>
                    <p class="col-8">{{date('l', strtotime($paketpelatihan->selesaipelatihan)).', '.str_replace('/', ' ', date("d/m/Y", strtotime($paketpelatihan->selesaipelatihan)))}}</p>

                    <label for="" class="col-4">Tanggal Penutupan</label>
                    <p class="col-8">{{date('l', strtotime($paketpelatihan->petutupan)).', '.str_replace('/', ' ', date("d/m/Y", strtotime($paketpelatihan->penutupan)))}}</p>

                    <label for="" class="col-4">Link Group Diskusi</label>
                    <a href="{{ $paketpelatihan->group }}" class="col-8">{{ $paketpelatihan->group }}</a>
                </div>
                <div class="row">
                    <div class="col-4">
                        <Label>SKKNI</Label>
                    </div>
                    <div class="col-8">
                        <table >
                            <thead>
                                <tr class="m-1">
                                    <th scope="col">Kode Unit</th>
                                    <th scope="col">Unit Kompetensi</th>
                                    <th scope="col">JP</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ( $skkni as $key=>$value )
                                    <tr>
                                        <td class="px-1 py-1">{{$value->kode_unit}}</td>
                                        <td class="px-1 py-1">{{$value->unit_kompetensi}}</td>
                                        <td>{{$value->jp_praktik+$value->jp_teori}}</td>
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
                <div class="row">
                    <div class="col-2">

                    </div>
                    <div class="col-2">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($paketpelatihan->status == 2)
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <form action="pelatihan-pendaftaran-action" method="POST">
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
                                <input type="submit" value="Tambah" class="btn btn-sm btn-info rounded">
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
@elseif ($paketpelatihan->status == 3)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <form action="/pelatihan-siswa-action" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-3">
                            <select name="hasil" class="select2 form-select shadow-none" style="width: 100%; height:36px;">
                                <option>Pilih Hasil Pelatihan</option>
                                <option value="1">Lulus Pelatihan</option>
                                <option value="2">Tidak Lulus</option>
                                <option value="3">Keluar/Berhenti</option>
                            </select>
                        </div>
                        <input type="text" style="display: none" name="paketpelatihan_id" value="{{ $paketpelatihan->id }}">
                        <div class="col-3">
                            <input type="submit" value="Masukan" class="btn btn-md btn-info">
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
                                <th scope="col">No Induk</th>
                                <th scope="col">Nama Peserta</th>
                                <th scope="col">Tempat Tanggal Lahir</th>
                                <th scope="col">Nomor Telpon</th>
                                <th scope="col">Pendidikan/Tahun</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Tinggi Badan/Berat Badan</th>
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
                                        <a href="/pelatihan-siswa-detail/{{$value->id}}" class="btn btn-info btn-sm">Detail</a>
                                    </td>
                                    <td>{{ $value->noinduk }}</td>
                                    <td>{{ $value->nama_pendaftar }}</td>
                                    <td>{{ $value->tempat_lahir.', '.str_replace('/', ' ', date("d/m/Y", strtotime($value->tgl_lahir))) }}</td>
                                    <td>{{ $value->telp }}</td>
                                    <td>
                                        @if ($value->pendidikan_terakhir == 1)
                                            SD/ .{{ $value->jurusan_prodi }}/ {{ $value->tahun_lulus }}
                                        @elseif ($value->pendidikan_terakhir == 2)
                                            SMP/ .{{ $value->jurusan_prodi }}/ {{ $value->tahun_lulus }}
                                        @elseif ($value->pendidikan_terakhir == 3)
                                            SMA/ .{{ $value->jurusan_prodi }}/ {{ $value->tahun_lulus }}
                                        @elseif ($value->pendidikan_terakhir == 4)
                                            SMK/ .{{ $value->jurusan_prodi }}/ {{ $value->tahun_lulus }}
                                        @elseif ($value->pendidikan_terakhir == 5)
                                            D1/ .{{ $value->jurusan_prodi }}/ {{ $value->tahun_lulus }}
                                        @elseif ($value->pendidikan_terakhir == 6)
                                            S1/ .{{ $value->jurusan_prodi }}/ {{ $value->tahun_lulus }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($value->jenis_kelamin == 1)
                                            Laki-Laki
                                        @elseif ($value->jenis_kelamin == 2)
                                            Perempuan
                                        @endif
                                    </td>
                                    <td>{{ $value->tb.'/ '.$value->bb}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
@elseif ($paketpelatihan->status == 4)
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
                        @foreach ( $alumni as $key=>$value )
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
@endif

@endsection
