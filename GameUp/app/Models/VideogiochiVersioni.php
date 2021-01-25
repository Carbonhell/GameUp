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
 * @property int $id
 * @property int $videogioco_id
 * @property string $versione
 * @property string $eseguibile
 * @property string $changelog
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiVersioni whereChangelog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiVersioni whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiVersioni whereEseguibile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiVersioni whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiVersioni whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiVersioni whereVersione($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiVersioni whereVideogiocoId($value)
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
