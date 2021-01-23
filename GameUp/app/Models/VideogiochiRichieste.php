<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\VideogiochiRichieste
 *
 * @property-read \App\Models\User $autore
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VideogiochiRichiesteImmagini[] $immagini
 * @property-read int|null $immagini_count
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichieste newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichieste newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichieste query()
 * @mixin \Eloquent
 */
class VideogiochiRichieste extends Model
{
    protected $table = 'videogiochi_richieste';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'autore_id',
        'titolo',
        'descrizione',
        'prezzo',
        'tipo',
        'esito',
        'commento'
    ];

    /**
     * @return BelongsTo
     */
    public function autore(): BelongsTo
    {
        return $this->belongsTo(User::class, 'autore_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function immagini(): HasMany
    {
        return $this->hasMany(VideogiochiRichiesteImmagini::class, 'richiesta_id', 'id');
    }
}
