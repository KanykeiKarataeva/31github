<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'galleries';
    protected $guarded = false;

    public function group()
    {
        return $this->belongsTo('App\Models\Group','group_id');
    }
}
