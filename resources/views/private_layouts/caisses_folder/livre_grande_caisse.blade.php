@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Livre de la caisse')
@section('other_content')
    <div style="float:right">
        <a href="{{ route('caisses.add_new_caisse_account', $caisse_id) }}" class="btn btn-primary mb-2"><span style="color: white"> insérer</span></a>
    </div>
@endsection
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg shadow mb-3">
                <div class="max-w-xl">
                    <section>
                        <div class="tab-content" id="orders-table-tab-content">
                            <div class="tab-pane fade show active" id="orders-all" role="tabpanel"
                                 aria-labelledby="orders-all-tab">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body">
                                        <div class="table-responsive">
                                            <table class="table app-table-hover mb-0 text-left">
                                                <thead>
                                                <tr>
                                                    <th class="cell"><span style="font-weight: bold">ID</span></th>
                                                    <th class="cell"><span style="font-weight: bold">date</span>
                                                    </th>
                                                    <th class="cell"><span
                                                            style="font-weight: bold">type de mouvement</span></th>
                                                    <th class="cell"><span style="font-weight: bold">montant</span>
                                                    </th>
                                                    <th class="cell"><span style="font-weight: bold; color: darkblue">motif</span>
                                                    </th>
                                                    <th class="cell"><span style="font-weight: bold; color: darkgreen">source</span>
                                                    </th>
                                                    <th class="cell"><span>Code de la dépense</span></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($lignes_livre as $ligne)
                                                    <tr>
                                                        <td class="cell"><span style="font-weight: normal;">{{ $ligne->id }}</span>
                                                        </td>
                                                        <td class="cell">
                                                            <span style="font-weight: normal">
                                                                {{ $ligne->created_at->format('d-m-Y') }} à {{ $ligne->created_at->format('h:i') }}
                                                            </span>
                                                        </td>
                                                        <td class="cell">
                                                            <span style="font-weight: normal; color: #2e590b">
                                                                {{ $ligne->type_de_mouvement }}
                                                            </span>
                                                        </td>
                                                        <td class="cell">
                                                            <span style="font-weight: normal">
                                                                {{ $ligne->montant }} {{ $parametre_devise }}
                                                            </span>
                                                        </td>
                                                        <td class="cell">
                                                            <span style="font-weight: normal">
                                                                {{ $ligne->motif }}
                                                            </span>
                                                        </td>
                                                        <td class="cell">
                                                            <span style="font-weight: normal; color: darkgreen">
                                                                {{ $ligne->source }}
                                                            </span>
                                                        </td>
                                                        <td class="cell">
                                                            <span>
                                                                {{ $ligne->code_de_depense }}
                                                            </span>
                                                        </td>
                                                    </tr>
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

