<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable=[
        'nama','nuptk','mapel_id','jeniskelamin','user_id','avatar','tempatlahir','tanggallahir','agama','email','nip'
    ];

    public function user(){
        return $this->belongsTo(User::class);
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
}
