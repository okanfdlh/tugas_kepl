<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserModel1 extends Model
{
    protected $table = 'data_user';
    protected $primaryKey = 'id';

    public function arsip(){
        return $this->hasMany(Arsip::class, 'id_user');
    }
}
