<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Contenuti
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Contenuti newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contenuti newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contenuti query()
 * @mixin \Eloquent
 */
class Contenuti extends Model
{
    use HasFactory;

    protected $table = 'contenuti';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'visible',
    ];

    public $timestamps = false;

}
