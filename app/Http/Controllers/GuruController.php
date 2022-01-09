<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Mapel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Guru::all();
        $mapels = Mapel::all();
        return view('admin.guru.index', compact(['data','mapels']));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'               => 'required',
            'nip'                => 'nullable|unique:gurus,nip,',
            'jeniskelamin'       => 'required',
            'mapel_id'           => 'required',
            'nuptk'              => 'nullable|unique:gurus,nuptk',
            'tempatlahir'        => 'required',
            'tanggallahir'       => 'required|date',
            'statuskepegawaian'  => 'required',
            'jenjang'            => 'required',
            'jurusan'            => 'required',
            'sertifikasi'        => 'required',
            'email'              => 'required|unique:gurus,email', 
        ]);

        $user = new User;
        $user->role = 'guru';
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt('12345678');
        $user->remember_token = str::random(60);
        $user->save();

        $request->request->add(['user_id'=> $user->id]);
        Guru::create($request->all());
        
        return back()->withInfo('Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guru = Guru::find($id);
        return view('admin.guru.profil',compact(['guru']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'nama'               => 'required',
            'nip'                => 'nullable|unique:gurus,nip,'.$id,
            'jeniskelamin'       => 'required',
            'mapel_id'           => 'required',
            'nuptk'              => 'nullable|unique:gurus,nuptk,'.$id,
            'tempatlahir'        => 'required',
            'tanggallahir'       => 'required|date',
            'statuskepegawaian'  => 'required',
            'jenjang'            => 'required',
            'jurusan'            => 'required',
            'sertifikasi'        => 'required',
            'email'              => 'required|unique:gurus,email,'.$id,
            'avatar'             => 'mimes:jpeg,png,jpg',  
        ]);

        $guru = Guru::find($id);

        $guru->update($request->all());
        if($request->hasFile('avatar')){

            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $guru->avatar = $request->file('avatar')->getClientOriginalName();
            $guru->save();
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
        $guru = Guru::find($id);
        $guru->user()->delete();
        $guru->delete();
        return back()->withInfo('Data Guru berhasil dihapus');
    }

    public function profilguru(){

        $guru = auth()->user()->guru;
        return view ('guru.profilguru', compact(['guru']));
    }

    
}
