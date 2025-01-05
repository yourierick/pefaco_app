<?php

namespace App\Http\Controllers;

use App\Models\Autorisations;
use App\Models\AutorisationSpeciale;
use App\Models\Articles;
use App\Models\User;
use App\Models\Departements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\CustomSystemNotificationTrait;

class ArticlesController extends Controller
{
    use CustomSystemNotificationTrait;
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

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/article/list'), 'label'=>"Articles", 'icon'=>'bi-list fs-5'],
        ];
        return view('private_layouts.articles_folder.list_des_articles', ['current_user'=>$request->user(),
        'articles'=>$articles, 'autorisation'=>$autorisation,
        'autorisation_speciale'=>$autorisation_speciale, 'breadcrumbs'=>$breadcrumbs]);
    }

    public function nouvel_article(Request $request):View
    {
        $current_user = $request->user();
        $departements = Departements::all();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/article/list'), 'label'=>"Articles", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/article/nouvel_article'), 'label'=>"Articles", 'icon'=>'bi-plus-circle fs-5'],
        ];
        return view('private_layouts.articles_folder.ajouter_un_article', compact("current_user",
        "departements", "breadcrumbs"));
    }


    public function voir_mes_drafts_articles(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'articles')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'articles')->where('user_id', $request->user()->id)->first();
        $articles = Articles::with(["departement", "rapporteur_user"])->where('statut', 'draft')->where('rapporteur_id', $request->user()->id)->get();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/article/list'), 'label'=>"Articles", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/article/voir_mes_drafts_articles'), 'label'=>"Mes drafts", 'icon'=>'bi-list fs-5'],
        ];

        return view('private_layouts.articles_folder.list_des_articles', ['current_user'=>$request->user(), 'articles'=>$articles,
        'autorisation'=>$autorisation, 'autorisation_speciale'=>$autorisation_speciale, "breadcrumbs"=>$breadcrumbs]);
    }


    public function voir_les_attentes_en_validation(Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'articles')->where('groupe_id', $request->user()->groupe_utilisateur_id)->first();
        $autorisation_speciale = AutorisationSpeciale::where('table_name', 'articles')->where('user_id', $request->user()->id)->first();
        $articles = Articles::where('statut', 'en attente de validation')->get();

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/article/list'), 'label'=>"Articles", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/article/voir_les_attentes_en_validation'), 'label'=>"Articles en attente", 'icon'=>'bi-list fs-5'],
        ];

        return view('private_layouts.articles_folder.list_des_articles', ['current_user'=>$request->user(), 'articles'=>$articles,
        'autorisation'=>$autorisation, 'autorisation_speciale'=>$autorisation_speciale, "breadcrumbs"=>$breadcrumbs]);
    }

    public function save_article(Request $request)
    {
        $request->validate([
            'departement_id'=>['required'] ,
            'date'=>['required'],
            'titre'=>['required'],
            'description'=>['required'],
            'galerie'=>['required'],
        ],
        [
            'departement_id.required'=>'ce champs est obligatoire',
            'date.required'=>'ce champs est obligatoire',
            'titre.required'=>'ce champs est obligatoire',
            'description.required'=>'ce champs est obligatoire',
            'galerie.required'=>"ce champs est obligatoire",
        ]);

        $bibliotheque = [];

        if ($request->hasFile('galerie')) {
            foreach ($request->file('galerie') as $file) {
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
            'lien_acces_youtube'=>$request->get('link_youtube'),
            'statut'=>$statut,
        ]);

        if ($statut === "en attente de validation") {
            $autorisations = AutorisationSpeciale::all();

            $userstonotify = [];
            foreach ($autorisations as $autorisation) {
                $autorisations_speciales = json_decode($autorisation->autorisation_speciale);
                if ($autorisation->table_name === "articles") {
                    if (!is_null($autorisations_speciales)) {
                        if (in_array("peux valider", $autorisations_speciales)) {
                            $userstonotify[] = User::find($autorisation->user_id);
                        }
                    }
                }
            }

            $url = route('article.afficher_article', $article->id);

            if ($userstonotify) {
                $this->triggerNotification($article, 'App\Models\Articles', 'Demande de validation',
            "L'article titré : " . $article->titre . " est en attente de validation",
            $url, $userstonotify) ;
            }
        }

        return response()->json([
            'redirect' => route('article.list_des_articles'),
        ]);
    }

    public function afficher_article($article_id, Request $request):View
    {
        $autorisation = Autorisations::where('table_name', 'articles')->where('groupe_id', auth()->user()->groupe_utilisateur_id)->first();
        $autorisationspeciales = AutorisationSpeciale::where('table_name', 'articles')->where('user_id', auth()->user()->id)->first();
        $article = Articles::with(['departement', 'rapporteur_user'])->find($article_id);

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/article/list'), 'label'=>"Articles", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/article/afficher_article'), 'label'=>"Afficher", 'icon'=>'bi-eye fs-5'],
        ];
        $bibliothequephoto = json_decode($article->bibliotheque, true);

        $notification_id = $request->query('notification_id');
        //Si notification_id a été fournie, alors marqué la notification comme lue
        if ($notification_id) {
            $notification = auth()->user()->notifications()->find($notification_id);
            if ($notification) {
                $notification->markAsRead();
            }
        }else {

            //si pas de notification_id, chercher une notification liée à cet objet
            $notification = auth()->user()->unreadNotifications()
                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(data, '$.object_id')) COLLATE utf8_general_ci = ?", [$article_id])
                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(data, '$.object_type')) COLLATE utf8_general_ci = ?", get_class($article))->first();

            if ($notification) {
                $notification->markAsRead();
            }
        }

        return view('private_layouts.articles_folder.afficher_article', ['article'=>$article, 'current_user'=>auth()->user(),
        'autorisation'=>$autorisation, 'autorisation_speciale'=>$autorisationspeciales, "breadcrumbs"=>$breadcrumbs, "bibliothequephoto"=>$bibliothequephoto]);
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

            $autorisations = AutorisationSpeciale::all();
            $userstonotify = [];
            foreach ($autorisations as $autorisation) {
                $autorisations_speciales = json_decode($autorisation->autorisation_speciale);
                if ($autorisation->table_name === "articles") {
                    if (!is_null($autorisations_speciales)) {
                        if (in_array("peux valider", $autorisations_speciales)) {
                            $userstonotify[] = User::find($autorisation->user_id);
                        }
                    }
                }
            }

            $url = route('article.afficher_article', $article->id);

            if ($userstonotify) {
                $this->triggerNotification($article, 'App\Models\Articles', 'Demande de validation',
                "L'article titré : " . $article->titre . "est en attente de validation",
                $url, $userstonotify) ;
            }
        }elseif ($action === 'validation') {
            $article->statut = "validé";
            $article->update();

            try {
                $user = User::find($article->rapporteur_id);
                $userstonotify[] = $user;

                $url = route('article.afficher_article', $article->id);

                if ($userstonotify) {
                    $this->triggerNotification($article, 'App\Models\Articles', 'Validation',
                "Votre article titré : " . $article->titre . "a été validé",
                $url, $userstonotify) ;
                }
            } catch (\Exception $e) {
                return response()->json([
                    "error"=> $e->getMessage(),
                ]);
            }
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

        $breadcrumbs = [
            ['url'=>url('dashboard'), 'label'=>'Dashboard', 'icon'=>'bi-house fs-5'],
            ['url'=>url('/article/list'), 'label'=>"Articles", 'icon'=>'bi-list fs-5'],
            ['url'=>url('/article/afficher_article/'.$article_id), 'label'=>"Afficher", 'icon'=>'bi-eye fs-5'],
            ['url'=>url('/article/edit_article'), 'label'=>"Editer", 'icon'=>'bi-pencil-square fs-5'],
        ];
        return view('private_layouts.articles_folder.editer_un_article', ['article'=>$article,
        'current_user'=>$request->user(), 'autorisation'=>$autorisation, 'departements'=>$departements,
        "breadcrumbs"=>$breadcrumbs]);
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
            'description.required'=>'ce champs est obligatoire',
        ]);

        $article = Articles::find($article_id);

        $bibliotheque = [];

        $existing_photos = json_decode($article->bibliotheque, true) ?? [];

        if ($request->hasFile('galerie')) {
            foreach ($existing_photos as $photo) {
                if (Storage::disk('public')->exists($photo)) {
                    Storage::disk('public')->delete($photo);
                }
            }
            foreach ($request->file('galerie') as $file) {
                $path = $file->store('medias', 'public');
                $bibliotheque[] = $path;
            }

            $article->bibliotheque = json_encode($bibliotheque);
        }

        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('medias', 'public');
            if ($article->video){
                Storage::disk('public')->delete($article->video);
            }
            $article->video = $path;
        }else {
            if ($request->has("delete_video")) {
                Storage::disk('public')->delete($article->video);
                $article->video = null;
            }
        }

        $article->date = $request->get('date');
        $article->departement_id = $request->get('departement_id');
        $article->titre = $request->get('titre');
        $article->description = $request->get('description');

        $article->update();

        return response()->json([
            'redirect' => route('article.afficher_article', $article_id),
        ]);
    }
}
