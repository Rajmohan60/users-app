<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

       protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'dob',
        'email',
        'password'

    ];
    protected $casts = [
    'dob' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}



