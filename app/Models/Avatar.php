<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Avatar extends Model
{
    protected $table = 'avatars';
    protected $fillable = ['avatar_path','profile_id'];

    public function user() : HasOne
    {
        return $this->hasOne(Profile::class);
    }
}
