<?php

namespace App\Http\Controllers;

use App\Models\ComposantRepas;
use App\Models\ElementComposant;
use Illuminate\Http\Request;


class ComposantController extends Controller
{

        public function dashboardComposant(){

            $composants = ComposantRepas::all();
            $elements = ElementComposant::all();

            $elements = json_encode($elements);

            return view('page.form_ajou_composant',compact('composants','elements'));

        }


        public function post_ajout_composant(Request $request){

            $validated = $request->validate([
                'composant' => 'required|unique:composant_repas,composant_repas',
                'image_composant'=> 'required',
            ],$message = [
                'composant.required'=>"Vous n'avez pas saisi de composant",
                'composant.unique'=>"Ce composant est existe dejà",
                'image_composant.required'=>"Vous n'avez pas choisi d'image de composant repas",
            ] );
            //dd($request);

            $filename_p =  $request->composant.time().'.'.$request->image_composant->extension();
            //dd($filename);
            $path =   $request->file('image_composant')->storeAs(
                'Composant_image',
                $filename_p,
                'public'
            );

            $elements = [];
            foreach($request->element as $element){
                $el = ElementComposant::Where('element_composant',$element)->first();

                $elements[] = $el->id;
            }


            //$post->tags()->attach([1, 2, 3]);
            //dd($elements);

             $composant = ComposantRepas::create([
                'composant_repas' => $request->composant,
                'image_composants' => $path,
            ]);

            //dd($path,$composant);



            $elements = array_unique($elements);

            $composant->elements()->attach($elements);


            return redirect()->back()->with('flash_message_success', 'Composant ajouter avec succèss');


        }


        public function modif_composant($id){

            $composant = ComposantRepas::find($id);

            $elements = ElementComposant::all();

            return view('page.modifComposant',compact('composant','elements'));

        }



        public function post_modif_composant(Request $request,$id){



            if(empty($request->select)){
                return redirect()->back()->with('error', 'Pas élément a modifié');
            }

            if(empty($request->repas)){

                $composant = ComposantRepas::find($id);
            $elements = [];
                foreach($request->select as $sel){
                    $el = ElementComposant::where('element_composant',$sel)->first();
                    $elements[] = $el->id;
                }

                //dd($elements);



                // Utilisation de array_unique pour supprimer les doublons
                $elements = array_unique($elements);

                $composant->elements()->sync($elements);


            }else{

                $composant = ComposantRepas::find($id);
            $elements = [];
                foreach($request->select as $sel){
                    $el = ElementComposant::where('element_composant',$sel)->first();
                    $elements[] = $el->id;
                }

                //dd($request->repas);

                foreach($request->repas as $rep){
                    $rep = ElementComposant::where('element_composant',$rep)->first();
                    $elements[] = $rep->id;
                }

                //dd($elements);

                // Utilisation de array_unique pour supprimer les doublons
                $elements = array_unique($elements);
                //dd($elements);
                $composant->elements()->sync($elements);

            }

                       return redirect()->route('dashboardComposant')->with('flash_message_success', 'Composant modifier avec succèss');


        }


        public function post_modif_photo_composant(Request $request,$id){

            $validated = $request->validate([
                'image_composant'=> 'required',
            ],$message = [
                'image_composant.required'=>"Vous n'avez pas choisi d'image de composant repas",
            ] );


                $composant = ComposantRepas::find($id);
                $composant->image_composants = $request->image_composant;
                $composant->save();
                //dd($elements);

      return redirect()->route('dashboardComposant')->with('flash_message_success', 'Image composant modifier avec succèss');


        }



        public function delete_composant($id){

            $composant = ComposantRepas::find($id);
            $composant->delete();

            return redirect()->back()->with('flash_message_success', 'Composant supprimer avec succèss');

        }



}
