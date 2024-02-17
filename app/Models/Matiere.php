<?php

namespace App\Models;

use App\Models\Enseignant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matiere extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function enseignant()
    {
        return $this->hasMany(Enseignant::class);
    }
}
