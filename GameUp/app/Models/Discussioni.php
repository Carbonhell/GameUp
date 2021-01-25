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
 * @property int $id
 * @property int $videogioco_id
 * @property string $titolo
 * @property int $in_rilievo
 * @property int $chiusa
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Discussioni whereChiusa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussioni whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussioni whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussioni whereInRilievo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussioni whereTitolo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussioni whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discussioni whereVideogiocoId($value)
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
