<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\VideogiochiImmagini
 *
 * @property-read \App\Models\Videogiochi $videogioco
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiImmagini newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiImmagini newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiImmagini query()
 * @mixin \Eloquent
 */
class VideogiochiImmagini extends Model
{
    protected $table = 'videogiochi_immagini';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'videogioco_id',
        'immagine',
    ];

    /**
     * @return BelongsTo
     */
    public function videogioco(): BelongsTo
    {
        return $this->belongsTo(Videogiochi::class, 'videogioco_id', 'id');
    }
}
