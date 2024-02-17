<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eleve extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class);
    }
}
