<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oksigenasi extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'p_cair' => 'float',
        'p_tabung_kecil' => 'float',
        'p_tabung_sedang' => 'float',
        'p_tabung_besar' => 'float',
        'k_isi_cair' => 'float',
        'k_isi_tabung_kecil' => 'float',
        'k_isi_tabung_sedang' => 'float',
        'k_isi_tabung_besar' => 'float',
    ];
}
