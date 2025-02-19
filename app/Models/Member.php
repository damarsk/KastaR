<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member';
    protected $primaryKey = 'id_member';
    protected $fillable = ['nama', 'telepon', 'alamat'];
    protected $guarded = ['id_member', 'kode_member'];
}
