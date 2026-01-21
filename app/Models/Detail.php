<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detail extends Model
{
    public const TYPE_PROFILE = 'profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'key',
        'value',
        'type',
        'user_id',
    ];

    /**
     * Get linked user record.
     *
     * @return BelongsTo Returns the many-to-one relationship object.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
