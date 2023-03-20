<?php

namespace App\Http\Controllers;

use App\Models\Pegumuman;
use App\Http\Requests\StorePegumumanRequest;
use App\Http\Requests\UpdatePegumumanRequest;

class PegumumanController extends Controller
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
     * @param  \App\Http\Requests\StorePegumumanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePegumumanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegumuman  $pegumuman
     * @return \Illuminate\Http\Response
     */
    public function show(Pegumuman $pegumuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegumuman  $pegumuman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegumuman $pegumuman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePegumumanRequest  $request
     * @param  \App\Models\Pegumuman  $pegumuman
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePegumumanRequest $request, Pegumuman $pegumuman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegumuman  $pegumuman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegumuman $pegumuman)
    {
        //
    }
}
