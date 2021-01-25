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
 * @property int $id
 * @property int $videogioco_id
 * @property string $data_inizio
 * @property string $data_fine
 * @property string $costo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiSponsorizzazioni whereCosto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiSponsorizzazioni whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiSponsorizzazioni whereDataFine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiSponsorizzazioni whereDataInizio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiSponsorizzazioni whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiSponsorizzazioni whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiSponsorizzazioni whereVideogiocoId($value)
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
