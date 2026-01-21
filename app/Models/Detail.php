<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model {
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
}
