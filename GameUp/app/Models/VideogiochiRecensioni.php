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
 * @property int $id
 * @property int $autore_id
 * @property int $videogioco_id
 * @property int $giudizio
 * @property string $commento
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRecensioni whereAutoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRecensioni whereCommento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRecensioni whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRecensioni whereGiudizio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRecensioni whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRecensioni whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiRecensioni whereVideogiocoId($value)
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
