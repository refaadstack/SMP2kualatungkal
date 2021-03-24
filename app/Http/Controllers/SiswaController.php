<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Siswa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelass = \App\Kelas::all();
        $data = \App\Siswa::all();
        return view('admin.siswa.index', compact(['data','kelass']));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required',
            'nipd'           => 'required|unique:siswas,nipd',
            'jeniskelamin'   => 'required',
            'nisn'           => 'required|unique:siswas,nisn',
            'tempatlahir'    => 'required',
            'tanggallahir'   => 'required|date',
            'agama'          => 'required',
            'email'          => 'required|unique:siswas,email', 
        ]);

        $user = new User;
        $user->role = 'siswa';
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt('12345678');
        $user->remember_token = str::random(60);
        $user->save();

        $request->request->add(['user_id'=> $user->id]);
        Siswa::create($request->all());
        
        return back()->withInfo('Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        $kelas = Kelas::all(); 
        $siswa = Siswa::find($id);
        return view ('admin.siswa.profil',compact(['siswa','kelas']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'           => 'required',
            'nipd'           => 'required|unique:siswas,nipd,'.$id,
            'jeniskelamin'   => 'required',
            'nisn'           => 'required|unique:siswas,nisn,'.$id,
            'tempatlahir'    => 'required',
            'tanggallahir'   => 'required|date',
            'agama'          => 'required',
            'email'          => 'required|unique:siswas,email,'.$id,
            'avatar'         => 'mimes:jpeg,png,jpg',
        ]);

        $siswa = Siswa::find($id);

        $siswa->update($request->all());
        if($request->hasFile('avatar')){

            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }

        return back()->withInfo('Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $siswa->user()->delete();
        $siswa->delete();

        return back()->withInfo('Data sudah dihapus');
    }
}