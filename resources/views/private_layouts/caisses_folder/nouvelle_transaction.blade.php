@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#Caisse')
@section('content')
    <div class="py-12 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-3">
                <div class="max-w-xl">
                    <section>
                        <input id="caisse_id" value="{{ $caisse_id }}" style="visibility: hidden">
                        <form method="post" action="{{ route('caisses.save_transaction', $caisse_id) }}" class="mt-6 space-y-6">
                            @csrf
                            <h4 class="text-muted">Nouvelle Transaction</h4>
                            <div class="mt-3">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_date" class="text-muted">Date de la transaction</label>
                                    <input type="date" class="form-control" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" name="date_de_la_transaction" id="id_date">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('date_de_la_transaction')"/>
                                </div>
                            </div>
                            <div class="mb-3 mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_type_de_transaction" class="text-muted">Type de transaction</label>
                                    <select name="type_de_transaction" id="id_type_de_transaction" class="form-control p-2" required>
                                        <option selected disabled>------------</option>
                                        <option value="débit">Débit</option>
                                        <option value="crédit">Crédit</option>
                                    </select>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('type_de_mouvement')"/>
                                </div>
                            </div>
                            <div class="mb-3 mt-2" id="source_div" style="display: none">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_source" class="text-muted">Source du crédit</label>
                                    <input type="text" class="form-control" name="source" placeholder="source du crédit" id="id_source">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('source')"/>
                                </div>
                            </div>
                            <div id="motif_div" style="display: none" class="mb-0">
                                <div class="mb-3 mt-2">
                                    <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                        <label for="id_motif" class="text-muted">Motif du débit</label>
                                        <input type="text" class="form-control" name="motif" placeholder="motif du débit" id="id_motif">
                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('motif')"/>
                                    </div>
                                </div>
                                <div class="mb-3 mt-2">
                                    <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                        <label for="id_code" class="text-muted mb-0">Code de la dépense</label>
                                        <input type="text" class="form-control" name="code" id="id_code" placeholder="veuillez entrer le code de la dépense">
                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('code')"/>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                        <input id="input_departement_depense" name="departement_id" class="form-control" readonly>
                                    </div>
                                </div>

                                <label class="text-danger mb-0" id="message_error"></label><br>
                            </div>

                            <div class="mt-2">
                                <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                    <label for="id_montant" class="text-muted">Montant</label>
                                    <input type="number" class="form-control" step="any" name="montant" placeholder="montant" id="id_montant" readonly>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('montant')"/>
                                </div>
                            </div>

                            <button class="btn btn-primary mt-2 text-light" id="btn_submit" disabled>Soumettre</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset("assets/js/caisse_scripts/add_caisse_account.js") }}"></script>
@endsection

