<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'user_id',
        'nama', 
        'avatar',
        'nis', 
        'jeniskelamin',
        'nisn',
        'tempatlahir',
        'tanggallahir',
        'agama',
        'sekolah',
        'ayah',
        'ibu',
        'pekerjaanayah',
        'pekerjaanibu',
        'alamat',
        'hp',
        'email',
        'kelas_id',
    ];

    public function getAvatar(){
        if(!$this->avatar){
            return asset('assets/img/undraw_profile.svg');
        }
        return asset('images/'.$this->avatar);
    }

    public function user(){
        return $this->belongsTo('\App\User');
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    public function mapel(){
        return $this->belongsToMany(Mapel::class)->withPivot(['nilai'])->withTimestamps();

    }

    public function rata(){
        // $total= 0;
        // $hitung = 0;
        // foreach($this->mapel as $mapel){
        //     $total +=$mapel->pivot->nilai;
        //     $hitung++;
        // }

        return 'test';
    }


}
