<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'allergies'];

    // allergy belong to user
    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    // user medictions
    public function medications()
    {
        return $this->hasMany(Medication::class)->latest();
    }
}
