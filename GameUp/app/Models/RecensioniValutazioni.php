<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\RecensioniValutazioni
 *
 * @property-read \App\Models\User $autore
 * @property-read RecensioniValutazioni $recensione
 * @method static \Illuminate\Database\Eloquent\Builder|RecensioniValutazioni newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RecensioniValutazioni newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RecensioniValutazioni query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $autore_id
 * @property int $recensione_id
 * @property int $giudizio
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RecensioniValutazioni whereAutoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecensioniValutazioni whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecensioniValutazioni whereGiudizio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecensioniValutazioni whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecensioniValutazioni whereRecensioneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecensioniValutazioni whereUpdatedAt($value)
 */
class RecensioniValutazioni extends Model
{
    protected $table = 'recensioni_valutazioni';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'autore_id',
        'recensione_id',
        'giudizio',
    ];

    /**
     * @return BelongsTo
     */
    public function autore(): BelongsTo
    {
        return $this->belongsTo(User::class, 'autore_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function recensione(): BelongsTo
    {
        return $this->belongsTo(RecensioniValutazioni::class, 'recensione_id', 'id');
    }
}
