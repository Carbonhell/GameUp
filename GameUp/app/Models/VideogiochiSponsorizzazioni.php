<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\VideogiochiSponsorizzazioni
 *
 * @property-read \App\Models\Videogiochi $videogioco
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiSponsorizzazioni newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiSponsorizzazioni newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiSponsorizzazioni query()
 * @mixin \Eloquent
 */
class VideogiochiSponsorizzazioni extends Model
{
    protected $table = 'videogiochi_sponsorizzazioni';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'videogioco_id',
        'data_inizio',
        'data_fine',
        'costo',
    ];

    /**
     * @return BelongsTo
     */
    public function videogioco(): BelongsTo
    {
        return $this->belongsTo(Videogiochi::class, 'videogioco_id', 'id');
    }
}
