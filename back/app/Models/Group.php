<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups';

    protected $guarded = [];

    public function gallery(){
        return $this->hasMany('App\Models\Gallery');
   }

    public function children()
    {
        return $this->hasMany('App\Models\Child');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\User', 'teacher_id');
    }

}
