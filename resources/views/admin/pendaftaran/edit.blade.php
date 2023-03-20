@extends('admin.master')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset ('/template/assets/libs/select2/dist/css/select2.min.cs') }}s">
    <link rel="stylesheet" type="text/css" href="{{asset ('/template/assets/libs/jquery-minicolors/jquery.minicolors.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{asset ('/template/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset ('/template/assets/libs/quill/dist/quill.snow.css') }}">
    <link rel="stylesheet" href="register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"
        defer></script>
@endpush

@push('scripts')
    {{--  --}}
@endpush

@section('judul')
Edit data Pendaftran Pelatihan
@endsection

@section('kembali')
    <li class="breadcrumb-item"><a href="/pandaftran">Kembali</a></li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="container-sm container-md">
            <form action="/pendaftaran/{{ $pendaftaran->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3 my-2">
                    <!-- Data Pribadi -->
                    <div class="col-sm-12">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control" id="nik" value="{{ $pendaftaran->nik }}">
                        @error('nik')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-sm-12">
                        <label for="fullname" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_pendaftar" class="form-control" id="fullname" value="{{ $pendaftaran->nama_pendaftar }}">
                        @error('nama_pendaftar')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="birthplace" class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" id="birthplace" value="{{ $pendaftaran->tempat_lahir }}">
                        @error('tempat_lahir')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="birthdate" class="form-label">Tanggal Lahir</label>
                        <input type="text" name="tgl_lahir" class="form-control" id="birthdate" value="{{ str_replace('/', '-', date("d/m/Y", strtotime($pendaftaran->tgl_lahir)));  }}">
                        @error('tgl_lahir')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-sm-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        @if ($pendaftaran->jenis_kelamin == 1)
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="jenis_kelamin" id="male" value="1" checked>
                                <label for="male" class="form-check-label">Pria</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="jenis_kelamin" id="female" value="1">
                                <label for="female" class="form-check-label">Wanita</label>
                            </div>
                        @elseif ($pendaftaran->jenis_kelamin == 2)
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="jenis_kelamin" id="male" value="1" checked>
                                <label for="male" class="form-check-label">Pria</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="jenis_kelamin" id="female" value="1">
                                <label for="female" class="form-check-label">Wanita</label>
                            </div>
                        @endif
                        @error('jenis_kelamin')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-sm-3">
                        @if ($pendaftaran->status_pernikahan == 1)
                            <label for="m_status" class="form-label">Status Pernikahan</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="status_pernikahan" id="married" value="1" checked>
                                <label for="married" class="form-check-label">Menikah</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="status_pernikahan" id="single" value="2">
                                <label for="single" class="form-check-label">Belum Menikah</label>
                            </div>
                        @elseif ($pendaftaran->status_pernikahan == 2)
                        <label for="m_status" class="form-label">Status Pernikahan</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="status_pernikahan" id="married" value="1">
                                <label for="married" class="form-check-label">Menikah</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="status_pernikahan" id="single" value="2" checked>
                                <label for="single" class="form-check-label">Belum Menikah</label>
                            </div>
                        @endif
                        @error('status_pernikahan')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="height" class="form-label">Tinggi Badan</label>
                        <div class="row align-items-center">
                            <div class="col-4">
                                <input type="text" name="tb" class="form-control" id="height" value="{{ $pendaftaran->tb }}">
                            </div>
                            <div class="col-3">
                                <span>cm</span>
                            </div>
                        </div>
                        @error('tb')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="weight" class="form-label">Berat Badan</label>
                        <div class="row align-items-center">
                            <div class="col-4">
                                <input type="text" name="bb" class="form-control" id="weight" value="{{ $pendaftaran->bb }}">
                            </div>
                            <div class="col-3">
                                <span>kg</span>
                            </div>
                            @error('bb')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="parent" class="form-label">Nama Orang Tua / Wali</label>
                        <input type="text" name="orangtua" class="form-control" id="parent" value="{{ $pendaftaran->orangtua }}">
                        @error('orangtua')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="parent" class="form-label">Nama Orang Tua / Wali</label>
                        <input type="text" name="email" class="form-control" id="parent" value="{{ $pendaftaran->email }}">
                        @error('email')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea name="alamat_detail" class="form-control no-resize" id="address" rows="5">{{ $pendaftaran->alamat_detail }}</textarea>
                        @error('alamat_detail')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="col-md-3">Upload KTP</label>
                        <div class="col-md-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="validatedCustomFile" name="status_ktp" required="">
                                @error('status_ktp')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- end of Kontak Pribadi -->

                    <!-- Pendidikan Terakhir -->
                    <!-- Bagian ini kalo bisa ngambil datanya dari database -->
                    <div class="col-12">
                        <label for="education" class="form-label">Pendidikan Terakhir</label>
                        <select name="pendidikan_terakhir" id="education" class="form-select" aria-label="Default select example">
                            @if ($pendaftaran->pendidikan_terakhir == 1)
                                <option value="1" selected>SD</option>
                                <option value="2">SMP</option>
                                <option value="3">SMA</option>
                                <option value="4">SMK</option>
                                <option value="5">D3</option>
                                <option value="6">S1</option>
                            @elseif ($pendaftaran->pendidikan_terakhir == 2)
                                <option value="1">SD</option>
                                <option value="2" selected>SMP</option>
                                <option value="3">SMA</option>
                                <option value="4">SMK</option>
                                <option value="5">D3</option>
                                <option value="6">S1</option>
                            @elseif ($pendaftaran->pendidikan_terakhir == 3)
                                <option value="1">SD</option>
                                <option value="2">SMP</option>
                                <option value="3" selected>SMA</option>
                                <option value="4">SMK</option>
                                <option value="5">D3</option>
                                <option value="6">S1</option>
                            @elseif ($pendaftaran->pendidikan_terakhir == 4)
                                <option value="1">SD</option>
                                <option value="2">SMP</option>
                                <option value="3">SMA</option>
                                <option value="4" selected>SMK</option>
                                <option value="5">D3</option>
                                <option value="6">S1</option>
                            @elseif ($pendaftaran->pendidikan_terakhir == 5)
                                <option value="1">SD</option>
                                <option value="2">SMP</option>
                                <option value="3">SMA</option>
                                <option value="4">SMK</option>
                                <option value="5" selected>D3</option>
                                <option value="6">S1</option>
                            @elseif ($pendaftaran->pendidikan_terakhir == 6)
                                <option value="1">SD</option>
                                <option value="2">SMP</option>
                                <option value="3">SMA</option>
                                <option value="4">SMK</option>
                                <option value="5">D3</option>
                                <option value="6" selected>S1</option>
                            @endif
                        </select>
                        @error('pendidikan_terakhir')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="row g-3">
                            <div class="col-6">
                                <label for="school_name" class="form-label">Nama Sekolah / Universitas</label>
                                <input type="text" name="nama_sekolah" class="form-control" id="school_name"
                                    value="{{ $pendaftaran->nama_sekolah }}">
                                @error('nama_sekolah')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="graduate" class="form-label">Tahun Lulus</label>
                                <input type="text" name="tahun_lulus" class="form-control" id="graduate" value="{{ $pendaftaran->tahun_lulus }}">
                                @error('nama_sekolah')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="consentration" class="form-label">Jurusan / Prodi</label>
                                <input type="text" name="jurusan_prodi" class="form-control" id="consentration" value="{{ $pendaftaran->jurusan_prodi }}">
                                @error('jurusan_prodi')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="final_score" class="form-label">Nilai Akhir / IPK</label>
                                <input type="text" name="nilai_rata" class="form-control" id="final_score" value="{{ $pendaftaran->nilai_rata }}">
                                @error('nilai_rata')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- end of Pendidikan Terakhir -->

                    <!-- Kejuruan -->
                    <!-- Bagian ini juga sama, kalo bisa ngambil datanya dari database -->
                    <div class="col-12">
                        <label for="interest" class="form-label">Kejuruan Yang Dipilih</label>
                        <select name="paketpelatihan_id" id="interest" class="form-select" aria-label="select-interest">
                            @foreach ( $subkejuruan as $key=>$value )
                                <optgroup label="{{ $value->subkejuruan }}" data-select2-id="15">
                                    @foreach ( $paketpelatihan as $key1=>$value1 )
                                        @if ($value->id == $value1->subkejuruan_id)
                                            @if ($value1->id == $pendaftaran->paketpelatihan_id)
                                                <option selected value="{{ $value1->id }}" data-select2-id="16">{{ $value1->namapelatihan }}</option>
                                            @else
                                            <option value="{{ $value1->id }}" data-select2-id="16">{{ $value1->namapelatihan }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @error('paketpelatihan_id')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                         @enderror
                    </div>
                    <!-- end of Kejuruan -->
                </div>
                <button type="submit" class="btn btn-primary">Edit Data</button>
            </form>
        </div>
    </div>
</div>
@endsection
