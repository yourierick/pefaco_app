@extends('base_dashboard')
@section('titre', '#Gestion des utilisateurs')
@section('other_content')
    <a href="{{ route('register') }}" class="btn btn-primary mb-2" style="float:right"><span style="color: white"> Ajouter un utilisateur</span></a>
@endsection
@section("style")
    <style>
        * {
            font-size: 10pt;
        }
    </style>
@endsection
@section('content')
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <div class="tab-content" id="orders-table-tab-content">
                            <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                                 aria-labelledby="orders-all-tab">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body table-responsive p-4">
                                        <div>
                                            <table class="table table-striped w-100" id="multi-filter-select">
                                                <thead style="text-transform: uppercase; background-color: #0a5a97; color: whitesmoke">
                                                <tr>
                                                    <th style="color: whitesmoke; font-weight: normal">Nom</th>
                                                    <th style="color: whitesmoke; font-weight: normal">Sexe</th>
                                                    <th style="color: whitesmoke; font-weight: normal">Adresse</th>
                                                    <th style="color: whitesmoke; font-weight: normal">Email</th>
                                                    <th style="color: whitesmoke; font-weight: normal">Groupe</th>
                                                    <th style="color: whitesmoke; font-weight: normal">Statut</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th class="cell">nom</th>
                                                    <th class="cell">sexe</th>
                                                    <th class="cell">adresse</th>
                                                    <th class="cell">email</th>
                                                    <th class="cell">groupe</th>
                                                    <th class="cell">statut</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach($users as $user)
                                                    @if($user->id != $current_user->id || 1==1)
                                                        <tr>
                                                            <td style="font-weight: normal" class="cell">{{ $user -> nom }} {{ $user -> postnom }} {{ $user -> prenom }}</th>
                                                            <td style="font-weight: normal" class="cell">{{ $user -> sexe }}</th>
                                                            <td style="font-weight: normal" class="cell">{{ $user -> adresse }}</th>
                                                            <td style="font-weight: normal" class="cell">{{ $user -> email }}</th>
                                                            <td style="font-weight: normal" class="cell">{{ $user->groupe_utilisateur ? $user->groupe_utilisateur->groupe : ""}}</th>
                                                            <td style="font-weight: normal; font-size: 8pt!important; height: 10px!important" @class(["badge", "cell", "text-white", "bg-danger"=>$user->statut == 0, "bg-success"=>$user->statut == 1])>{{ $user->statut ? "actif": "désactivé" }}</td>
                                                            <td class="cell">
                                                                <a class="btn-sm app-btn-secondary" href="{{ route('manageprofile.edit_user', $user->id) }}">voir</a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div><!--//table-responsive-->
                                    </div><!--//app-card-body-->
                                </div><!--//app-card-->
                            </div><!--//tab-pane-->
                        </div><!--//tab-content-->
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
