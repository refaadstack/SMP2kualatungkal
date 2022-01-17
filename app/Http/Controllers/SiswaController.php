<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Kelas;
use App\Mapel;
use App\Siswa;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'nis'           => 'required|unique:siswas,nis',
            'jeniskelamin'   => 'required',
            'nisn'           => 'required|unique:siswas,nisn',
            'tempatlahir'    => 'required',
            'tanggallahir'   => 'required|date',
            'agama'          => 'required',
            'kelas_id'       => 'required',
            'sekolah'        => 'required',
            'ayah'           => 'required',
            'ibu'            => 'required',
            'pekerjaanayah'  => 'required',
            'pekerjaanibu'   => 'required',
            'alamat'         => 'required',
            'hp'             => 'required',
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


        $guru = Auth::user()->guru;
        /**
         *
         * Disini saya cek kondisi dia guru apa bukan kalu guru saya
         * ambil matapelajaran melalui relationship jadi saya ambil data guru yang login sekarang
         * terus ambil relasi mapelnya
         * kalau dia bukan guru yaudah saya get semua mapel lewat table mapel
         */

         if(auth()->user()->role == 'admin'){
            $matapelajaran = Mapel::all();
         }
        else if($guru->walikelas == 'n'){
            $matapelajaran = Guru::with(['mapels'])->where('user_id',Auth::user()->id)->first()
                ->mapels;
        }else if($guru->walikelas == 'y'){
            $matapelajaran = Mapel::all();
        }
        



        $mapelCharts = Mapel::all();
        $kelas = Kelas::all();
        $siswa = Siswa::find($id);
        $mapel = Mapel::find($id);
        $categories = [];
        $data =[];


        foreach($mapelCharts as $mp){


            if($siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()){
                $categories[]= $mp->nama;
                $data[]= $siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()->pivot->nilai;
            }
        }


        return view ('admin.siswa.profil',compact(['siswa','kelas','matapelajaran','categories','data','mapel']));
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
            'nis'            => 'required|unique:siswas,nis,'.$id,
            'jeniskelamin'   => 'required',
            'nisn'           => 'required|unique:siswas,nisn,'.$id,
            'tempatlahir'    => 'required',
            'tanggallahir'   => 'required|date',
            'agama'          => 'required',
            'kelas_id'       => 'required',
            'sekolah'        => 'required',
            'ayah'           => 'required',
            'ibu'            => 'required',
            'pekerjaanayah'  => 'required',
            'pekerjaanibu'   => 'required',
            'alamat'         => 'required',
            'hp'             => 'required',
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
    public function addnilai(Request $request, $idsiswa){

        $request->validate([
            'mapel' => 'required',
            'nilai' => 'required|max:3',
        ]);

        $siswa=\App\Siswa::find($idsiswa);

        if($siswa->mapel()->where('mapel_id',$request->mapel)->exists()){
            return redirect('siswa/'.$idsiswa.'/profile')->withError('Data sudah ada!!');
        }

        $siswa->mapel()->attach($request->mapel,['nilai' => $request->nilai,'guru_id' => Auth::user()->guru->id]);
        // ['nilai'=>$request->nilai]);
        return redirect('siswa/'.$idsiswa.'/profile')->withInfo('Data sudah ditambah');
    }
    public function updatenilai(Request $request,$idsiswa){
        $siswa=\App\Siswa::find($idsiswa);
        $siswa->mapel()->updateExistingPivot($request->mapel,['nilai' => $request->nilai]);
        // dd($request->all());
        return redirect('siswa/'.$idsiswa.'/profile')->withInfo('Data sudah diupdate!');
    }

    public function konfirm(Request $request, $idsiswa){
        $siswa=\App\Siswa::find($idsiswa);
        $siswa->mapel()->updateExistingPivot($request->mapel,['status' => $request->status]);
        // dd($request->all());
        return redirect('siswa/'.$idsiswa.'/profile')->withInfo('Data sudah dikonfirmasi');
    }
    public function deletenilai($idsiswa, $idmapel){
        $siswa = Siswa::find($idsiswa);
        $siswa->mapel()->detach($idmapel);
        return redirect()->back()->with('sukses','Data sudah dihapus');

    }

    public function cetak_rapor_pdf($id)
    {

        $siswa = Siswa::find($id);
        $today = \Carbon\Carbon::now()->format('j F Y');
        // dd($siswa);

    	$pdf = PDF::loadView('admin.siswa.rapor_pdf',['siswa'=>$siswa,'today'=>$today]);
    	return $pdf->stream('rapor.pdf');


    }
    public function profilsaya()
    {
        $kelas = Kelas::all();
        $matapelajaran = Mapel::all();
        $siswa = auth()->user()->siswa;
        $categories = [];
        $data =[];

        foreach($matapelajaran as $mp){
            if($siswa->mapel()->wherePivot('mapel_id',$mp->id)->wherePivot('status','sudah dikonfirmasi')->first()){
                $categories[]= $mp->nama;
                $data[]= $siswa->mapel()->wherePivot('mapel_id',$mp->id)->first()->pivot->nilai;
            }
        }

        return view ('siswa.profilsaya',compact(['siswa','kelas','matapelajaran','categories','data',]));
    }
}
