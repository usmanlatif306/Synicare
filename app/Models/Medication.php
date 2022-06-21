<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;

    protected $fillable = ['allergy_id', 'allergies', 'medication', 'doze', 'frequency', 'prescriber', 'image'];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function allergy()
    {
        return $this->BelongsTo(Allergy::class);
    }
}
