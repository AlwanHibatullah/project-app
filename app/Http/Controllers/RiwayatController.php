<?php

namespace App\Http\Controllers;

use App\Models\Subkejuruan;
use App\Models\Kejuruan;
use App\Models\PaketPelatihan;
use App\Models\BukuInduk;
use App\Models\Riwayat;
use App\Http\Requests\StoreriwayatRequest;
use App\Http\Requests\UpdateriwayatRequest;

class RiwayatController extends Controller
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
        $riwayat = Riwayat::orderBy('paketpelatihan_id','desc')->orderBy('nama_pendaftar')->get();
        return view('admin.riwayat.riwayat', compact('riwayat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreriwayatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreriwayatRequest $request)
    {
        if ($request->hasil == 1) {
            for ($i=0; $i < count($request->action) ; $i++) {
                $riwayat = Riwayat::find($request->action[$i]);
                BukuInduk::create([
                    'nama_pendaftar'=> $riwayat->nama_pendaftar,
                    'nik' => $riwayat->nik,
                    'tempat_lahir' => $riwayat->tempat_lahir,
                    'tgl_lahir' => $riwayat->tgl_lahir,
                    'jenis_kelamin' => $riwayat->jenis_kelamin,
                    'status_pernikahan' => $riwayat->status_pernikahan,
                    'telp' => $riwayat->telp,
                    'telpwali' => $riwayat->telpwali,
                    'email' => $riwayat->email,
                    'bb' => $riwayat->bb,
                    'tb' => $riwayat->tb,
                    'orangtua' => $riwayat->orangtua,
                    'alamat_detail' => $riwayat->alamat_detail,
                    'desa' => $riwayat->desa,
                    'kecamatan' => $riwayat->kecamatan,
                    'kabupaten' => $riwayat->kabupaten,
                    'provinsi' => $riwayat->provinsi,
                    'pendidikan_terakhir' => $riwayat->pendidikan_terakhir,
                    'nama_sekolah' => $riwayat->nama_sekolah,
                    'jurusan_prodi' => $riwayat->jurusan_prodi,
                    'tahun_lulus' => $riwayat->tahun_lulus,
                    'nilai_rata' =>$riwayat->nilai_rata,
                    'paketpelatihan_id' => $riwayat->paketpelatihan_id,
                    'kepesertaan' => 1,
                    'noinduk'=> null
                ]);
                $riwayat->delete();
            }
        }
        return redirect('/riwayat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paketpelatihan = PaketPelatihan::where('tahun','=',date("Y"))->get();
        $subkejuruan = Subkejuruan::all();
        $kejuruan = Kejuruan::all();
        $riwayat = Riwayat::find($id);
        return view('admin.riwayat.show', compact('riwayat','kejuruan','subkejuruan','paketpelatihan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function edit(riwayat $riwayat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateriwayatRequest  $request
     * @param  \App\Models\riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateriwayatRequest $request, $id)
    {
        $riwayat = Riwayat::find($id);
        $riwayat->paketpelatihan_id = $request->paketpelatihan_id;
        $riwayat->update();
        return redirect('/riwayat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\riwayat  $riwayat
     * @return \Illuminate\Http\Response
     */
    public function destroy(riwayat $riwayat)
    {
        //
    }
}
