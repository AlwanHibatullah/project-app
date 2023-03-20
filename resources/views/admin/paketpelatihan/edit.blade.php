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
Edit Paket pelatihan
@endsection

@section('kembali')
    <li class="breadcrumb-item"><a href="/paketpelatihan">Kembali</a></li>
@endsection

@section('content')
<div class="row g-3">
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal" action="/paketpelatihan/{{$paketpelatihan->id}}"  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-6 mb-3">
                        <label>Subkejuruan :</label>
                        {{-- <div class="input-group">
                            <select name="subkejuruan_id" class="form-control select2 form-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true">
                                @forelse ($subkejuruan as $key=>$value)
                                    @if ($value->id === $paketpelatihan->subkejuruan_id )
                                        <option value="{{$value->id}}" selected>{{$value->subkejuruan}}</option>
                                    @else
                                        <option value="{{$value->id}}">{{$value->subkejuruan}}</option>
                                    @endif
                                @empty
                                    tidak ada option
                                @endforelse
                            </select>
                        </div> --}}
                        <div class="input-group">
                            <select name="subkejuruan_id" class="select2 form-select shadow-none" style="width: 100%; height:36px;">
                                <option>Pilih Subkejuruan</option>
                                @forelse ($kejuruan as $key=>$value)
                                    <optgroup label="{{$value->kejuruan}}">
                                        @foreach ($subkejuruan as $key1=>$value1 )
                                            @if ($value->id == $value1->kejuruan_id)
                                                @if ($value1->id === $paketpelatihan->subkejuruan_id )
                                                    <option value="{{$value1->id}}" selected>{{$value1->subkejuruan}}</option>
                                                @else
                                                    <option value="{{$value1->id}}">{{$value1->subkejuruan}}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </optgroup>
                                @empty
                                    tidak ada data
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label>Jenis Pelatihan :</label>
                        <div class="input-group">
                            <select name="jpelatihan_id" class="form-control select2 form-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true">
                                @forelse ($jpelatihan as $key=>$value)
                                    @if ($value->id === $paketpelatihan->jpelatihan_id)
                                        <option value="{{$value->id}}" selected>{{$value->jpelatihan}}</option>
                                    @else
                                        <option value="{{$value->id}}">{{$value->jpelatihan}}</option>
                                    @endif
                                @empty
                                    tidak ada option
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label>Pendanaan :</label>
                        <div class="input-group">
                            <select name="dana_id" class="form-control select2 form-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true">
                                @forelse ($dana as $key=>$value)
                                    @if ($value->id === $paketpelatihan->dana_id)
                                        <option value="{{$value->id}}" selected>{{$value->dana}}</option>
                                    @else
                                        <option value="{{$value->id}}">{{$value->dana}}</option>
                                    @endif
                                @empty
                                    tidak ada option
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label>Nama Pelatihan :</label>
                        <input type="text" class="form-control" name="namapelatihan" value="{{ $paketpelatihan->namapelatihan }}">
                        @error('namapelatihan')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label>Angkatan :</label>
                        <input type="number" class="form-control" name="angkatan" value="{{ $paketpelatihan->angkatan }}">
                        @error('angkatan')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label>Jam Pembelajaran :</label>
                        <input type="number" class="form-control" name="jp" value="{{ $paketpelatihan->jp}}">
                        @error('jp')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label>Tahun :</label>
                        <input type="number" class="form-control" name="tahun" value="{{ $paketpelatihan->tahun}}">
                        @error('tahun')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label>Jumlah Siswa :</label>
                        <input type="number" class="form-control" name="jumlah_siswa" value="{{ $paketpelatihan->jumlah_siswa}}">
                        @error('jumlah_siswa')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label>Tanggal Test: </label>
                        <div class="input-group">
                            <input type="text" name="awalpelatihan" class="form-control mydatepicker"
                            value="{{ str_replace('/', '-', date("m/d/Y", strtotime($paketpelatihan->test)));  }}">
                            <div class="input-group-append">
                                <span class="input-group-text h-100"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        @error('test')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label>Tanggal Pembukaan: </label>
                        <div class="input-group">
                            <input type="text" name="pembukaan" class="form-control mydatepicker"
                            value="{{ str_replace('/', '-', date("m/d/Y", strtotime($paketpelatihan->pembukaan)));  }}">
                            <div class="input-group-append">
                                <span class="input-group-text h-100"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        @error('pembukaan')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label>Tanggal Awal Pelatihan: </label>
                        <div class="input-group">
                            <input type="text" name="awalpelatihan" class="form-control mydatepicker"
                            value="{{ str_replace('/', '-', date("m/d/Y", strtotime($paketpelatihan->awalpelatihan)));  }}">
                            <div class="input-group-append">
                                <span class="input-group-text h-100"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        @error('awalpelatihan')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label>Tanggal Selesai Pelatihan : </label>
                        <div class="input-group">
                            <input type="text" name="selesaipelatihan" class="form-control mydatepicker"
                            value="{{ str_replace('/', '-', date("m/d/Y", strtotime($paketpelatihan->selesaipelatihan)));  }}">
                            <div class="input-group-append">
                                <span class="input-group-text h-100"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        @error('selesaipelatihan')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label>Tanggal Penutupan: </label>
                        <div class="input-group">
                            <input type="text" name="penutupan" class="form-control mydatepicker"
                            value="{{ str_replace('/', '-', date("m/d/Y", strtotime($paketpelatihan->penutupan)));  }}">
                            <div class="input-group-append">
                                <span class="input-group-text h-100"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        @error('penutupan')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label>Link Group Diskusi :</label>
                        <input type="text" class="form-control" name="group"  value="{{ $paketpelatihan->group }}">
                        @error('group')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label>Status :</label>
                        <div class="input-group">
                            <select name="status" class="form-control select2 form-select select2-hidden-accessible" style="width: 100%; height:36px;" tabindex="-1" aria-hidden="true">
                                <option value="{{ $paketpelatihan->status}}">
                                    @if ($paketpelatihan->status == 1)
                                        <option value=1 selected>Belum di Publish</option>
                                        <option value=2>Publish untuk Pendaftaran</option>
                                        <option value=3>Pelatihan Sedang Berjalan</option>
                                        <option value=4>Pelatihan Selesai</option>
                                    @elseif ($paketpelatihan->status == 2)
                                        <option value=1>Belum di Publish</option>
                                        <option value=2 selected>Publish untuk Pendaftaran</option>
                                        <option value=3>Pelatihan Sedang Berjalan</option>
                                        <option value=4>Pelatihan Selesai</option>
                                    @elseif ($paketpelatihan->status == 3)
                                        <option value=1>Belum di Publish</option>
                                        <option value=2>Publish untuk Pendaftaran</option>
                                        <option value=3 selected>Pelatihan Sedang Berjalan</option>
                                        <option value=4>Pelatihan Selesai</option>
                                    @elseif ($paketpelatihan->status == 4)
                                        <option value=1>Belum di Publish</option>
                                        <option value=2>Publish untuk Pendaftaran</option>
                                        <option value=3>Pelatihan Sedang Berjalan</option>
                                        <option value=4 selected>Pelatihan Selesai</option>
                                    @endif
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 my-auto">
                        <input type="submit" class="btn btn-info btn-md text-white " value="Update">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
