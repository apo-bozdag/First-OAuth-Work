<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table = "cities";
    protected $fillable = [
        "user_id", "name", "slug", "body"
    ];

    public function user(){
        return $this->belongsTo("App\User");
    }
}
