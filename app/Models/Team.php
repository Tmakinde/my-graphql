<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'user_id', 'seller_user_id', 'assigned',
    ];

    public function sellers(){
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'team_id');
    }

}
