<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\VideogiochiVersioni
 *
 * @property-read \App\Models\Videogiochi $videogioco
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiVersioni newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiVersioni newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiVersioni query()
 * @mixin \Eloquent
 */
class VideogiochiVersioni extends Model
{
    protected $table = 'videogiochi_versioni';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'videogioco_id',
        'versione',
        'changelog',
    ];

    /**
     * @return BelongsTo
     */
    public function videogioco(): BelongsTo
    {
        return $this->belongsTo(Videogiochi::class, 'videogioco_id', 'id');
    }
}
