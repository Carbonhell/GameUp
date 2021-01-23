<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tags
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Tags newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tags newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tags query()
 * @mixin \Eloquent
 */
class AcquistiVideogiochi extends Model
{

    protected $table = 'acquisti_videogiochi';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'videogioco_id',
        'compratore_id'
    ];

    public function videogioco()
    {
        return $this->belongsTo(Videogiochi::class, 'videogioco_id', 'id');
    }

    public function compratore()
    {
        return $this->belongsTo(User::class, 'compratore_id', 'id');
    }

}
