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
 * @property int $id
 * @property int $visibile
 * @method static \Illuminate\Database\Eloquent\Builder|Contenuti whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contenuti whereVisibile($value)
 */
class Contenuti extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'contenuti';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'visible',
    ];

}
