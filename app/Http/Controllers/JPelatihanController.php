<?php

namespace App\Http\Controllers;

use App\Models\JPelatihan;
use App\Http\Requests\StoreJPelatihanRequest;
use App\Http\Requests\UpdateJPelatihanRequest;

class JPelatihanController extends Controller
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
        $jpelatihan = JPelatihan::all();
        return view('admin.jpelatihan.jpelatihan', compact('jpelatihan'));
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
     * @param  \App\Http\Requests\StoreJPelatihanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJPelatihanRequest $request)
    {
        $this->validate($request,[
    		'jpelatihan' => 'required|unique:JPelatihan',
            'kode_jpelatihan' => 'required|unique:JPelatihan'
    	]);

        JPelatihan::create([
    		'jpelatihan' => $request->jpelatihan,
            'kode_jpelatihan' => $request->kode_jpelatihan
    	]);

    	return redirect('/jpelatihan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JPelatihan  $jPelatihan
     * @return \Illuminate\Http\Response
     */
    public function show(JPelatihan $jPelatihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JPelatihan  $jPelatihan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jpelatihan_edit = Jpelatihan::find($id);
        $jpelatihan = Jpelatihan::all();
        return view('admin.jpelatihan.edit', compact('jpelatihan','jpelatihan_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJPelatihanRequest  $request
     * @param  \App\Models\JPelatihan  $jPelatihan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJPelatihanRequest $request, $id)
    {
        $this->validate($request,[
    		'jpelatihan' => 'required',
            'kode_jpelatihan' => 'required'
    	]);


        $jpelatihan = Jpelatihan::find($id);
        $jpelatihan->jpelatihan = $request->jpelatihan;
        $jpelatihan->kode_jpelatihan = $request->kode_jpelatihan;
        $jpelatihan->update();

    	return redirect('/jpelatihan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JPelatihan  $jPelatihan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jpelatihan = JPelatihan::find($id);
        $jpelatihan->delete();
        return redirect('/jpelatihan');
    }
}
