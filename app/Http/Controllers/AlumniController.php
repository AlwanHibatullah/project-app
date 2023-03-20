<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\BukuInduk;
use App\Http\Requests\StoreAlumniRequest;
use App\Http\Requests\UpdateAlumniRequest;

class AlumniController extends Controller
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
        $bukuinduk= BukuInduk::where('kepesertaan','!=',1)->orderBy('paketpelatihan_id')->orderBy('nama_pendaftar')->get();
        return view('admin.alumni.alumni', compact('bukuinduk'));
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
     * @param  \App\Http\Requests\StoreAlumniRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlumniRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bukuinduk = Bukuinduk::find($id);
        $alumni = Alumni::where('siswa_id','=',$id)->first();
        return view('admin.alumni.show', compact('bukuinduk','alumni'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumni $alumni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAlumniRequest  $request
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlumniRequest $request, Alumni $alumni)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumni $alumni)
    {
        //
    }
}
