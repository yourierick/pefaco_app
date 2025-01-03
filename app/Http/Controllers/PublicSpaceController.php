<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BulletinInfo;
use App\Models\ConfigurationGenerale;
use App\Models\messageEtCommentaire;
use App\Models\ProgrammeDuPasteur;
use App\Models\Communique;
use App\Models\Articles;
use App\Models\Annonce;
use App\Models\Membre;
use App\Models\Enseignement;
use App\Models\ProgrammeDeCulte;
use App\Models\CommentaireArticles;
use App\Models\CommentaireArticlesChild;
use App\Models\CommentEnseign;
use App\Models\ChildCommentens;



class PublicSpaceController extends Controller
{
    public function home()
    {
        $parametres = ConfigurationGenerale::first();
        $programmedeculte = ProgrammeDeCulte::all();
        $programmedupasteur = ProgrammeDuPasteur::all();
        $articles = Articles::where('statut', 'validé')->where('audience', 'public')->orderBy('id', 'desc')->get();
        $lastest_articles = [];
        $latestarticle = $articles->first();
        for ($i = 1; $i < $articles->count(); $i++) {
            if ($i < 3) {
                $lastest_articles[] = $articles[$i];
            }else {
                break;
            }
        }
        $articles = $lastest_articles;
        $annonces = Annonce::where('statut', 'validé')->where('audience', 'public')->orderBy('id', 'desc')->get();
        $communiques = Communique::with('communiquant')->where('audience', 'public')->orderBy('id', 'desc')->get();
        $serviteurs = Membre::where('statut', 'serviteur')->where('etat', 'en service')->get();
        $enseignements = Enseignement::with('auteur')->where('statut', 'validé')->where('audience', 'public')->orderBy('id', 'desc')->get();
        $latestenseignements = [];
        for ($i = 0; $i < $enseignements->count(); $i++) {
            if ($i < 3) {
                $latestenseignements[] = $enseignements[$i];
            }else {
                break;
            }
        }

        $enseignements = $latestenseignements;
        
        return view('public_layouts.index', compact('parametres', 'programmedeculte', 'enseignements',
        'programmedupasteur', 'articles', 'latestarticle', 'annonces', 'communiques', 'serviteurs'));
    }

    public function subscribeToNewsLetter(Request $request) {
        $request->validate([
            'email'=>['required'],
        ]);

        $scan = BulletinInfo::where('email', $request->get('email'))->get();
        if (!$scan->isEmpty()) {
            return redirect()->back()->with('error', "cette adresse mail est déjà inscrite au bulletin d'information");
        }else {
            $subscriber = BulletinInfo::create([
                'email'=>$request->get('email'),
            ]);
        }

        return redirect()->back()->with('success', 'merci pour votre souscription');
    }

    public function messageEtCommentaire(Request $request) {
        $request->validate([
            'email'=>['required'],
            'nom'=>['required'],
            'telephone'=>['required'],
            'message'=>['required'],
        ]);

        $message_commentaire = messageEtCommentaire::create([
            'email'=>$request->get('email'),
            'nom'=>$request->get('nom'),
            'telephone'=>$request->get('telephone'),
            'message'=>$request->get('message'),
        ]);

        $message = "merci pour votre message";

        return redirect()->back()->with('success', $message);
    }

    public function afficher_article($article_id) {
        $parametres = ConfigurationGenerale::first();
        $article = Articles::with(['commentaires.commentairechildren', 'rapporteur_user'])->find($article_id);
        $bibliothequephoto = json_decode($article->bibliotheque);
        $programmedeculte = ProgrammeDeCulte::all();
        return view('public_layouts.articles.afficher_article', compact('article', 'bibliothequephoto', 'parametres', 'programmedeculte'));
    }

    public function save_commentaire_article($article_id, Request $request)
    {
        $request->validate([
            'commentaire'=>['required'],
        ]);

        $commentaire = CommentaireArticles::create([
            'articles_id'=>$article_id,
            'commentaire'=>$request->get('commentaire'),
        ]);

        return redirect()->back();
    }

    public function supprimer_commentaire_article($comment_id)
    {
        $commentaire = CommentaireArticles::find($comment_id);
        $commentaire->delete();

        return redirect()->back();
    }

    public function save_commentairechild_article($commentparent_id, Request $request)
    {
        $request->validate([
            'commentaire'=>['required'],
        ]);

        $commentaire = CommentaireArticlesChild::create([
            'commentaire_articles_id'=>$commentparent_id,
            'commentaire'=>$request->get('commentaire'),
        ]);

        return redirect()->back();
    }

    public function supprimer_commentairechild_article($commentchild_id)
    {
        $commentaire = CommentaireArticlesChild::find($commentchild_id);
        $commentaire->delete();

        return redirect()->back();
    }

    public function likeordislikearticle($article_id, Request $request) {
        $action = $request->get('action');
        $article = Articles::find($article_id);
        if ($action === "liker") {
            $article->like += 1;
        }elseif ($action === "disliker") {
            $article->dislike += 1;
        }
        
        $article->update();
        $countlike = $article->like;
        $countdislike = $article->dislike;
        
        return response()->json(["likes"=>$countlike, "dislikes"=>$countdislike]);
    }


    public function list_des_articles() {
        $articles = Articles::orderBy('id', 'desc')->paginate(3);
        $parametres = ConfigurationGenerale::first();
        $programmedeculte = ProgrammeDeCulte::all();
        return view('public_layouts.articles.list_articles', compact('articles', 'parametres', 'programmedeculte'));
    }


    //---------------------------- ENSEIGNEMENT ------------------------------------- //

    public function afficher_enseignement($enseignement_id) {
        $parametres = ConfigurationGenerale::first();
        $enseignement = Enseignement::with(['commentaires.commentaire_child', 'auteur'])->find($enseignement_id);
        $programmedeculte = ProgrammeDeCulte::all();
        return view('public_layouts.enseignements.afficher_enseignement', compact('enseignement', 'parametres', 'programmedeculte'));
    }

    public function save_commentaire_enseignement($enseignement_id, Request $request)
    {
        $request->validate([
            'commentaire'=>['required'],
        ]);

        $commentaire = CommentEnseign::create([
            'enseignement_id'=>$enseignement_id,
            'commentaire'=>$request->get('commentaire'),
        ]);

        return redirect()->back();
    }

    public function supprimer_commentaire_enseignement($comment_id)
    {
        $commentaire = CommentEnseign::find($comment_id);
        $commentaire->delete();

        return redirect()->back();
    }

    public function save_commentairechild_enseignement($commentparent_id, Request $request)
    {
        $request->validate([
            'commentaire'=>['required'],
        ]);

        $commentaire = ChildCommentens::create([
            'comment_enseign_id'=>$commentparent_id,
            'commentaire'=>$request->get('commentaire'),
        ]);

        return redirect()->back();
    }

    public function supprimer_commentairechild_enseignement($commentchild_id)
    {
        $commentaire = ChildCommentens::find($commentchild_id);
        $commentaire->delete();

        return redirect()->back();
    }

    public function likeordislikeenseignement($enseignement_id, Request $request) {
        $action = $request->get('action');
        $enseignement = Enseignement::find($enseignement_id);
        if ($action === "liker") {
            $enseignement->like += 1;
        }elseif ($action === "disliker") {
            $enseignement->dislike += 1;
        }
        
        $enseignement->update();
        $countlike = $enseignement->like;
        $countdislike = $enseignement->dislike;
        
        return response()->json(["likes"=>$countlike, "dislikes"=>$countdislike]);
    }


    public function list_des_enseignements() {
        $enseignements = Enseignement::orderBy('id', 'desc')->paginate(3);
        $parametres = ConfigurationGenerale::first();
        $programmedeculte = ProgrammeDeCulte::all();
        return view('public_layouts.enseignements.list_enseignements', compact('enseignements', 'parametres', 'programmedeculte'));
    }

}
