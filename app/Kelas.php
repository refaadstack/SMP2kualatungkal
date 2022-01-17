<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable =[
        'namakelas','guru_id',
    ];

    public function siswa(){
        return $this->hasMany(Siswa::class);
    }
    public function guru(){
        return $this->belongsTo(Guru::class, 'guru_id','id');
    }
}
