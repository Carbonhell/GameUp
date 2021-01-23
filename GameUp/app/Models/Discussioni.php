<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Discussioni
 *
 * @property-read \App\Models\Videogiochi $videogioco
 * @method static \Illuminate\Database\Eloquent\Builder|Discussioni newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discussioni newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discussioni query()
 * @mixin \Eloquent
 */
class Discussioni extends Model
{

    protected $table = 'discussioni';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'videogioco_id',
        'titolo',
        'in_rilievo',
        'chiusa',
    ];

    /**
     * @return BelongsTo
     */
    public function videogioco(): BelongsTo
    {
        return $this->belongsTo(Videogiochi::class, 'videogioco_id', 'id');
    }

}
