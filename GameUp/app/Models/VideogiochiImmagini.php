<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\VideogiochiImmagini
 *
 * @property-read \App\Models\Videogiochi $videogioco
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiImmagini newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiImmagini newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiImmagini query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $videogioco_id
 * @property string $immagine
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiImmagini whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiImmagini whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiImmagini whereImmagine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiImmagini whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiImmagini whereVideogiocoId($value)
 */
class VideogiochiImmagini extends Model
{
    use HasFactory;

    protected $table = 'videogiochi_immagini';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'videogioco_id',
        'immagine',
    ];

    /**
     * @return BelongsTo
     */
    public function videogioco(): BelongsTo
    {
        return $this->belongsTo(Videogiochi::class, 'videogioco_id', 'id');
    }
}
