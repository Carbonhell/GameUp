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
