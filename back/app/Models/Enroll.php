<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    use HasFactory;
    protected $table = 'enrolls';
    protected $guarded = false;

    public function parent(){
        return $this->belongsTo('App\Models\User', 'parent_id');
    }
}
