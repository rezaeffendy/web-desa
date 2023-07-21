<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulir extends Model
{
    use HasFactory;

    protected $table = 'tb_formulir';

    protected $guarded = [''];

    public function get_image()
    {
        return $this->hasMany(Upload::class, 'id_surat');
    }
}