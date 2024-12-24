<?php

namespace App\Http\Controllers;

use App\Models\Autorisations;
use App\Models\AutorisationSpeciale;
use App\Models\Articles;
use App\Models\Departements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArticlesController extends Controller
{
    public function list_des_articles(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'articles')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'articles')->where('user_id', $request->user()->id)->first();
        $articles = [];
        if ($autorisation){
            if ($autorisation->autorisation_en_lecture){
                if(in_array('peux voir tous les articles', json_decode($autorisation->autorisation_en_lecture, true))){
                    $articles = Articles::where('statut', 'validé')->get();
                }else {
                    $articles = Articles::where('departement_id', $request->user()->departement_id)->where('statut', 'validé')->get();
                }
            }
        }
        return view('private_layouts.articles_folder.list_des_articles', ['current_user'=>$request->user(), 'articles'=>$articles, 'autorisation'=>$autorisation, 'autorisation_speciale'=>$autorisation_speciale]);
    }

    public function nouvel_article(Request $request):View
    {
        $current_user = $request->user();
        $departements = Departements::all();
        return view('private_layouts.articles_folder.ajouter_un_article', compact("current_user", "departements"));
    }


    public function voir_mes_drafts_articles(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'articles')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'articles')->where('user_id', $request->user()->id)->first();
        $articles = Articles::with(["departement", "rapporteur"])->where('statut', 'draft')->where('rapporteur_id', $request->user()->id)->get();
        return view('private_layouts.articles_folder.list_des_articles', ['current_user'=>$request->user(), 'articles'=>$articles, 
        'autorisation'=>$autorisation, 'autorisation_speciale'=>$autorisation_speciale]);
    }


    public function voir_les_attentes_en_validation(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'articles')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'articles')->where('user_id', $request->user()->id)->first();
        $articles = Articles::where('statut', 'en attente de validation')->get();
        return view('private_layouts.articles_folder.list_des_articles', ['current_user'=>$request->user(), 'articles'=>$articles, 
        'autorisation'=>$autorisation, 'autorisation_speciale'=>$autorisation_speciale]);
    }

    public function save_article(Request $request)
    {
        $request->validate([
            'departement_id'=>['required'] ,
            'date'=>['required'],
            'titre'=>['required'],
            'description'=>['required'],
        ],
        [
            'departement_id.required'=>'ce champs est obligatoire',
            'date.required'=>'ce champs est obligatoire',
            'titre.required'=>'ce champs est obligatoire',
            'description.required'=>'ce champs est obligatoire',
        ]);

        $bibliotheque = [];

        if ($request->hasFile('bibliotheque')) {
            foreach ($request->file('bibliotheque') as $file) {
                $path = $file->store('medias', 'public');
                $bibliotheque[] = $path;
            }
        }

        $video = "";
        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('medias', 'public');
            $video = $path;
        }


        $action = $request->input('action');
        $message = '';
        $statut = 'draft';
        if ($action == 'soumission') {
            $statut = 'en attente de validation';
            $message = "L'article a été soumis et est en attente de validation";
        }
        if ($action == 'draft') {
            $statut = 'draft';
            $message = "Le draft a été enregistré";
        }


        $article = Articles::create([
            'departement_id'=>$request->get('departement_id'),
            'rapporteur_id'=>$request->user()->id,
            'rapporteur'=>$request->user()->nom.' '.$request->user()->postnom.' '.$request->user()->prenom,
            'date'=>$request->get('date'),
            'titre'=>$request->get('titre'),
            'description'=>$request->get('description'),
            'bibliotheque'=>json_encode($bibliotheque),
            'video'=>$video,
            'statut'=>$statut,
        ]);

        return redirect()->route('article.list_des_articles')->with('success', $message);
    }

    public function afficher_article($article_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'articles')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisationspeciales = AutorisationSpeciale::where('table_name', 'articles')->where('user_id', $request->user()->id)->first();
        $article = Articles::with(['departement', 'rapporteur_user'])->find($article_id);
        return view('private_layouts.articles_folder.afficher_article', ['article'=>$article, 'current_user'=>$request->user(), 
        'autorisation'=>$autorisation, 'autorisation_speciale'=>$autorisationspeciales]);
    }


    public function supprimer_article(Request $request)
    {
        $article_id = $request->get("article_id");
        $article = Articles::find($article_id);
        $article->delete();

        $action = $request->input('action');
        if ($action === 'suppression_draft') {
            return redirect()->route('article.voir_mes_drafts')->with('success', "le draft a été supprimé");
        }else {
            return redirect()->route('article.list_des_articles')->with('success', "l'article a été supprimé");
        }
    }


    public function traitement_article($article_id, Request $request)
    {
        $article = Articles::find($article_id);
        $action = $request->input('action');
        if ($action === "soumission") {
            $article->statut = "en attente de validation";
            $article->update();
        }elseif ($action === 'validation') {
            $article->statut = "validé";
            $article->update();
        }elseif ($action === 'publication') {
            $article->audience = "public";
            $article->update();
        }
        elseif ($action === 'prive') {
            $article->audience = "privé";
            $article->update();
        }

        return redirect()->route('article.afficher_article', $article_id)->with('success', 'le traitement a été appliqué');
    }


    public function edit_article($article_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'articles')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $article = Articles::find($article_id);
        $departements = Departements::all();
        return view('private_layouts.articles_folder.editer_un_article', ['article'=>$article, 'current_user'=>$request->user(), 'autorisation'=>$autorisation, 'departements'=>$departements]);
    }

    public function save_edition_article($article_id, Request $request)
    {
        $request->validate([
            'departement_id'=>['required'],
            'date'=>['required'],
            'titre'=>['required'],
            'description'=>['required'],
        ], [
            'departement_id'=>'Ce champs est obligatoire',
            'date.required'=>'ce champs est obligatoire',
            'titre.required'=>'ce champs est obligatoire',
            'orateur.required'=>'ce champs est obligatoire',
            'description.required'=>'ce champs est obligatoire',
        ]);

        $article = Articles::find($article_id);

        $bibliotheque = [];

        $existing_photos = json_decode($article->bibliotheque, true) ?? [];
        $submitted_photos = $request->input('bibliotheque', []);

        $deleted_photos = array_diff($existing_photos, $submitted_photos);

        foreach ($deleted_photos as $photo) {
            Storage::disk('public')->delete($photo);
        }

        $updated_photos = array_diff($existing_photos, $deleted_photos);


        if ($request->hasFile('bibliotheque')) {
            foreach ($request->file('bibliotheque') as $file) {
                $path = $file->store('medias', 'public');
                $bibliotheque[] = $path;
            }
        }

        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('medias', 'public');
            if ($article->video){
                Storage::disk('public')->delete($article->video);
            }
            $article->video = $path;
        }else {
            if ($request->has("delete_video")) {
                Storage::disk('public')->delete($enseignement->video);
                $enseignement->affiche_video = null;
            }
        }

        $all_photos = array_merge($updated_photos, $bibliotheque);

        $article->date = $request->get('date');
        $article->departement_id = $request->get('departement_id');
        $article->titre = $request->get('titre');
        $article->description = $request->get('description');
        $article->bibliotheque = json_encode($all_photos);

        $article->update();

        return redirect()->route('article.afficher_article', $article_id)->with('success', 'les mises à jours ont été appliqués');
    }
}
