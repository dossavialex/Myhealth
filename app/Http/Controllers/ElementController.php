<?php

namespace App\Http\Controllers;

use App\Models\ElementComposant;
use Illuminate\Http\Request;
use Termwind\Components\Element;

class ElementController extends Controller
{
    public function form_element(){

        $elements = ElementComposant::all();

        return view('page.form_ajout_element',compact('elements'));

    }


    public function form_element_post(Request $request){

        $validated = $request->validate([
            'element' => 'required',
        ]);

        ElementComposant::create([
          'element_composant' => $request->element,
          'composantrepas_id' => 1,
        ]);

        return redirect()->back()->with('flash_message_success', 'Element ajouter avec succèss');

    }



        public function form_element_modif_post(Request $request){

        $validated = $request->validate([
            'element' => 'required|unique:element_composants,element_composant,',
        ],$message =[
           'element.required' =>"Vous n'avez pas saisi d'élement de composant",
           'element.unique' =>"Cet élément de repas exite dejà",
        ]);


       $element = ElementComposant::find($request->id);
       $element->element_composant = $request->element;
       $element->save();

        return redirect()->back()->with('flash_message_success', 'Element modifier avec succèss');

    }

    public function delete_element($id){

        $element = ElementComposant::find($id);
        $element->delete();

        return redirect()->back()->with('flash_message_success', 'Element supprimer avec succèss');

    }



}
