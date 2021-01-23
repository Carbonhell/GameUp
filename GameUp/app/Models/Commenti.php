<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Commenti
 *
 * @property-read \App\Models\Discussioni $discussione
 * @method static \Illuminate\Database\Eloquent\Builder|Commenti newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commenti newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commenti query()
 * @mixin \Eloquent
 */
class Commenti extends Model
{

    protected $table = 'commenti';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'discussione_id',
        'corpo',
    ];

    /**
     * @return BelongsTo
     */
    public function discussione(): BelongsTo
    {
        return $this->belongsTo(Discussioni::class, 'discussione_id', 'id');
    }

}
