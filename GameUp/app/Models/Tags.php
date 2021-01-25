<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tags
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Tags newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tags newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tags query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $titolo
 * @method static \Illuminate\Database\Eloquent\Builder|Tags whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tags whereTitolo($value)
 */
class Tags extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'tags';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titolo'
    ];
}
