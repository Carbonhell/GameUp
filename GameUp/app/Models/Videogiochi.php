<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Videogiochi extends Model
{

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

}
