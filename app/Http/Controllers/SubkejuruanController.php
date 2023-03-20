<?php

namespace App\Http\Controllers;

use App\Models\Subkejuruan;
use App\Models\Kejuruan;
use App\Http\Requests\StoreSubkejuruanRequest;
use App\Http\Requests\UpdateSubkejuruanRequest;
use Illuminate\Http\UploadedFile;
use File;

class SubkejuruanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kejuruan = Kejuruan::all();
        $subkejuruan = Subkejuruan::orderBy('kejuruan_id')->get();
        return view('admin.subkejuruan.subkejuruan', compact('kejuruan','subkejuruan'));
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
     * @param  \App\Http\Requests\StoreSubkejuruanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubkejuruanRequest $request)
    {
        $this->validate($request,[
    		'kejuruan_id' => 'required',
            'kode_subkejuruan' => 'required|unique:Subkejuruan',
            'subkejuruan' => 'required|unique:Subkejuruan',
            'deskripsi' => 'required',
            'thumnail' => 'required'
    	]);

        $file = $request->file('thumnail');
        $filename = time().'-'.$request->subkejuruan.'.'.$request->file('thumnail')->getClientOriginalExtension();
        $file->move(public_path('thumnail'), $filename);

        Subkejuruan::create([
    		'kejuruan_id' => $request->kejuruan_id,
            'kode_subkejuruan' => $request->kode_subkejuruan,
            'subkejuruan' => $request->subkejuruan,
            'deskripsi' => $request->deskripsi,
            'thumnail' => $filename,
    	]);

        return redirect('/subkejuruan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subkejuruan  $subkejuruan
     * @return \Illuminate\Http\Response
     */
    public function show(Subkejuruan $subkejuruan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subkejuruan  $subkejuruan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subkejuruan_edit = Subkejuruan::find($id);
        $subkejuruan = Subkejuruan::orderBy('kejuruan_id')->get();
        $kejuruan = Kejuruan::all();
        return view('admin.subkejuruan.edit', compact('subkejuruan_edit','subkejuruan','kejuruan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubkejuruanRequest  $request
     * @param  \App\Models\Subkejuruan  $subkejuruan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubkejuruanRequest $request, $id)
    {
        $this->validate($request,[
    		'kejuruan_id' => 'required',
            'kode_subkejuruan' => 'required',
            'subkejuruan' => 'required',
            'deskripsi' => 'required'
    	]);

        $subkejuruan = Subkejuruan::find($id);

        if ($request->has('thumnail')) {
            $path = 'thumnail/';
            File::delete($path.$subkejuruan->thumnail);

            $file = $request->file('thumnail');
            $filename = time().'-'.$request->subkejuruan.'.'.$request->file('thumnail')->getClientOriginalExtension();
            $file->move(public_path('thumnail'), $filename);

            $subkejuruan->thumnail = $filename;
        } else {
            $subkejuruan->thumnail = $subkejuruan->thumnail;
        }

        $subkejuruan->kode_subkejuruan = $request->kode_subkejuruan;
        $subkejuruan->subkejuruan = $request->subkejuruan;
        $subkejuruan->kejuruan_id = $request->kejuruan_id;
        $subkejuruan->deskripsi = $request->deskripsi;
        $subkejuruan->update();

    	return redirect('/subkejuruan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subkejuruan  $subkejuruan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subkejuruan = Subkejuruan::find($id);
        $path = 'thumnail/';
        File::delete($path.$subkejuruan->thumnail);
        $subkejuruan->delete();
        return redirect('/subkejuruan');
    }
}
