<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\VideogiochiRichiesteImmagini
 *
 * @property-read \App\Models\VideogiochiRichieste $richiesta
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichiesteImmagini newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichiesteImmagini newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichiesteImmagini query()
 * @mixin \Eloquent
 */
class VideogiochiRichiesteImmagini extends Model
{
    protected $table = 'videogiochi_richieste_immagini';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'richiesta_id',
        'immagine',
    ];

    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function richiesta(): BelongsTo
    {
        return $this->belongsTo(VideogiochiRichieste::class, 'richiesta_id', 'id');
    }
}
