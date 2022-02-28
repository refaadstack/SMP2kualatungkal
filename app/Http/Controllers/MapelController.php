<?php

namespace App\Http\Controllers;

use App\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    public function index(){

        $mapel = Mapel::all();

        return view('admin.matapelajaran.index',compact(['mapel']));
    }

    public function store(Request $request){
        $request->validate([
            'kode' => 'required|unique:mapels',
            'nama' => 'required',
            'semester' => 'required'
        ]);

        $mapel = new Mapel();
        $mapel->nama = $request->nama;
        $mapel->kode = $request->kode;
        $mapel->semester = $request->semester;
        $mapel->save();

        return back()->withInfo('Data Berhasil Ditambahkan!');
    }
    public function update(Request $request, $id){
        $request->validate([
            'kode' =>'required|unique:mapels,kode,'.$id,
            'nama' => 'required',
            'semester' => 'required',
            ]);

        $mapel = Mapel::find($id);
        $mapel->update($request->all());
        // dd($request->all());
        return back()->withInfo('Mapel sudah diupdate');
    }
}
