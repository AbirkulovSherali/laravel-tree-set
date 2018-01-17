<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'messages';

    public $timestamps = false;

    protected $fillable = [
        'from_user_id', 'to_user_id', 'text', 'created_at'
    ];
}
