<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $table = 'tb_upload';

    protected $guarded = [''];

    protected $hidden = ['id', 'id_surat', 'created_at', 'updated_at'];
}
