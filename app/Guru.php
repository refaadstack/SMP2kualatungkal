<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable=[
        'nama',
        'nuptk',
        'mapel_id',
        'jeniskelamin',
        'user_id',
        'avatar',
        'tempatlahir',
        'tanggallahir',
        'nip',
        'statuskepegawaian',
        'jenjang',
        'jurusan',
        'sertifikasi',
        'email',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    /**
     * Karena guru bakal punya mapel jadi saya has many aja
     * soalnya biar gak ribet pas olah ada foreach di controller
     * karena foreach butuh array kalau bukan array entar error
     *
     */
    public function mapels(){
        return $this->hasMany(Mapel::class,'id','mapel_id');
    }

    public function getAvatar(){
        if(!$this->avatar){
            return asset('assets/img/undraw_profile.svg');
        }
        return asset('images/'.$this->avatar);
    }
    public function kelas(){
        return $this->hasOne(Kelas::class);
    }
}
