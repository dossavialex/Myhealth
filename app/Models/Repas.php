<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Repas extends Model
{
    use  HasFactory;

    protected $table = "repas";

    protected $primaryKey = 'id';

    protected $fillable = ['libelle_repas','user_id','heure_repas','date_repas'];

    public function composants()
    {
        return $this->belongsToMany(ComposantRepas::class,'repas_composant','repas_id','composant_repas_id');
    }

}
