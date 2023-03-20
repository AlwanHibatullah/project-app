<?php

namespace App\Http\Controllers;

use App\Models\Kejuruan;
use App\Http\Requests\StoreKejuruanRequest;
use App\Http\Requests\UpdateKejuruanRequest;

class KejuruanController extends Controller
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
        $kejuruan = Kejuruan::all();
        return view('admin.kejuruan.kejuruan', compact('kejuruan'));
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
     * @param  \App\Http\Requests\StoreKejuruanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKejuruanRequest $request)
    {
        $this->validate($request,[
    		'kejuruan' => 'required|unique:Kejuruan',
            'kode_kejuruan' => 'required|unique:Kejuruan'
    	]);

        Kejuruan::create([
    		'kejuruan' => $request->kejuruan,
            'kode_kejuruan' => $request->kode_kejuruan
    	]);

    	return redirect('/kejuruan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kejuruan  $kejuruan
     * @return \Illuminate\Http\Response
     */
    public function show(Kejuruan $kejuruan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kejuruan  $kejuruan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kejuruan_edit = Kejuruan::find($id);
        $kejuruan = Kejuruan::all();
        return view('admin.kejuruan.edit', compact('kejuruan','kejuruan_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKejuruanRequest  $request
     * @param  \App\Models\Kejuruan  $kejuruan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKejuruanRequest $request, $id)
    {
        $this->validate($request,[
    		'kejuruan' => 'required'
    	]);


        $kejuruan = Kejuruan::find($id);
        $kejuruan->kejuruan = $request->kejuruan;
        $kejuruan->kode_kejuruan = $request->kode_kejuruan;
        $kejuruan->update();

    	return redirect('/kejuruan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kejuruan  $kejuruan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kejuruan = Kejuruan::find($id);
        $kejuruan->delete();
        return redirect('/kejuruan');
    }
}
