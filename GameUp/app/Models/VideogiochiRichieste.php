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
 * @property int $id
 * @property int $autore_id
 * @property string $logo
 * @property string $titolo
 * @property string $descrizione
 * @property string $prezzo
 * @property int $tipo
 * @property string $eseguibile
 * @property int|null $esito
 * @property string|null $commento
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichieste whereAutoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichieste whereCommento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichieste whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichieste whereDescrizione($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichieste whereEseguibile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichieste whereEsito($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichieste whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichieste whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichieste wherePrezzo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichieste whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichieste whereTitolo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRichieste whereUpdatedAt($value)
 */
class VideogiochiRichieste extends Model
{
    public const TYPE_PUBLISH = 1;
    public const TYPE_EDIT = 2;
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
