<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi pendaftaran pelatihan UPTD BLK Karawang</title>
</head>
<body>
    <h3>{{ 'Selamat pendaftaran berhasil' }}</h3>
    <p>{{ $details['nama'].', '.$details['title'].' pada kejuruan '.$details['kejuruan'].' '.$details['pelatihan'].' '.$details['dana'].' '.$details['angkatan'] }}</p>
    <p>Diharapkan untuk menghadiri test pada :</p>
    <table>
        <tr>
            <td>Tanggal :</td>
            <td>{{ $details['hari'].', '.$details['wawancara'] }}</td>
        </tr>
        <tr>
            <td>Bertempat :</td>
            <td>UPTD Balai Latihan Kerja Karawang, Jl.Surotokunto Km.07 Warungbambu, Kec.Karawang Timur Karawang</td>
        </tr>
        <tr>
            <td>Syarat dan Ketentuan</td>
            <td>
                <ol>
                    <li>Membawa HP Android/Ios dan Memiliki kuota Internet. </li>
                    <li>Memamai kemeja putih, rok/celana hitam, bersepatu rapi.</li>
                    <li>Membawa alat tulis pribadi dan alas untuk menulis</li>
                    <li>Menggunakan Masker dan tetap menjalankan protokol kesehatan</li>
                </ol>
            </td>
        </tr>
    </table>

    <p style="color: red">Peserta calon siswa yang sudan melakukan pendaftaran tidak dapat melakukan pendaftaran kembali selama proses seleksi</p>
    <p style="color: red">Untuk Informasi terbaru dapat diupdate secara berkala di ig:@uptdblkkarawang atau dpat menghubungi Wa:  (Pesan akan dijawab pada jam kerja)</p>
    <p>Terimakasih</p>
</body>
</html>
