<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tags
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Tags newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tags newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tags query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $videogioco_id
 * @property int $compratore_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $compratore
 * @property-read \App\Models\Videogiochi $videogioco
 * @method static \Illuminate\Database\Eloquent\Builder|AcquistiVideogiochi whereCompratoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcquistiVideogiochi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcquistiVideogiochi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcquistiVideogiochi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcquistiVideogiochi whereVideogiocoId($value)
 */
class AcquistiVideogiochi extends Model
{

    protected $table = 'acquisti_videogiochi';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'videogioco_id',
        'compratore_id'
    ];

    public function videogioco()
    {
        return $this->belongsTo(Videogiochi::class, 'videogioco_id', 'id');
    }

    public function compratore()
    {
        return $this->belongsTo(User::class, 'compratore_id', 'id');
    }

}
