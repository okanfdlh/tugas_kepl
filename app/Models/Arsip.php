<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;
    protected $table = 'arsip';
    protected $fillable = ['nama_dokumen', 'id_lokasi', 'id_user', 'file_arsip'];
    public function lokasi(){
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }

    public function data_user(){
        return $this->belongsTo(UserModel1::class, 'id_user');
    }
}
