<?php

namespace App\Http\Controllers;

use App\Models\ComposantRepas;
use App\Models\ElementComposant;
use App\Models\Repas;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isNull;

class ViewController extends Controller
{
    public function principoal_view(){

        /*$repas = Repas::select('composant', 'created_at')->get()->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d'); // Use Carbon to format the date
        });*/

        /*$repasLimite = Repas::select('libelle_repas', 'created_at')
        ->get()
        ->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d'); // Group by date (YYYY-MM-DD)
        })
        ->map(function ($group) {
            return $group->count(); // Count records for each group
        });*/

        // Limiter à deux éléments par date
        /*$repasLimite = $repasGroupe->map(function ($items) {
            return $items->take(2); // Prendre seulement les deux premiers éléments
        });*/

        //dd($repasLimite);
        // Si vous avez besoin de le convertir en collection ou en tableau
        //$repasLimite = $repasLimite->flatten(1);

        //dd($repasLimite);


        $repasLimite = Repas::select('libelle_repas', 'created_at')
        ->where('user_id', Auth::user()->id) // Filtrer par l'ID de l'utilisateur
        ->orderBy('created_at', 'desc') // Trier par 'created_at' dans l'ordre décroissant
        ->get()
        ->groupBy(function ($item) {
            // Formater 'created_at' pour ne garder que la date (Y-m-d)
            return $item->created_at->format('Y-m-d');
        })
        ->map(function ($group) {
            // Compter les éléments de chaque groupe
            return $group->count();
        });


            //dd($repasLimite);

        return view('page.accueil',compact('repasLimite'));

    }


    public function form_view(){

        $composants = ComposantRepas::all();

        $composants = json_encode($composants);

        return view('page.fom_ajout_reps',compact('composants'));

    }

    public function post_form_repas(Request $request){

        //dd($request->repas);
        if (empty($request->repas) || count(array_filter($request->repas, function($value) { return $value !== null; })) === 0) {

            return redirect()->back()->with('error',"Aucun composant choisi ");

        }


       $repas =  Repas::create([
            'libelle_repas' => 'repas',
            'user_id' => Auth::user()->id,
        ]);

        $composants = [];
        $repa = array_values(array_unique($request->repas));

        //dd($repa);
        foreach($repa as $rep){

            $comp = ComposantRepas::where('composant_repas',$rep)->first();
            $composants[ ] = $comp->id;
        }

        //dd($composants);

        $repas->composants()->attach($composants);

        return redirect()->route('accueil')->with('flash_message_success', 'les composants de votre repas sont enregistré avec succes');

    }


    public function modif_profil(){

        return view('page.from_profil');

    }


    public function post_modif_profil_password(Request $request,$id){


        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation'=> 'required',
        ],$message = [
            'password_confirmation.required' => "Vous devez saisir l'ancien mot de passe",
            'old_password.required' => "Vous n'avez pas confimé votre mot de passe ",
            'password.required' => "Vous devez saisir le nouveau mot de passe",
            'password.confirmed' => "la confirmation du nouveau mot de passe n'est pas la même",
        ]);

        $data = $request->all();
        $currentUser = User::find($id);
        if (Hash::check($data['old_password'], $currentUser->password)) {
            User::where(['id' => $id])->update([
                'password' => bcrypt($data['password']),
            ]);

            return redirect()->back()->with('success', 'Votre mot de passe a été modifié avec succès. Veuillez vous reconnecter avec le nouveau mot de passe.');
                 } else {
            return redirect()->back()->withErrors(['old_password' => 'Ancien mot de passe incorrect! Veuillez réessayer']);
        }

    }


    public function post_modif_profil(Request $request,$id){


        $validated = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'telephone' => 'required|unique:users,tel|max:255',
            'email' => 'required|email|unique:users',
            //'password' => 'required|confirmed',
            //'password_confirmation'=> 'required',
        ],$message =[
            'first_name.required' => "Vous n'avez pas saisi votre prénom",
            'last_name.required' => "Vous n'avez pas saisi votre nom",
            'telephone.required' => "Vous n'avez pas saisi votre numéro de téléphone",
            'telephone.unique' => "Numéro de téléphone déjà utilisé",
            'temail.required' => "Vous n'avez pas saisi votre email",
            'email.unique' => "Email déjà utilisé",
            'email.required' => "Vous n'avez pas saisi d'email",
            'email.email' => "Ce que vous avez saisi n'est pas un email",
        ]);



        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name =  $request->last_name;
        $user->tel = $request->telephone;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('flash_message_success', 'vos information ont été modifier éffectuer avec succèss');;


    }


    public function modif_photo(Request $request){

        $validate = $request->validate([
            'attachment' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],$message = [
            'attachment.required' => "Vous n'avez pas envoyé d'image",
            'attachment.image' => "ce que vous devez envoyé doit être une image",
            'attachment.max' => "La capicité de l'image ne doit pas dépassé 2048 Ko",
        ]);


        $filename = Auth::user()->id.$request->attachment->extension();
        //dd($filename);
        $path =   $request->file('attachment')->storeAs(
            'users_profile',
            $filename,
            'public'
        );

        $user = User::find(Auth::user()->id);
        $user->image_profile = $path;
        $user->save();

        return redirect()->back()->with('flash_message_success', 'la photo a été modifier éffectuer avec succèss');;
    }


    public function detailRepasday($date){

        //dd($date);

        $repas = Repas::whereDate('created_at','like', '%' . $date . '%')->where('user_id',Auth::user()->id)->get();


        //dd($repas);

        return view('page.DetailRepasDay',compact('repas','date'));

    }


    public function detailRepas($id,$date,$n){

        $repas = Repas::find($id);

        return view('page.detailRepas',compact('repas','date','n'));

    }


}
