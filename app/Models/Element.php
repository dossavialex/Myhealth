<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    public function composants()
    {
        return $this->belongsToMany(ComposantRepas::class,'element_composant','element_composants_id','composant_repas_id');
    }

}
