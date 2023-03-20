<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use App\Http\Requests\StoreDokumentasiRequest;
use App\Http\Requests\UpdateDokumentasiRequest;

class DokumentasiController extends Controller
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
        //
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
     * @param  \App\Http\Requests\StoreDokumentasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDokumentasiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function show(Dokumentasi $dokumentasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokumentasi $dokumentasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDokumentasiRequest  $request
     * @param  \App\Models\Dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDokumentasiRequest $request, Dokumentasi $dokumentasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokumentasi $dokumentasi)
    {
        //
    }
}
