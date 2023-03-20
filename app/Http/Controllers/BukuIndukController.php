<?php

namespace App\Http\Controllers;

use App\Models\BukuInduk;
use App\Models\Dana;
use App\Models\Dokumen;
use App\Models\PaketPelatihan;
use App\Models\Subkejuruan;
use App\Models\Kejuruan;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBukuIndukRequest;
use App\Http\Requests\UpdateBukuIndukRequest;

class BukuIndukController extends Controller
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
        $bukuinduk= BukuInduk::where('kepesertaan','=',1)->orderBy('paketpelatihan_id')->orderBy('nama_pendaftar')->get();
        $dana = Dana::all();
        return view('admin.bukuinduk.bukuinduk', compact('bukuinduk','dana'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kejuruan = Kejuruan::all();
        $subkejuruan = Subkejuruan::all();

        $paketpelatihan = PaketPelatihan::where('tahun','=',date("Y"))->get();
        return view('admin.bukuinduk.create', compact('kejuruan','subkejuruan', 'paketpelatihan'));
    }

    public function dokumen($id)
    {
        $dokumen = Dokumen::where('siswa_id','=',$id)->first();
        $bukuinduk = BukuInduk::find($id);
        return view('admin.bukuinduk.dokumen', compact('dokumen','bukuinduk'));
    }

    public function dokumen_edit(Request $request)
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

    	return redirect('/bukuinduk/'.$request->siswa_id);
    }

    public function action(Request $request)
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
                    'nama_pendaftar'=> $bukuinduk->nama_pendaftar,
                    'nik' => $bukuinduk->nik,
                    'ktp' => $bukuInduk->ktp,
                    'status->ktp' => $bukuInduk->status_ktp,
                    'tempat_lahir' => $bukuinduk->tempat_lahir,
                    'tgl_lahir' => $bukuinduk->tgl_lahir,
                    'jenis_kelamin' => $bukuinduk->jenis_kelamin,
                    'status_pernikahan' => $bukuinduk->status_pernikahan,
                    'telp' => $bukuinduk->telp,
                    'telpwali' => $bukuinduk->telpwali,
                    'email' => $bukuinduk->email,
                    'bb' => $bukuinduk->bb,
                    'tb' => $bukuinduk->tb,
                    'orangtua' => $bukuinduk->orangtua,
                    'alamat_detail' => $bukuinduk->alamat_detail,
                    'pendidikan_terakhir' =>$bukuinduk->pendidikan_terakhir,
                    'nama_sekolah' => $bukuinduk->nama_sekolah,
                    'jurusan_prodi' => $bukuinduk->jurusan_prodi,
                    'tahun_lulus' => $bukuinduk->tahun_lulus,
                    'nilai_rata' => $bukuinduk->nilai_rata,
                    'paketpelatihan_id' => $bukuinduk->paketpelatihan_id,
                ]);
                $path = 'dokumen/';
                $dokumen = Dokumen::where('siswa_id','=',$bukuinduk->id)->first();
                File::delete($path.$dokumen->foto);
                File::delete($path.$dokumen->ijazah);
                File::delete($path.$dokumen->ktp);
                File::delete($path.$dokumen->transkip);
                File::delete($path.$dokumen->surat_pernyataan);
                $dokumen->delete();
                $bukuinduk->delete();
            }
        }
        return redirect('/bukuinduk');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBukuIndukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBukuIndukRequest $request)
    {
        $this->validate($request,[
            'nik'=> 'require',
            'nama_pendaftar' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'ktp' => 'requied',
            'status_ktp' => 'required',
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

        $path = 'dokumen/';
        $filektp = $request->file('ktp');
        $filenamektp = time().'-ktp-'.$data->ktp.'.'.$request->file('ktp')->getClientOriginalExtension();
        $filektp->move(public_path('dokumen'), $filenamektp);

        BukuInduk::create([
            'nama_pendaftar'=> $request->nama_pendaftar,
            'nik' => $request->nik,
            'ktp' => $filenamektp,
            'status_ktp' => $request->status_ktp,
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
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'nama_sekolah' => $request->nama_sekolah,
            'jurusan_prodi' => $request->jurusan_prodi,
            'tahun_lulus' => $request->tahun_lulus,
            'nilai_rata' =>$request->nilai_rata,
            'paketpelatihan_id' => $request->paketpelatihan_id,
            'kepesetaan' => 1
    	]);

        return redirect('/bukuinduk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BukuInduk  $bukuInduk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bukuinduk = BukuInduk::find($id);
        $dokumen = Dokumen::where('siswa_id','=',$id)->first();
        return view('admin.bukuinduk.show', compact('bukuinduk','dokumen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BukuInduk  $bukuInduk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bukuinduk = BukuInduk::find($id);
        $paketpelatihan = PaketPelatihan::where('tahun','=',date("Y"))->get();
        $kejuruan = Kejuruan::all();
        $subkejuruan = Subkejuruan::all();
        return view('admin.bukuinduk.edit', compact('bukuinduk','kejuruan','subkejuruan','paketpelatihan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBukuIndukRequest  $request
     * @param  \App\Models\BukuInduk  $bukuInduk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBukuIndukRequest $request, $id)
    {
        $this->validate($request,[
            'nik'=> 'required',
            'nama_pendaftar' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
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

        return redirect('/bukuinduk/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BukuInduk  $bukuInduk
     * @return \Illuminate\Http\Response
     */
    public function destroy(BukuInduk $bukuInduk)
    {
        //
    }
}
