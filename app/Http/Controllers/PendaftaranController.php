<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Subkejuruan;
use App\Models\Kejuruan;
use App\Models\PaketPelatihan;
use App\Models\BukuInduk;
use App\Models\Riwayat;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use App\Http\Requests\StorePendaftaranRequest;
use App\Http\Requests\UpdatePendaftaranRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Mail\SendEmail;
use App\Mail\KonfirmasiLulus;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\UploadedFile;
use File;

class PendaftaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendaftaran = Pendaftaran::orderBy('id','desc')->get();
        $paketpelatihan = PaketPelatihan::all();
        $subkejuruan = Subkejuruan::all();
        $kejuruan = Kejuruan::all();
        return view('admin.pendaftaran.pendaftran', compact('pendaftaran','kejuruan','paketpelatihan','subkejuruan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kejuruan = Kejuruan::all();
        $subkejuruan = Subkejuruan::whereHas('paketpelatihan', function (Builder $query) {
            $query->where('status', '=', 2);
        })->get();

        $paketpelatihan = PaketPelatihan::where('status','=', 2 )->get();
        return view('admin.pendaftaran.create', compact('kejuruan','subkejuruan', 'paketpelatihan'));
    }

    public function dokumen($id)
    {
        $bukuinduk = BukuInduk::find($id);
        return view('admin.pendaftaran.dokumen', compact('bukuinduk'));
    }

    public function uploadDokumen(Request $request)
    {
        $this->validate($request,[
            	'siswa_id' => 'required',
                'ijazah' => 'required|mimes:pdf',
                'transkip' => 'required|mimes:pdf',
                'foto' => 'required|image|mimes:jpeg,jpg,png',
                'surat_pernyataan' => 'required|mimes:pdf',
            ]);
        $data = BukuInduk::find($request->siswa_id);

        $fileijazah = $request->file('ijazah');
        $filenameijazah = time().'-ijazah-'.$data->ktp.'.'.$request->file('ijazah')->getClientOriginalExtension();
        $fileijazah->move(public_path('dokumen'), $filenameijazah);

        $filetranskip = $request->file('transkip');
        $filenametranskip = time().'-transkip-'.$data->ktp.'.'.$request->file('transkip')->getClientOriginalExtension();
        $filetranskip->move(public_path('dokumen'), $filenametranskip);

        $filefoto = $request->file('foto');
        $filenamefoto = time().'-foto-'.$data->ktp.'.'.$request->file('foto')->getClientOriginalExtension();
        $filefoto->move(public_path('dokumen'), $filenamefoto);

        $filesurat_pernyataan = $request->file('surat_pernyataan');
        $filenamesurat_pernyataan = time().'-surat_pernyataan-'.$data->ktp.'.'.$request->file('surat_pernyataan')->getClientOriginalExtension();
        $filesurat_pernyataan->move(public_path('dokumen'), $filenamesurat_pernyataan);

        Dokumen::create([
    		'siswa_id' => $request->siswa_id,
            'ijazah' => $filenameijazah,
            'transkip' => $filenametranskip,
            'foto' => $filenamefoto,
            'surat_pernyataan' => $filenamesurat_pernyataan
    	]);

        return redirect('/bukuinduk/'.$request->siswa_id);

    }

    public function action(Request $request)
    {
        if ($request->hasil == 1) {
            for ($i=0; $i < count($request->action) ; $i++) {
                $pendaftaran = Pendaftaran::find($request->action[$i]);
                BukuInduk::create([
                    'nama_pendaftar'=> $pendaftaran->nama_pendaftar,
                    'nik' => $pendaftaran->nik,
                    'ktp' => $pendaftaran->ktp,
                    'status_ktp' =>$pendaftaran->status_ktp,
                    'tempat_lahir' => $pendaftaran->tempat_lahir,
                    'tgl_lahir' => $pendaftaran->tgl_lahir,
                    'jenis_kelamin' => $pendaftaran->jenis_kelamin,
                    'status_pernikahan' => $pendaftaran->status_pernikahan,
                    'telp' => $pendaftaran->telp,
                    'telpwali' => $pendaftaran->telpwali,
                    'email' => $pendaftaran->email,
                    'bb' => $pendaftaran->bb,
                    'tb' => $pendaftaran->tb,
                    'orangtua' => $pendaftaran->orangtua,
                    'alamat_detail' => $pendaftaran->alamat_detail,
                    'pendidikan_terakhir' => $pendaftaran->pendidikan_terakhir,
                    'nama_sekolah' => $pendaftaran->nama_sekolah,
                    'jurusan_prodi' => $pendaftaran->jurusan_prodi,
                    'tahun_lulus' => $pendaftaran->tahun_lulus,
                    'nilai_rata' =>$pendaftaran->nilai_rata,
                    'paketpelatihan_id' => $pendaftaran->paketpelatihan_id,
                    'kepesertaan' => 1,
                    'noinduk'=> null
                ]);

                $paketpelatihan = PaketPelatihan::find($pendaftaran->paketpelatihan_id);

                $date_awalpelatihan = date("d/m/Y", strtotime($paketpelatihan->awalpelatihan));
                $newDate_awalpelatihan = str_replace('/', ' ', $date_awalpelatihan);
                $day_awalpelatihan = date('D', strtotime($paketpelatihan->awalpelatihan));

                $date_selesaipelatihan = date("d/m/Y", strtotime($paketpelatihan->selesaipelatihan));
                $newDate_selesaipelatihan = str_replace('/', ' ', $date_selesaipelatihan);
                $day_selesaipelatihan = date('D', strtotime($paketpelatihan->selesaipelatihan));

                $date_pembukaan = date("d/m/Y", strtotime($paketpelatihan->pembukaan));
                $newDate_pembukaan = str_replace('/', ' ', $date_pembukaan);
                $day_pembukaan = date('D', strtotime($paketpelatihan->pembukaan));

                $date_penutupan = date("d/m/Y", strtotime($paketpelatihan->penutupan));
                $newDate_penutupan = str_replace('/', ' ', $date_penutupan);
                $day_penutupan = date('D', strtotime($paketpelatihan->penutupan));

                $dayList = array(
                    'Sun' => 'Minggu',
                    'Mon' => 'Senin',
                    'Tue' => 'Selasa',
                    'Wed' => 'Rabu',
                    'Thu' => 'Kamis',
                    'Fri' => 'Jumat',
                    'Sat' => 'Sabtu'
                );


                $details = [
                    'title' => 'Selamat anda dinyatakan LULUS sebagai siswa pelatihan UPTD Balai Latihan Kerja Kabupaten Karawang',
                    'nama' => $pendaftaran->nama_pendaftar,
                    'pelatihan' => $paketpelatihan->namapelatihan,
                    'dana' => $paketpelatihan->dana->dana,
                    'angkatan' => $paketpelatihan->angkatan,
                    'kejuruan' => $paketpelatihan->subkejuruan->subkejuruan,
                    'pembukaan' => $dayList[$day_pembukaan].', '.$newDate_pembukaan,
                    'penutupan' => $dayList[$day_penutupan].', '.$newDate_penutupan,
                    'awalpelatihan' => $dayList[$day_awalpelatihan].', '.$newDate_awalpelatihan,
                    'selesaipelatihan' => $dayList[$day_selesaipelatihan].', '.$newDate_selesaipelatihan,
                    'group' => $paketPelatihan->group,
                    'daftar_ulang' =>'/dokumen-action/'.$pendaftaran->id
                    ];

                Mail::to($pendaftaran->email)->send(new KonfirmasiLulus($details));

                $pendaftaran->delete();
            }
        }elseif($request->hasil == 2){
            for ($i=0; $i < count($request->action) ; $i++) {
                $pendaftaran = Pendaftaran::find($request->action[$i]);
                Riwayat::create([
                    'nama_pendaftar'=> $pendaftaran->nama_pendaftar,
                    'nik' => $pendaftaran->nik,
                    'tempat_lahir' => $pendaftaran->tempat_lahir,
                    'tgl_lahir' => $pendaftaran->tgl_lahir,
                    'jenis_kelamin' => $pendaftaran->jenis_kelamin,
                    'status_pernikahan' => $pendaftaran->status_pernikahan,
                    'telp' => $pendaftaran->telp,
                    'telpwali' => $pendaftaran->telpwali,
                    'email' => $pendaftaran->email,
                    'bb' => $pendaftaran->bb,
                    'tb' => $pendaftaran->tb,
                    'ktp' => $pendaftaran->ktp,
                    'status_ktp' => $pendaftaran->status_ktp,
                    'orangtua' => $pendaftaran->orangtua,
                    'alamat_detail' => $pendaftaran->alamat_detail,
                    'pendidikan_terakhir' => $pendaftaran->pendidikan_terakhir,
                    'nama_sekolah' => $pendaftaran->nama_sekolah,
                    'jurusan_prodi' => $pendaftaran->jurusan_prodi,
                    'tahun_lulus' => $pendaftaran->tahun_lulus,
                    'nilai_rata' =>$pendaftaran->nilai_rata,
                    'paketpelatihan_id' => $pendaftaran->paketpelatihan_id,
                ]);

                $details = [
                    'title' => 'Maaf anda dinyatakan Belum LULUS sebagai siswa pelatihan UPTD Balai Latihan Kerja Kabupaten Karawang',
                    'nama' => $pendaftaran->nama_pendaftar,
                    'pelatihan' => $paketpelatihan->namapelatihan,
                    'dana' => $paketpelatihan->dana->dana,
                    'angkatan' => $paketpelatihan->angkatan,
                    'kejuruan' => $paketpelatihan->subkejuruan->subkejuruan,
                ];

                Mail::to($pendaftaran->email)->send(new TidakLulus($details));


                $pendaftaran->delete();
            }
        }
        return redirect('/pendaftaran');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePendaftaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePendaftaranRequest $request)
    {
        $this->validate($request,[
            'nik'=> 'required|unique:pendaftaran',
            'nama_pendaftar' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'status_pernikahan' => 'required',
            'ktp' => 'required|image|mimes:jpeg,jpg,png',
            'status_ktp' =>'required',
            'telp' => 'required',
            'telpwali' => 'required',
            'email' => 'required',
            'bb' => 'required',
            'tb' => 'required',
            'orangtua' => 'required',
            'alamat_detail' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'pendidikan_terakhir' => 'required',
            'nama_sekolah' => 'required',
            'jurusan_prodi' => 'required',
            'tahun_lulus' => 'required',
            'nilai_rata' => 'required',
            'paketpelatihan_id' => 'required',
    	]);

        $path = 'dokumen/';
        $filektp = $request->file('ktp');
        $filenamektp = time().'-ktp-'.$data->ktp.'.'.$request->file('ktp')->getClientOriginalExtension();
        $filektp->move(public_path('dokumen'), $filenamektp);

        $message = [ 'nik.unique'=>'NIK Anda Sudah Terdaftar'];

        $org_tgl_lahir = $request->tgl_lahir;
        $date_tgl_lahir = date("Y/m/d", strtotime($org_tgl_lahir));
        $newDate_tgl_lahir = str_replace('/', '-', $date_tgl_lahir);

        $paketpelatihan = PaketPelatihan::find($request->paketpelatihan_id);

        $date = date("d/m/Y", strtotime($paketpelatihan->awalpelatihan));
        $newDate = str_replace('/', ' ', $date);
        $day = date('D', strtotime($paketpelatihan->awalpelatihan));
        $dayList = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        );

        $details = [
            'title' => 'Selamat anda telah terdaftar sebagai calon siswa pelatihan UPTD Balai Latihan Kerja Kabupaten Karawang',
            'body' => 'This is for testing email using smtp',
            'nama' => $request->nama_pendaftar,
            'pelatihan' => $paketpelatihan->namapelatihan,
            'wawancara' => $newDate,
            'dana' => $paketpelatihan->dana->dana,
            'angkatan' => $paketpelatihan->angkatan,
            'kejuruan' => $paketpelatihan->subkejuruan->subkejuruan,
            'hari' => $dayList[$day]
            ];

        Mail::to($request->email)->send(new SendEmail($details));

        Pendaftaran::create([
            'nama_pendaftar'=> $request->nama_pendaftar,
            'nik' => $request->nik,
            'status_ktp' => $filenamektp,
            'ktp' => $request->ktp,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $newDate_tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_pernikahan' => $request->status_pernikahan,
            'telp' => $request->telp,
            'telpwali' => $request->telpwali,
            'email' => $request->email,
            'bb' => $request->bb,
            'tb' => $request->tb,
            'orangtua' => $request->orangtua,
            'alamat_detail' => $request->alamat_detail,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'nama_sekolah' => $request->nama_sekolah,
            'jurusan_prodi' => $request->jurusan_prodi,
            'tahun_lulus' => $request->tahun_lulus,
            'nilai_rata' =>$request->nilai_rata,
            'paketpelatihan_id' => $request->paketpelatihan_id
    	]);

        return redirect('/pendaftaran');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pendaftaran = Pendaftaran::find($id);
        return view('admin.pendaftaran.show', compact('pendaftaran'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pendaftaran = Pendaftaran::find($id);
        $paketpelatihan = PaketPelatihan::all();
        $kejuruan = Kejuruan::all();
        $subkejuruan = Subkejuruan::whereHas('paketpelatihan', function (Builder $query) {
            $query->where('status', '=', 2);
        })->get();
        return view('admin.pendaftaran.edit', compact('pendaftaran','kejuruan','subkejuruan','paketpelatihan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePendaftaranRequest  $request
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePendaftaranRequest $request, $id)
    {
        $this->validate($request,[
            'nik'=> 'required',
            'nama_pendaftar' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'status_ktp' =>'required',
            'jenis_kelamin' => 'required',
            'status_pernikahan' => 'required',
            'telp' => 'required',
            'telpwali' => 'required',
            'email' => 'required',
            'bb' => 'required',
            'tb' => 'required',
            'orangtua' => 'required',
            'alamat_detail' => 'required',
            'pendidikan_terakhir' => 'required',
            'nama_sekolah' => 'required',
            'jurusan_prodi' => 'required',
            'tahun_lulus' => 'required',
            'nilai_rata' => 'required',
            'paketpelatihan_id' => 'required',
    	]);

        $org_tgl_lahir = $request->tgl_lahir;
        $date_tgl_lahir = date("Y/m/d", strtotime($org_tgl_lahir));
        $newDate_tgl_lahir = str_replace('/', '-', $date_tgl_lahir);

        $pendaftaran = Pendaftaran::find($id);
        $path = 'dokumen/';

        if ($request->has('ktp')) {
            File::delete($path.$pendaftaran->ktp);

            $file = $request->file('ktp');
            $filename = time().'-ktp-'.$pendaftaran->ktp.'.'.$request->file('ktp')->getClientOriginalExtension();
            $file->move(public_path('dokumen'), $filename);

            $pendaftaran->ktp = $filename;
        } else {
            $pendaftaran->ktp = $pendaftaran->ktp;
        }

        $pendaftaran->nama_pendaftar = $request->nama_pendaftar;
        $pendaftaran->nik = $request->nik;
        $pendaftaran->status_ktp = $request->status_ktp;
        $pendaftaran->ktp = $filename;
        $pendaftaran->tempat_lahir = $request->tempat_lahir;
        $pendaftaran->tgl_lahir = $newDate_tgl_lahir;
        $pendaftaran->jenis_kelamin = $request->jenis_kelamin;
        $pendaftaran->status_pernikahan = $request->status_pernikahan;
        $pendaftaran->telp = $request->telp;
        $pendaftaran->telpwali = $request->telpwali;
        $pendaftaran->email = $request->email;
        $pendaftaran->bb = $request->bb;
        $pendaftaran->tb = $request->tb;
        $pendaftaran->orangtua = $request->orangtua;
        $pendaftaran->alamat_detail = $request->alamat_detail;
        $pendaftaran->desa = $request->desa;
        $pendaftaran->kecamatan = $request->kecamatan;
        $pendaftaran->kabupaten = $request->kabupaten;
        $pendaftaran->provinsi = $request->provinsi;
        $pendaftaran->pendidikan_terakhir = $request->pendidikan_terakhir;
        $pendaftaran->nama_sekolah = $request->nama_sekolah;
        $pendaftaran->jurusan_prodi = $request->jurusan_prodi;
        $pendaftaran->tahun_lulus = $request->tahun_lulus;
        $pendaftaran->nilai_rata =$request->nilai_rata;
        $pendaftaran->paketpelatihan_id = $request->paketpelatihan_id;
        $pendaftaran->update();

        return redirect('/pendaftaran/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendaftaran $pendaftaran)
    {

    }
}
