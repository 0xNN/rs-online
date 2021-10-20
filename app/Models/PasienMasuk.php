<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasienMasuk extends Model
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
        'igd_suspect_l' => 'string',
        'igd_suspect_p' => 'string',
        'igd_confirm_l' => 'string',
        'igd_confirm_p' => 'string',
        'rj_suspect_l' => 'string',
        'rj_suspect_p' => 'string',
        'rj_confirm_l' => 'string',
        'rj_confirm_p' => 'string',
        'ri_suspect_l' => 'string',
        'ri_suspect_p' => 'string',
        'ri_confirm_l' => 'string',
        'ri_confirm_p' => 'string',
    ];

}
