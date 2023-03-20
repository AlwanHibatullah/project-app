<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Kelulusan pelatihan UPTD BLK Karawang</title>
</head>
<body>
    <h3>{{ 'Konfirmasi Kelulusan' }}</h3>
    <p>{{ $details['nama'].', '.$details['title'].' pada kejuruan '.$details['kejuruan'].' '.$details['pelatihan'].' '.$details['dana'].' '.$details['angkatan'] }}</p>
    <p>Dengan ini seluruh siswa dapat mengikuti rangkaian pelatihan sedari pembukaan hingga penutupan pelatihan serta dapat mematuhi semua peraturan yang berlaku selama mengikuti pelatihan. Berikut informasi pelatihan yang akan diikuti oleh siswa sebagai berikut:</p>
    <table>
        <tr>
            <td>Pembukaan Pelatihan :</td>
            <td>{{ $details['pembukaan']}}</td>
        </tr>
        <tr>
            <td>Awal Pelatihan :</td>
            <td>{{ $details['awalpelatihan'] }}</td>
        </tr>
        <tr>
            <td>Selesai Pelatihan :</td>
            <td>{{ $details['selesaipelatihan'] }}</td>
        </tr>
        <tr>
            <td>Penutupan Pelatihan :</td>
            <td>{{ $details['penutupan'] }}</td>
        </tr>
        <tr>
            <td>Link Group Diskusi :</td>
            <td><a href="{{ $details['group'] }}">Masuk group diskusi</a></td>
        </tr>
        <tr>
            <td>Syarat dan Ketentuan Daftar Ulang</td>
            <td>
                <ol>
                    <li>Meng-upload file Ijazah (format yang diperbolehkan : pdf)</li>
                    <li>Meng-upload file Transkip/SKHUN (format yang diperbolehkan : pdf)</li>
                    <li>Meng-ipload file Foto backgroud Merah (format yang diperbolehkan : jpeg, jpg, png)</li>
                    <li>Meng-Upload file Surat Peryataan (format yang diperbolehkan : pdf)</li>
                </ol>
            </td>
        </tr>
        <tr>
            <td>Link Daftar Ulang :</td>
            <td><a href="{{ $details['daftar_ulang'] }}">Daftar Ulang</a></td>
        </tr>
    </table>

    <p style="color: red">Siswa yang sudah dinyatakan lulus tidak diperkenankan mendaftar kerja selama proses pelatihan berjalan</p>
    <p style="color: red">Untuk Informasi terbaru dapat check secara berkala di ig:@uptdblkkarawang atau dapat menguhubingi pada Wa:  (Pesan akan dijawab pada jam kerja)<</p>
    <p>Terimakasih</p>
</body>
</html>
