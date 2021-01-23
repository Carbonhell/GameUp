<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\VideogiochiRecensioni
 *
 * @property-read \App\Models\User $autore
 * @property-read \App\Models\Videogiochi $videogioco
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRecensioni newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRecensioni newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRecensioni query()
 * @mixin \Eloquent
 */
class VideogiochiRecensioni extends Model
{
    protected $table = 'videogiochi_recensioni';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'autore_id',
        'videogioco_id',
        'giudizio',
        'commento',
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
    public function videogioco(): BelongsTo
    {
        return $this->belongsTo(Videogiochi::class, 'videogioco_id', 'id');
    }
}
