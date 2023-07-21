<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaksin extends Model
{
    use HasFactory;

    protected $table = 'tb_vaksin';

    protected $guarded = [''];

    public function penduduk()
    {
        return $this->hasOne(Penduduk::class, 'id', 'id_penduduk');
    }
}
