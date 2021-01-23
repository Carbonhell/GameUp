<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Reports
 *
 * @property-read \App\Models\User $autore
 * @property-read \App\Models\Contenuti $contenuto
 * @property-read \App\Models\User $risolutore
 * @method static \Illuminate\Database\Eloquent\Builder|Reports newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reports newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reports query()
 * @mixin \Eloquent
 */
class Reports extends Model
{

    protected $table = 'reports';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'autore_id',
        'risolutore_id',
        'contenuto_id',
        'motivo',
        'giudizio',
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
    public function risolutore(): BelongsTo
    {
        return $this->belongsTo(User::class, 'risolutore_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function contenuto(): BelongsTo
    {
        return $this->belongsTo(Contenuti::class, 'risolutore_id', 'id');
    }
}
