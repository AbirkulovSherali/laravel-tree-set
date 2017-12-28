<?php

namespace App\Models;
use Kalnoy\Nestedset\NodeTrait;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{

    use NodeTrait;

    protected $table = 'categories';
    public $timestamps = false;
    protected $fillable = ['name', 'parent_id'];

}
