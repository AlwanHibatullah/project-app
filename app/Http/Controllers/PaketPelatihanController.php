<?php

namespace App\Http\Controllers;

use App\Models\PaketPelatihan;
use App\Models\Subkejuruan;
use App\Models\BukuInduk;
use App\Models\Riwayat;
use App\Models\Dokumen;
use App\Models\Kejuruan;
use App\Models\Dana;
use App\Models\Pendaftaran;
use App\Models\Skkni;
use App\Models\JPelatihan;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StorePaketPelatihanRequest;
use App\Http\Requests\UpdatePaketPelatihanRequest;
use Illuminate\Http\Request;
use File;
use PDF;

class PaketPelatihanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except('index','show','pendaftaran','siswa','detail','editsiswa','updatesiswa','dokumensiswa','updatedokumensiswa','downloadabsensiswa');
    }
    public function downloadabsensiswa($id){
        $data = BukuInduk::where('paketpelatihan_id','=',$id)->get();

    	$pdf = PDF::loadview('/admin/paketpelatihan/absen_pdf',['pegawai'=>$data])->setPaper('a4', 'landscape');
    	return $pdf->download('laporan-pegawai-pdf.xlsx');
        // return $pdf->stream('laporan-pegawai-pdf.xlsx');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paketpelatihan1 = PaketPelatihan::orderBy('id','desc')
                                        ->orderBy('subkejuruan_id','asc')
                                        ->where('dana_id','=',1)
                                        ->get();
        $paketpelatihan2 = PaketPelatihan::orderBy('id','desc')
                                        ->orderBy('subkejuruan_id','asc')
                                        ->where('dana_id','=',2)
                                        ->get();
        $no = 1;
        return view('admin.paketpelatihan.paketpelatihan', compact('paketpelatihan1','paketpelatihan2','no'));
    }

    public function pendaftaran(Request $request)
    {
        if ($request->hasil == 1) {
            for ($i=0; $i < count($request->action) ; $i++) {
                $pendaftaran = Pendaftaran::find($request->action[$i]);
                BukuInduk::create([
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
        return redirect('/paketpelatihan/'.$paketPelatihan->id);
    }

    public function siswa(Request $request)
    {
        if ($request->hasil == 1) {
            for ($i=0; $i < count($request->action) ; $i++) {
                $bukuinduk = BukuInduk::find($request->action[$i]);
                $bukuinduk->kepesertaan = 2;
                $bukuinduk->update();
            }
        }elseif($request->hasil == 2){
            for ($i=0; $i < count($request->action) ; $i++) {
                $bukuinduk = BukuInduk::find($request->action[$i]);
                $bukuinduk->kepesertaan = 3;
                $bukuinduk->update();
            }
        }elseif($request->hasil == 3){
            for ($i=0; $i < count($request->action) ; $i++) {
                $bukuinduk = BukuInduk::find($request->action[$i]);
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
                $path = 'dokumen/';
                $dokumen = Dokumen::where('siswa_id','=',$bukuinduk->id)->first();
                File::delete($path.$dokumen->foto);
                File::delete($path.$dokumen->ijazah);
                File::delete($path.$pendaftaran->ktp);
                File::delete($path.$dokumen->transkip);
                File::delete($path.$dokumen->surat_pernyataan);
                $dokumen->delete();
                $bukuinduk->delete();
            }
        }
        return redirect('/paketpelatihan/'.$request->paketpelatihan_id);
    }

    public function detail($id){
        $bukuinduk = BukuInduk::find($id);
        $dokumen = Dokumen::where('siswa_id','=',$id)->first();
        return view('admin.paketpelatihan.showsiswa', compact('bukuinduk','dokumen'));
    }

    Public function editsiswa($id)
    {
        $bukuinduk = BukuInduk::find($id);
        $paketpelatihan = PaketPelatihan::where('tahun','=',date("Y"))->get();
        $kejuruan = Kejuruan::all();
        $subkejuruan = Subkejuruan::all();
        return view('admin.paketpelatihan.editsiswa', compact('bukuinduk','kejuruan','subkejuruan','paketpelatihan'));
    }

    public function updatesiswa(Request $request, $id)
    {
        $this->validate($request,[
            'nik'=> 'required',
            'nama_pendaftar' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'status_pernikahan' => 'required',
            'status_ktp'=>'require',
            'telp' => 'required',
            'telpwali' => 'required',
            'email' => 'required',
            'bb' => 'required',
            'tb' => 'required',
            'orangtua' => 'required',
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

        $org_tgl_lahir = $request->tgl_lahir;
        $date_tgl_lahir = date("Y/m/d", strtotime($org_tgl_lahir));
        $newDate_tgl_lahir = str_replace('/', '-', $date_tgl_lahir);

        $bukuinduk = BukuInduk::find($id);
        $path = 'dokumen/';

        if ($request->has('ktp')) {
            File::delete($path.$bukuinduk->ktp);

            $file = $request->file('ktp');
            $filename = time().'-ktp-'.$bukuinduk->ktp.'.'.$request->file('ktp')->getClientOriginalExtension();
            $file->move(public_path('dokumen'), $filename);

            $bukuinduk->ktp = $filename;
        } else {
            $bukuinduk->ktp = $bukuinduk->ktp;
        }



        $bukuinduk->nama_pendaftar = $request->nama_pendaftar;
        $bukuinduk->nik = $request->nik;
        $bukuinduk->tempat_lahir = $request->tempat_lahir;
        $bukuinduk->tgl_lahir = $newDate_tgl_lahir;
        $bukuinduk->jenis_kelamin = $request->jenis_kelamin;
        $bukuinduk->status_pernikahan = $request->status_pernikahan;
        $bukuinduk->telp = $request->telp;
        $bukuinduk->telpwali = $request->telpwali;
        $bukuinduk->email = $request->email;
        $bukuinduk->bb = $request->bb;
        $bukuinduk->tb = $request->tb;
        $bukuinduk->orangtua = $request->orangtua;
        $bukuinduk->alamat_detail = $request->alamat_detail;
        $bukuinduk->desa = $request->desa;
        $bukuinduk->kecamatan = $request->kecamatan;
        $bukuinduk->kabupaten = $request->kabupaten;
        $bukuinduk->provinsi = $request->provinsi;
        $bukuinduk->pendidikan_terakhir = $request->pendidikan_terakhir;
        $bukuinduk->nama_sekolah = $request->nama_sekolah;
        $bukuinduk->jurusan_prodi = $request->jurusan_prodi;
        $bukuinduk->tahun_lulus = $request->tahun_lulus;
        $bukuinduk->nilai_rata =$request->nilai_rata;
        $bukuinduk->paketpelatihan_id = $request->paketpelatihan_id;
        $bukuinduk->update();

        return redirect('/pelatihan-siswa-detail/'.$id);
    }

    public function dokumensiswa($id)
    {
        $dokumen = Dokumen::where('siswa_id','=',$id)->first();
        $bukuinduk = BukuInduk::find($id);
        return view('admin.paketpelatihan.dokumen', compact('dokumen','bukuinduk'));
    }

    public function updatedokumensiswa(Request $request)
    {
        $dokumen = Dokumen::where('siswa_id','=',$request->siswa_id)->first();
        $dokumen->siswa_id = $request->siswa_id;
        $path = 'dokumen/';


        if ($request->has('ijazah')) {
            File::delete($path.$dokumen->ijazah);

            $fileijazah = $request->file('ijazah');
            $filenameijazah = time().'-ijazah-'.$dokumen->bukuinduk->ktp.'.'.$request->file('ijazah')->getClientOriginalExtension();
            $fileijazah->move(public_path('dokumen'), $filename);

            $dokumen->ijazah = $filenameijazah;
        } else {
            $dokumen->ijazah = $dokumen->ijazah;
        }

        if ($request->has('foto')) {
            File::delete($path.$dokumen->foto);

            $filefoto = $request->file('foto');
            $filenamefoto = time().'-foto-'.$dokumen->bukuinduk->ktp.'.'.$request->file('foto')->getClientOriginalExtension();
            $filefoto->move(public_path('dokumen'), $filenamefoto);

            $dokumen->foto = $filenamefoto;
        } else {
            $dokumen->foto = $dokumen->foto;
        }

        if ($request->has('transkip')) {
            File::delete($path.$dokumen->transkip);

            $filetranskip = $request->file('transkip');
            $filenametranskip = time().'-transkip-'.$dokumen->bukuinduk->ktp.'.'.$request->file('transkip')->getClientOriginalExtension();
            $filetranskip->move(public_path('dokumen'), $filenametranskip);

            $dokumen->transkip = $filenametranskip;
        } else {
            $dokumen->transkip = $dokumen->transkip;
        }

        if ($request->has('surat_pernyataan')) {
            File::delete($path.$dokumen->surat_pernyataan);

            $filesurat_pernyataan = $request->file('surat_pernyataan');
            $filenamesurat_pernyataan = time().'-surat_pernyataan-'.$dokumen->bukuinduk->ktp.'.'.$request->file('surat_pernyataan')->getClientOriginalExtension();
            $filesurat_pernyataan->move(public_path('dokumen'), $filenamesurat_pernyataan);

            $dokumen->surat_pernyataan = $filenamesurat_pernyataan;
        } else {
            $dokumen->surat_pernyataan = $dokumen->surat_pernyataan;
        }

        $dokumen->update();

    	return redirect('/pelatihan-siswa-detail/'.$request->siswa_id);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jpelatihan = JPelatihan::all();
        $kejuruan = Kejuruan::all();
        $subkejuruan = Subkejuruan::orderBy('kejuruan_id')->get();
        $dana = Dana::all();
        return view('admin.paketpelatihan.create', compact('jpelatihan','subkejuruan','dana','kejuruan') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaketPelatihanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaketPelatihanRequest $request)
    {
        $this->validate($request,[
            'namapelatihan'=> 'required',
            'angkatan' => 'required',
            'jp' => 'required',
            'awalpelatihan' => 'required',
            'selesaipelatihan' => 'required',
            'pembukaan' => 'required',
            'penutupan' => 'required',
            'tahun' => 'required',
            'jumlah_siswa' => 'required',
            'status' => 'required',
            'dana_id' => 'required',
            'jpelatihan_id' => 'required',
            'subkejuruan_id' => 'required',
            'test' => 'required'
    	]);

        $org_test = $request->test;
        $date_test = date("Y/m/d", strtotime($org_test));
        $newDate_test = str_replace('/', '-', $date_test);
        $org_awalpelatihan = $request->awalpelatihan;
        $date_awalpelatihan = date("Y/m/d", strtotime($org_awalpelatihan));
        $newDate_awalpelatihan = str_replace('/', '-', $date_awalpelatihan);
        $org_selesaipelatihan = $request->selesaipelatihan;
        $date_selesaipelatihan = date("Y/m/d", strtotime($org_selesaipelatihan));
        $newDate_selesaipelatihan = str_replace('/', '-', $date_selesaipelatihan);
        $org_pembukaan = $request->pembukaan;
        $date_pembukaan = date("Y/m/d", strtotime($org_pembukaan));
        $newDate_pembukaan = str_replace('/', '-', $date_pembukaan);
        $org_penutupan = $request->penutupan;
        $date_penutupan = date("Y/m/d", strtotime($org_penutupan));
        $newDate_penutupan = str_replace('/', '-', $date_penutupan);

        PaketPelatihan::create([
            'namapelatihan'=> $request->namapelatihan,
            'angkatan' => $request->angkatan,
            'jp' => $request->jp,
            'awalpelatihan' => $newDate_awalpelatihan,
            'selesaipelatihan' => $newDate_selesaipelatihan,
            'tahun' => $request->tahun,
            'jumlah_siswa' => $request->jumlah_siswa,
            'status' => $request->status,
            'dana_id' => $request->dana_id,
            'jpelatihan_id' => $request->jpelatihan_id,
            'subkejuruan_id' =>$request->subkejuruan_id,
            'test' =>  $newDate_test,
            'pembukaan' =>  $newDate_pembukaan,
            'penutupan' =>  $newDate_penutupan,
            'group' => $request->group
    	]);

        return redirect('/paketpelatihan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaketPelatihan  $paketPelatihan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paketpelatihan = PaketPelatihan::find($id);
        $pendaftaran = Pendaftaran::where('paketpelatihan_id','=',$id)->orderBy('nama_pendaftar','asc')->get();
        $skkni = Skkni::where('subkejuruan_id','=',$paketpelatihan->subkejuruan_id)
                        ->where('dana_id','=',$paketpelatihan->dana_id)
                        ->orderBy('kode_unit')
                        ->get();
        $bukuinduk = BukuInduk::where('paketpelatihan_id','=',$id)->where('kepesertaan','=',1)->orderBy('nama_pendaftar','asc')->get();
        $alumni = BukuInduk::where('paketpelatihan_id','=',$id)->where('kepesertaan','=',2)->orderBy('nama_pendaftar','asc')->get();
        return view('admin.paketpelatihan.show', compact('paketpelatihan','skkni', 'pendaftaran', 'bukuinduk', 'alumni') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaketPelatihan  $paketPelatihan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jpelatihan = JPelatihan::all();
        $kejuruan = Kejuruan::all();
        $subkejuruan = Subkejuruan::orderBy('kejuruan_id')->get();
        $dana = Dana::all();
        $paketpelatihan = Paketpelatihan::find($id);
        return view('admin.paketpelatihan.edit', compact('jpelatihan','subkejuruan','dana','paketpelatihan','kejuruan') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaketPelatihanRequest  $request
     * @param  \App\Models\PaketPelatihan  $paketPelatihan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaketPelatihanRequest $request, $id)
    {
        $this->validate($request,[
            'namapelatihan'=> 'required',
            'angkatan' => 'required',
            'jp' => 'required',
            'awalpelatihan' => 'required',
            'selesaipelatihan' => 'required',
            'tahun' => 'required',
            'jumlah_siswa' => 'required',
            'status' => 'required',
            'dana_id' => 'required',
            'jpelatihan_id' => 'required',
            'subkejuruan_id' => 'required',
            'test' => 'required',
            'pembukaan' => 'required',
            'penutupan' => 'required',
    	]);

        $paketPelatihan= PaketPelatihan::find($id);

        $org_awalpelatihan = $request->awalpelatihan;
        $date_awalpelatihan = date("Y/m/d", strtotime($org_awalpelatihan));
        $newDate_awalpelatihan = str_replace('/', '-', $date_awalpelatihan);

        $org_test = $request->test;
        $date_test = date("Y/m/d", strtotime($org_test));
        $newDate_test = str_replace('/', '-', $date_test);

        $org_selesaipelatihan = $request->selesaipelatihan;
        $date_selesaipelatihan = date("Y/m/d", strtotime($org_selesaipelatihan));
        $newDate_selesaipelatihan = str_replace('/', '-', $date_selesaipelatihan);

        $org_pembukaan = $request->pembukaan;
        $date_pembukaan = date("Y/m/d", strtotime($org_pembukaan));
        $newDate_pembukaan = str_replace('/', '-', $date_pembukaan);

        $org_penutupan = $request->penutupan;
        $date_penutupan = date("Y/m/d", strtotime($org_penutupan));
        $newDate_penutupan = str_replace('/', '-', $date_penutupan);

        $paketPelatihan->namapelatihan = $request->namapelatihan;
        $paketPelatihan->angkatan = $request->angkatan;
        $paketPelatihan->jp = $request->jp;
        $paketPelatihan->test = $newDate_test;
        $paketPelatihan->pembukaan = $newDate_pembukaan;
        $paketPelatihan->penutupan = $newDate_penutupan;
        $paketPelatihan->awalpelatihan = $newDate_awalpelatihan;
        $paketPelatihan->selesaipelatihan = $newDate_selesaipelatihan;
        $paketPelatihan->tahun = $request->tahun;
        $paketPelatihan->jumlah_siswa = $request->jumlah_siswa;
        $paketPelatihan->dana_id = $request->dana_id;
        $paketPelatihan->status = $request->status;
        $paketPelatihan->group = $request->group;
        $paketPelatihan->jpelatihan_id = $request->jpelatihan_id;
        $paketPelatihan->subkejuruan_id = $request->subkejuruan_id;
        $paketPelatihan->update();

        return redirect('/paketpelatihan/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaketPelatihan  $paketPelatihan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paketpelatihan = PaketPelatihan::find($id);
        $paketpelatihan->delete();
        return redirect('/paketpelatihan');
    }
}
