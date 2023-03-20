@extends('admin.master')

@section('judul')
Profile
@endsection

@section('kembali')
    <li class="breadcrumb-item"><a href="/profile">Kembali</a></li>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-3"><label for="">Nama Pegawai</label></div>
            <div class="col-9"><label for="">{{ $profile->nama_pegawai }}</label></div>
            <div class="col-3"><label for="">Email</label></div>
            <div class="col-9"><label for="">{{ $profile->user->email }}</label></div>
            <div class="col-3"><label for="">NIP</label></div>
            <div class="col-9"><label for="">{{ $profile->nip }}</label></div>
            <div class="col-3"><label for="">Jabatan</label></div>
            <div class="col-9"><label for="">{{ $profile->jabatan }}</label></div>
            <div class="col-3"><label for="">Jenis Kelamin</label></div>
            @if ($profile->jenis_kelamin == 1)
                <div class="col-9"><label for="">Perempuan</label></div>
            @else
            <div class="col-9"><label for="">Laki-laki</label></div>
            @endif
            <div class="col-3"><label for="">Alamat</label></div>
            <div class="col-9"><label for="">{{ $profile->alamat }}</label></div>
        </div>
    </div>
</div>
@endsection
