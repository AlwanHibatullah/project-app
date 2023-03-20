<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
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
        $pegawai = Pegawai::all();
        return view('admin.pegawai.pegawai', compact('pegawai'));
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
     * @param  \App\Http\Requests\StorePegawaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'email'=> 'required|unique:users',
            'name' => 'required',
            'password' => 'required',
    	]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,

        ]);

        $pegawai = Pegawai::Create([
            'nama_pegawai' => $request->name,
            'user_id' => $user->id,

            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'nip' => $request->nip,
        ]);

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        $pegawai = Pegawai::find(Auth::user()->id);
        return view('admin.pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePegawaiRequest  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->nama_pegawai = $request->nama_pegawai;
        $pegawai->nip = $request->nip;
        $pegawai->jenis_kelamin = $request->jenis_kelamin;
        $pegawai->alamat = $request->alamat;
        $pegawai->jabatan = $request->jabatan;
        $pegawai->update();

        $user = Pegawai::find($request->user_id);
        $user->email= $request->email;
        $user->name= $request->name;
        $user->role= $request->role;
        $user->password= $request->password;
    	return redirect('/pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai = Pegawai::find($id);
        $user = Pegawai::find($pegawai->user_id);
        $user->delete();
        $pegawai->delate();
        return redirect('/pegawai');
    }
}
