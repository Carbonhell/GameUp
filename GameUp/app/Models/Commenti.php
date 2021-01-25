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
 * @property int $id
 * @property int $discussione_id
 * @property string $corpo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Commenti whereCorpo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commenti whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commenti whereDiscussioneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commenti whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commenti whereUpdatedAt($value)
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
