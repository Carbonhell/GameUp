<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\VideogiochiTags
 *
 * @property-read \App\Models\Tags $tag
 * @property-read \App\Models\Videogiochi $videogioco
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiTags newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiTags newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiTags query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $videogioco_id
 * @property int $tag_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiTags whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiTags whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiTags whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiTags whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VideogiochiTags whereVideogiocoId($value)
 */
class VideogiochiTags extends Model
{
    use HasFactory;

    protected $table = 'videogiochi_tags';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'videogioco_id',
        'tag_id'
    ];

    /**
     * @return BelongsTo
     */
    public function videogioco(): BelongsTo
    {
        return $this->belongsTo(Videogiochi::class, 'videogioco_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tags::class, 'tag_id', 'id');
    }
}
