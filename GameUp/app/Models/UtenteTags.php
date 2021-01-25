<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\UtenteTags
 *
 * @property-read \App\Models\Tags $tag
 * @property-read \App\Models\User $utente
 * @method static \Illuminate\Database\Eloquent\Builder|UtenteTags newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UtenteTags newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UtenteTags query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $utente_id
 * @property int $tag_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UtenteTags whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UtenteTags whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UtenteTags whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UtenteTags whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UtenteTags whereUtenteId($value)
 */
class UtenteTags extends Model
{

    protected $table = 'utente_tags';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'utente_id',
        'tag_id'
    ];

    /**
     * @return BelongsTo
     */
    public function utente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'utente_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tags::class, 'tag_id', 'id');
    }
}
