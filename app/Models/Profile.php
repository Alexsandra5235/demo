<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $fillable = ['name','email','password','phone'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function avatar() : HasOne
    {
        return $this->hasOne(Avatar::class, 'profile_id');
    }
}
