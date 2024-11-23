<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Composant extends Model
{
    public function repas()
    {
        return $this->belongsToMany(Repas::class,'repas_composant','repas_id','composant_repas_id');
    }

    public function elements()
    {
        return $this->belongsToMany(ElementComposant::class,'element_composant','composant_repas_id','element_composants_id');
    }
}
