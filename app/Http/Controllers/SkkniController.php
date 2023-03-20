<?php

namespace App\Http\Controllers;

use App\Models\Skkni;
use App\Models\Subkejuruan;
use App\Models\Kejuruan;
use App\Models\Dana;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSkkniRequest;
use App\Http\Requests\UpdateSkkniRequest;

class SkkniController extends Controller
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
        $skkni = Skkni::orderBy('dana_id', 'asc')->orderBy('subkejuruan_id', 'asc')->get();
        $kejuruan = Kejuruan::all();
        $subkejuruan = Subkejuruan::all()->sortBy('kejuruan_id');
        $dana = Dana::all();
        return view('admin.skkni.skkni', compact('skkni','subkejuruan','dana','kejuruan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $skkni = Skkni::where('subkejuruan_id', $request->subkejuruan_id)
        ->where('dana_id', $request->dana_id)
        ->orderBy('unit_kompetensi')
        ->get();
        $subkejuruan = Subkejuruan::where('id', $request->subkejuruan_id)->first(['id','subkejuruan']);
        $dana = Dana::where('id', $request->dana_id)->first(['id','dana']);
        return view('admin.skkni.create', compact('skkni','subkejuruan','dana'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSkkniRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSkkniRequest $request)
    {
        $this->validate($request,[
            'kode_unit' => 'required',
            'unit_kompetensi' => 'required',
            'jp_teori' => 'required',
            'jp_praktik' => 'required',
    	]);

        Skkni::create([
            'subkejuruan_id' => $request->subkejuruan_id,
            'dana_id' => $request->dana_id,
            'kode_unit' => $request->kode_unit,
            'unit_kompetensi' => $request->unit_kompetensi,
            'jp_teori' => $request->jp_teori,
            'jp_praktik' => $request->jp_praktik,
            'kelompok_unit' => $request->kelompok_unit
    	]);

        $skkni = Skkni::where('subkejuruan_id', $request->subkejuruan_id)
        ->where('dana_id', $request->dana_id)
        ->orderBy('unit_kompetensi')
        ->get();
        $subkejuruan = Subkejuruan::where('id', $request->subkejuruan_id)->first(['id','subkejuruan']);
        $dana = Dana::where('id', $request->dana_id)->first(['id','dana']);
        return view('admin.skkni.create', compact('skkni','subkejuruan','dana'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skkni  $skkni
     * @return \Illuminate\Http\Response
     */
    public function show(Skkni $skkni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skkni  $skkni
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $skkni = Skkni::find($id);
        $skkni_view = Skkni::where('subkejuruan_id', $skkni->subkejuruan_id)
                            ->where('dana_id', $skkni->dana_id)
                            ->get();
        return view('admin.skkni.edit', compact('skkni','skkni_view'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSkkniRequest  $request
     * @param  \App\Models\Skkni  $skkni
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSkkniRequest $request, $id)
    {
        $this->validate($request,[
            'kode_unit' => 'required',
            'unit_kompetensi' => 'required',
            'jp_teori' => 'required',
            'jp_praktik' => 'required',
    	]);


        $skkni_edit = Skkni::find($id);
        $skkni_edit->subkejuruan_id = $request->subkejuruan_id;
        $skkni_edit->dana_id = $request->dana_id;
        $skkni_edit->kode_unit = $request->kode_unit;
        $skkni_edit->unit_kompetensi = $request->unit_kompetensi;
        $skkni_edit->jp_teori = $request->jp_teori;
        $skkni_edit->jp_praktik = $request->jp_praktik;
        $skkni_edit->kelompok_unit = $request->kelompok_unit;
        $skkni_edit->update();


        $skkni = Skkni::where('subkejuruan_id', $request->subkejuruan_id)
                        ->where('dana_id', $request->dana_id)
                        ->get();
        $subkejuruan = Subkejuruan::all();
        $dana = Dana::all();
        return view('admin.skkni.skkni', compact('skkni','subkejuruan','dana'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skkni  $skkni
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skkni = Skkni::find($id);
        $skkni->delete();
        return redirect('/skkni');
    }
}
