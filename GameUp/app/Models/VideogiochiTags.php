<?php

namespace App\Models;

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
 */
class VideogiochiTags extends Model
{
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
