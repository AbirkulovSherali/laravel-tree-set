<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Comments extends Model
{
    use NodeTrait;
    
    protected $table = 'comments';
    protected $fillable = ['text', 'post_id', 'user_id', 'parent_id'];

    public function post(){
        return $this->belongsTo('App\Models\Posts');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
