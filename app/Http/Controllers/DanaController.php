<?php

namespace App\Http\Controllers;

use App\Models\Dana;
use App\Http\Requests\StoreDanaRequest;
use App\Http\Requests\UpdateDanaRequest;

class DanaController extends Controller
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
        $dana = Dana::all();
        return view('admin.dana.dana', compact('dana'));
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
     * @param  \App\Http\Requests\StoreDanaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDanaRequest $request)
    {
        $this->validate($request,[
    		'dana' => 'required|unique:Dana'
    	]);

        Dana::create([
    		'dana' => $request->dana
    	]);

    	return redirect('/dana');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dana  $dana
     * @return \Illuminate\Http\Response
     */
    public function show(Dana $dana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dana  $dana
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dana_edit = Dana::find($id);
        $dana = Dana::all();
        return view('admin.dana.edit', compact('dana','dana_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDanaRequest  $request
     * @param  \App\Models\Dana  $dana
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDanaRequest $request, $id)
    {
        $this->validate($request,[
    		'dana' => 'required'
    	]);


        $dana = Dana::find($id);
        $dana->dana = $request->dana;
        $dana->update();

    	return redirect('/dana');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dana  $dana
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dana = Dana::find($id);
        $dana->delete();
        return redirect('/dana');
    }
}
