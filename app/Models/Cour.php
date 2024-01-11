<?php

namespace App\Models;

use App\Models\TacheStagiaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cour extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomCours',
        'description',
        'image',
        'ressource',
        'module_id',
    ];

    public function module(){
        return $this->belongsTo(Module::class);
    }
    public function tacheStagiaire(){
        return $this->hasMany(TacheStagiaire::class);
    }
      
}
