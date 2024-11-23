<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComposantRepas extends Model
{

    protected $fillable = ['composant_repas','image_composants'];


    public function repas()
    {
        return $this->belongsToMany(Repas::class,'repas_composant','repas_id','composant_repas_id');
    }

    public function elements()
    {
        return $this->belongsToMany(ElementComposant::class,'element_composant','composant_repas_id','element_composants_id');
    }
}
