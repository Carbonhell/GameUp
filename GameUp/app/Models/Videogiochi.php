<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Videogiochi
 *
 * @property-read \App\Models\User $autore
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VideogiochiImmagini[] $immagini
 * @property-read int|null $immagini_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VideogiochiSponsorizzazioni[] $sponsorizzazioni
 * @property-read int|null $sponsorizzazioni_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VideogiochiVersioni[] $versioni
 * @property-read int|null $versioni_count
 * @method static \Illuminate\Database\Eloquent\Builder|Videogiochi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Videogiochi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Videogiochi query()
 * @mixin \Eloquent
 */
class Videogiochi extends Model
{
    use HasFactory;

    protected $table = 'videogiochi';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'autore_id',
        'titolo',
        'descrizione',
        'prezzo',
        'data_pubblicazione',
        'visibile'
    ];

    /**
     * @return BelongsTo
     */
    public function autore(): BelongsTo
    {
        return $this->belongsTo(User::class, 'autore_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function immagini(): HasMany
    {
        return $this->hasMany(VideogiochiImmagini::class, 'videogioco_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function sponsorizzazioni(): HasMany
    {
        return $this->hasMany(VideogiochiSponsorizzazioni::class, 'videogioco_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function versioni(): HasMany
    {
        return $this->hasMany(VideogiochiVersioni::class, 'videogioco_id', 'id');
    }

    public function contenuti()
    {
        return $this->belongsTo(Contenuti::class, 'id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, VideogiochiTags::class, 'videogioco_id', 'tag_id');
    }

    public function compratori()
    {
        return $this->belongsToMany(User::class, AcquistiVideogiochi::class, 'videogioco_id', 'compratore_id');
    }
}
