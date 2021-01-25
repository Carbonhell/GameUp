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
 * @property int $id
 * @property int $autore_id
 * @property string $logo
 * @property string $titolo
 * @property string $descrizione
 * @property string $prezzo
 * @property string $data_pubblicazione
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $compratori
 * @property-read int|null $compratori_count
 * @property-read \App\Models\Contenuti $contenuti
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tags[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Videogiochi whereAutoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Videogiochi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Videogiochi whereDataPubblicazione($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Videogiochi whereDescrizione($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Videogiochi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Videogiochi whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Videogiochi wherePrezzo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Videogiochi whereTitolo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Videogiochi whereUpdatedAt($value)
 */
class Videogiochi extends Model
{
    use HasFactory;

    public $incrementing = false;
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
