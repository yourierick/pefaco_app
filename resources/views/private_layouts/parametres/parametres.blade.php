@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('content')
    <div class="modal fade" id='modaldeleteparoisse'>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h5 text-center " id="exampleModalCenteredScrollableTitle">
                        Demande de confirmation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">Voulez-vous vraiment supprimer cette paroisse ?</p>
                    <div class="w-100 fw-normal">
                        <form method="post" action="{{ route('parametres.supprimer_paroisse') }}">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="paroisse_id" id="id_paroisse">
                            <button type="submit" class="btn btn-danger text-light" style="font-weight: normal">
                                Oui je le veux
                            </button>
                            <button class="btn btn-primary text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id='modaldeletedepartement'>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h5 text-center " id="exampleModalCenteredScrollableTitle">
                        Demande de confirmation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">Voulez-vous vraiment supprimer ce département ?</p>
                    <div class="w-100 fw-normal">
                        <form method="post" action="{{ route('parametres.supprimer_departement') }}">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="departement_id" id="id_departement">
                            <button type="submit" class="btn btn-danger text-light" style="font-weight: normal">
                                Oui je le veux
                            </button>
                            <button class="btn btn-primary text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id='modaldeletequalite'>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h5 text-center " id="exampleModalCenteredScrollableTitle">
                        Demande de confirmation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">Voulez-vous vraiment supprimer cette qualité ?</p>
                    <div class="w-100 fw-normal">
                        <form method="post" action="{{ route('parametres.supprimer_qualite') }}">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="qualite_id" id="id_qualite">
                            <button type="submit" class="btn btn-danger text-light" style="font-weight: normal">
                                Oui je le veux
                            </button>
                            <button class="btn btn-primary text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id='modaldeletezone'>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h5 text-center " id="exampleModalCenteredScrollableTitle">
                        Demande de confirmation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">Voulez-vous vraiment supprimer cette zone ?</p>
                    <div class="w-100 fw-normal">
                        <form method="post" action="{{ route('parametres.supprimer_zone') }}">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="zone_id" id="id_zone">
                            <button type="submit" class="btn btn-danger text-light" style="font-weight: normal">
                                Oui je le veux
                            </button>
                            <button class="btn btn-primary text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id='modaldeleteprogrammedeculte'>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h5 text-center " id="exampleModalCenteredScrollableTitle">
                        Demande de confirmation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">Voulez-vous vraiment supprimer ce programme ?</p>
                    <div class="w-100 fw-normal">
                        <form method="post" action="{{ route('parametres.supprimer_programmeculte') }}">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="programmedeculte_id" id="id_programmedeculte">
                            <button type="submit" class="btn btn-danger text-light" style="font-weight: normal">
                                Oui je le veux
                            </button>
                            <button class="btn btn-primary text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id='modaldeleteprogrammedupasteur'>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h5 text-center " id="exampleModalCenteredScrollableTitle">
                        Demande de confirmation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">Voulez-vous vraiment supprimer ce programme ?</p>
                    <div class="w-100 fw-normal">
                        <form method="post" action="{{ route('parametres.supprimer_programmedupasteur') }}">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="programmedupasteur_id" id="id_programmedupasteur">
                            <button type="submit" class="btn btn-danger text-light" style="font-weight: normal">
                                Oui je le veux
                            </button>
                            <button class="btn btn-primary text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-xl">
            <h1 class="app-page-title">Paramètres</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Général</h3>
                    <div class="section-intro">Gestion des informations statiques générales du site public</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <form class="settings-form" action="{{ route('parametres.save_configuration_generale') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label  class="form-label">Logo
                                        <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info.">
                                            <svg
                                                width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                                <circle cx="8" cy="4.5" r="1"/>
                                            </svg>
                                        </span>
                                    </label>
                                    <input class="form-control" type="file" name="logo" id="id_logo" value="{{ old('logo', $configuration_generale ? $configuration_generale->logo: "") }}">
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('logo')"/>
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Nom de l'église
                                        <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info.">
                                            <svg
                                                width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                                <circle cx="8" cy="4.5" r="1"/>
                                            </svg>
                                        </span>
                                    </label>
                                    <input class="form-control" type="text" name="nom_eglise" id="id_nom_eglise" value="{{ old('nom_eglise', $configuration_generale ? $configuration_generale->nom_eglise: "") }}" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('nom_eglise')"/>
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Localisation
                                        <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info.">
                                            <svg
                                                width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                                <circle cx="8" cy="4.5" r="1"/>
                                            </svg>
                                        </span>
                                    </label>
                                    <input class="form-control" type="text" name="localisation" id="id_localisation" value="{{ old('localisation', $configuration_generale ? $configuration_generale->localisation: "") }}" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('localisation')"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email
                                        <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info.">
                                            <svg
                                                width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                                <circle cx="8" cy="4.5" r="1"/>
                                            </svg>
                                        </span>
                                    </label>
                                    <input class="form-control" type="text" name="email" id="id_email" value="{{ old('email', $configuration_generale ? $configuration_generale->email: "") }}" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('email')"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Contacts
                                        <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info.">
                                            <svg
                                                width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                                <circle cx="8" cy="4.5" r="1"/>
                                            </svg>
                                        </span>
                                    </label>
                                    <input class="form-control" type="text" name="contacts" id="id_contacts" value="{{ old('contacts', $configuration_generale ? $configuration_generale->contacts: "") }}" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('contacts')"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Pourcentage de l'église sur les cotisations
                                        <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info.">
                                            <svg
                                                width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                                <circle cx="8" cy="4.5" r="1"/>
                                            </svg>
                                        </span>
                                    </label>
                                    <input class="form-control" type="number" step="any" name="pourcentage_eglise" id="id_pourcentage_eglise" value="{{ old('pourcentage_eglise', $configuration_generale ? $configuration_generale->pourcentage_eglise: "") }}" required>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('pourcentage_eglise')"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Dévise
                                        <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info.">
                                            <svg
                                                width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                                <circle cx="8" cy="4.5" r="1"/>
                                            </svg>
                                        </span>
                                    </label>
                                    <select name="devise" id="id_devise" class="form-control">
                                        <option @if(($configuration_generale ? $configuration_generale->devise: "") === "FC (Francs congolais)") selected @endif value="FC (Francs congolais)">FC (Francs congolais)</option>
                                        <option @if(($configuration_generale ? $configuration_generale->devise: "") === "$ (Dollars)") selected @endif value="$ (Dollars)">$ (Dollars)</option>
                                        <option @if(($configuration_generale ? $configuration_generale->devise: "") === "£ (Euros)") selected @endif value="£ (Euros)">£ (Euros)</option>
                                    </select>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('devise')"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">A propos de nous
                                        <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info.">
                                            <svg
                                                width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                                <circle cx="8" cy="4.5" r="1"/>
                                            </svg>
                                        </span>
                                    </label>
                                    <textarea class="form-control" id="id_propos_de_nous" name="a_propos_de_nous" required>{{ old('a_propos_de_nous', $configuration_generale ? $configuration_generale->a_propos_de_nous : "") }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('a_propos_de_nous')"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Historique
                                        <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info.">
                                            <svg
                                                width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                                <circle cx="8" cy="4.5" r="1"/>
                                            </svg>
                                        </span>
                                    </label>
                                    <textarea class="form-control"  name="historique" id="id_historique" required>{{ old('historique', $configuration_generale ? $configuration_generale->historique: "") }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('historique')"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Notre mission
                                        <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info.">
                                            <svg
                                                width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                                <circle cx="8" cy="4.5" r="1"/>
                                            </svg>
                                        </span>
                                    </label>
                                    <textarea class="form-control" id="id_notre_mission" name="notre_mission" required>{{ old('notre_mission', $configuration_generale ? $configuration_generale->notre_mission: "") }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('notre_mission')"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Notre vision
                                        <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info.">
                                            <svg
                                                width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                                <circle cx="8" cy="4.5" r="1"/>
                                            </svg>
                                        </span>
                                    </label>
                                    <textarea class="form-control" id="id_notre_vision" name="notre_vision" required>{{ old('notre_vision', $configuration_generale ? $configuration_generale->notre_vision: "") }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('notre_vision')"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Notre communauté
                                        <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info.">
                                            <svg
                                                width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                                <circle cx="8" cy="4.5" r="1"/>
                                            </svg>
                                        </span>
                                    </label>
                                    <textarea class="form-control" id="id_notre_communaute" name="notre_communaute" required>{{ old('notre_communaute', $configuration_generale ? $configuration_generale->notre_communaute: "") }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('notre_communaute')"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Pasteur responsable
                                        <span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info.">
                                            <svg
                                                width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z"/>
                                                <circle cx="8" cy="4.5" r="1"/>
                                            </svg>
                                        </span>
                                    </label>
                                    <textarea type="text" name="pasteur_responsable" class="form-control" id="id_pasteur_responsable" required>{{ old('pasteur_responsable', $configuration_generale ? $configuration_generale->pasteur_responsable: "") }}</textarea>
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('pasteur_responsable')"/>
                                </div>
                                
                                <button type="submit" class="btn btn-primary text-light" style="font-weight: normal">Enregistrer les modifications</button>
                            </form>
                        </div><!--//app-card-body-->

                    </div><!--//app-card-->
                </div>
            </div><!--//row-->

            <hr class="my-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Configurations des départements</h3>
                    <div class="section-intro">CRUD des départements</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <div class="d-flex row">
                                <div class="col-7"><h4>Départements</h4></div>
                                <div class="col-5"><a href="#" style="float: right" class="btn text-secondary" data-bs-target="#modal-add-departement" data-bs-toggle="modal"><span class="bi-plus-circle-fill text-info"></span> ajouter un département</a></div>
                            </div>
                            <div class="modal fade" id='modal-add-departement'>
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title h5 text-center " id="exampleModalCenteredScrollableTitle">
                                                Ajouter un département
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="w-100 fw-normal">
                                                <form method="post" action="{{ route('parametres.ajouter_departement') }}">
                                                    @csrf
                                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('departement')"/>
                                                    <div class="d-flex gap-2">
                                                        <input type="text" class="form-control" placeholder="désignation" name="designation" id="id_designation">
                                                        <button type="submit" class="btn btn-info text-light" style="font-weight: normal">
                                                            Ajouter
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table-sm table-striped w-100" id="multi-filter-select">
                                <thead>
                                    <tr>
                                        <th class="cell">N°</th>
                                        <th class="cell">Désignation</th>
                                        <th class="cell"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($departements as $departement)
                                        <tr>
                                            @if ($departement->designation !== "comité provincial" && $departement->designation !== "comité des mamans" && 
                                                        $departement->designation !== "comité des papas" && $departement->designation !== "comité des jeunes" && 
                                                        $departement->designation !== "ecodim" && $departement->designation !== "comité de soutien" && 
                                                        $departement->designation !== "comité d'assistance et vie sociale" && $departement->designation !== "protocole" && 
                                                        $departement->designation !== "coordination provinciale")
                                                <form action="{{ route('parametres.editer_departement') }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <td><input type="hidden" name="id" class="form-control" style="border: none; background: transparent" value="{{ $loop->iteration }}">{{ $loop->iteration }}</td>
                                                    <td style="font-size: 0!important"><input type="text" name="designation" value="{{ $departement->designation }}" class="form-control" style="border: none; background: transparent">{{ $departement->designation }}</td>
                                                    <td class="d-flex">
                                                        <button type="submit" class="btn"><span class="bi-pencil-square text-info"></span></button>
                                                        <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modaldeletedepartement" data-role="{{ $departement->id }}" onclick="loadiddepartement(this)"><span class="bi-trash-fill text-danger"></span></a>
                                                    </td>
                                                </form>
                                            @else
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $departement->designation }}</td>
                                                <td class="d-flex"></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div>
            </div><!--//row-->

            <hr class="my-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Configurations des zones</h3>
                    <div class="section-intro">CRUD des zones</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <div class="d-flex row">
                                <div class="col-8"><h4>Zones</h4></div>
                                <div class="col-4"><a href="#" style="float: right" class="btn text-secondary" data-bs-target="#modal-add-zone" data-bs-toggle="modal"><span class="bi-plus-circle-fill text-info"></span> ajouter une zone</a></div>
                            </div>
                            <div class="modal fade" id='modal-add-zone'>
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title h5 text-center " id="exampleModalCenteredScrollableTitle">
                                                Ajouter une zone
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="w-100 fw-normal">
                                                <form method="post" action="{{ route('parametres.ajouter_zone') }}">
                                                    @csrf
                                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('zone')"/>
                                                    <div class="d-flex gap-2">
                                                        <input type="text" class="form-control" placeholder="désignation" name="designation">
                                                        <button type="submit" class="btn btn-info text-light" style="font-weight: normal" title="ajouter ce groupe d'utilisateur">
                                                            Ajouter
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table-sm table-striped w-100" id="multi-filter-select3">
                                    <thead>
                                        <tr>
                                            <th class="cell">N°</th>
                                            <th class="cell">Désignation</th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($zones as $zone)
                                            <tr>
                                                <form action="{{ route('parametres.editer_zone') }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <td><input type="hidden" name="id" value="{{ $zone->id }}" style="border: none; background: transparent">{{ $loop->iteration }}</td>
                                                    <td style="font-size: 0!important"><input type="text" name="designation" class="form-control" style="border: none; background: transparent" value="{{ $zone->designation }}">{{ $zone->designation }}</td>
                                                    <td class="d-flex">
                                                        <button type="submit" class="btn"><span class="bi-pencil-square text-info"></span></button>
                                                        <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modaldeletezone" data-role="{{ $zone->id }}" onclick="loadidzone(this)"><span class="bi-trash-fill text-danger"></span></a>
                                                    </td>
                                                </form>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div>
            </div><!--//row-->

            <hr class="my-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Configurations des paroisses</h3>
                    <div class="section-intro">CRUD des paroisses</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <div class="d-flex row">
                                <div class="col-7"><h4>Paroisses</h4></div>
                                <div class="col-5"><a href="#" style="float: right" class="btn text-secondary" data-bs-target="#modal-add-paroisse" data-bs-toggle="modal"><span class="bi-plus-circle-fill text-info"></span> ajouter une paroisse</a></div>
                            </div>
                            <div class="modal fade" id='modal-add-paroisse'>
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title h5 text-center " id="exampleModalCenteredScrollableTitle">
                                                Ajouter une paroisse
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="w-100 fw-normal">
                                                <form method="post" action="{{ route('parametres.ajouter_paroisse') }}">
                                                    @csrf
                                                    <div class="d-flex gap-2">
                                                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                                            <label>zone</label>
                                                            <select name="zone_id" class="form-control">
                                                                @foreach($zones as $zone)
                                                                    <option value="{{ old('zone_id', $zone->id) }}">{{ $zone->designation }}</option>
                                                                @endforeach
                                                            </select>
                                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('zone_id')"/>
                                                        </div>
                                                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                                            <label for="id_designation">désignation</label>
                                                            <input type="text" class="form-control" placeholder="désignation" name="designation" id="id_designation">
                                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('designation')"/>
                                                        </div>
                                                    
                                                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                                            <label for="id_localisation">localisation</label>
                                                            <input type="text" class="form-control" placeholder="localisation" name="localisation" id="id_localisation">
                                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('localisation')"/>
                                                        </div>
                                                        
                                                        <button type="submit" class="btn btn-info text-light mb-3" style="font-weight: normal">
                                                            Ajouter
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table-sm table-striped w-100" id="multi-filter-select2">
                                    <thead>
                                        <tr>
                                            <th class="cell">N°</th>
                                            <th class="cell">Zone</th>
                                            <th class="cell">Paroisse</th>
                                            <th class="cell">Localisation</th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($paroisses as $paroisse)
                                            <tr>
                                                <form action="{{ route('parametres.editer_paroisse') }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <td><input class="form-control" style="border: none; background: transparent" type="hidden" name="id" value="{{ $paroisse->id }}">{{ $loop->iteration }}</td>
                                                    <td style="font-size: 0!important">
                                                        <select name="zone_id" style="border: none; background: transparent" class="form-control">
                                                            @foreach($zones as $zone)
                                                                <option @if ($zone->id == $paroisse->zones_id) selected @endif value="{{ $zone->id }}">{{ $zone->designation }}</option>
                                                            @endforeach
                                                        </select>
                                                        {{ $paroisse->zone->designation }}    
                                                    </td>
                                                    <td style="font-size: 0!important"><input class="form-control" style="border: none; background: transparent" type="text" name="designation" value="{{ $paroisse->designation }}">{{ $paroisse->designation }}</td>
                                                    <td style="font-size: 0!important"><input class="form-control" style="border: none; background: transparent" type="text" name="localisation" value="{{ $paroisse->localisation }}">{{ $paroisse->localisation }}</td>
                                                    <td class="d-flex">
                                                        <button type="submit" class="btn"><span class="bi-pencil-square text-info"></span></button>
                                                        <a href="#" class="btn" data-bs-target="#modaldeleteparoisse" data-bs-toggle="modal" data-role="{{ $paroisse->id }}" onclick="loadidparoisse(this)"><span class="bi-trash-fill text-danger"></span></a>
                                                    </td>
                                                </form>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div>
            </div><!--//row-->

            <hr class="my-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Configurations des qualités</h3>
                    <div class="section-intro">CRUD des qualités</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <div class="d-flex row">
                                <div class="col-7"><h4>Qualités</h4></div>
                                <div class="col-5"><a href="#" style="float: right; font-weight: normal" class="btn text-secondary" data-bs-target="#modal-add-qualite" data-bs-toggle="modal"><span class="bi-plus-circle-fill text-info"></span> ajouter une qualité</a></div>
                            </div>
                            <div class="modal fade" id='modal-add-qualite'>
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title h5 text-center " id="exampleModalCenteredScrollableTitle">
                                                Ajouter une qualité
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="w-100 fw-normal">
                                                <form method="post" action="{{ route('parametres.ajouter_qualite') }}">
                                                    @csrf
                                                    <div class="d-flex gap-2">
                                                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                                            <label for="id_departement">département</label>
                                                            <select name="departement_id" id="id_departement" class="form-control">
                                                                @foreach($departements as $departement)
                                                                    <option value="{{ old('departement_id', $departement->id) }}">{{ $departement->designation }}</option>
                                                                @endforeach
                                                            </select>
                                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('departement_id')"/>
                                                        </div>
                                                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                                            <label for="id_designation">désignation</label>
                                                            <input type="text" class="form-control" placeholder="désignation" name="designation" id="id_designation">
                                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('designation')"/>
                                                        </div>
                                                        
                                                        <button type="submit" class="btn btn-info text-light mb-3" style="font-weight: normal">
                                                            Ajouter
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table-sm table-striped w-100" id="multi-filter-select4">
                                <thead>
                                    <tr>
                                        <th class="cell">N°</th>
                                        <th class="cell">Département</th>
                                        <th class="cell">Désignation</th>
                                        <th class="cell"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($qualites as $qualite)
                                        <tr>
                                            <form action="{{ route('parametres.editer_qualite') }}" method="post">
                                                @csrf
                                                @method('put')
                                                <td><input type="hidden" name="id" class="form-control" style="border: none; background: transparent" value="{{ $qualite->id }}">{{ $loop->iteration }}</td>
                                                <td style="font-size: 0!important"><input type="text" name="departement_id" value="{{ $qualite->departement_id }}" class="form-control" style="border: none; background: transparent">{{ $qualite->departement->designation }}</td>
                                                <td style="font-size: 0!important"><input type="text" name="designation" value="{{ $qualite->designation }}" class="form-control" style="border: none; background: transparent">{{ $qualite->designation }}</td>
                                                <td class="d-flex">
                                                    <button type="submit" class="btn"><span class="bi-pencil-square text-info"></span></button>
                                                    <a href="#" class="btn" data-bs-target="#modaldeletequalite" data-bs-toggle="modal" data-role="{{ $qualite->id }}" onclick="loadidqualite(this)"><span class="bi-trash-fill text-danger"></span></a>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div>
            </div><!--//row-->

            <hr class="my-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Configurations des Programmes</h3>
                    <div class="section-intro">CRUD des programmes de culte</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <div class="d-flex row">
                                <div class="col-7"><h5>Programme de culte</h5></div>
                                <div class="col-5"><a href="#" style="float: right; font-weight: normal" class="btn text-secondary" data-bs-target="#modal-add-programmedeculte" data-bs-toggle="modal"><span class="bi-plus-circle-fill text-info"></span> ajouter un programme</a></div>
                            </div>
                            <div class="modal fade" id='modal-add-programmedeculte'>
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title h5 text-center " id="exampleModalCenteredScrollableTitle">
                                                Ajouter un programme
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="w-100 fw-normal">
                                                <form method="post" action="{{ route('parametres.ajouter_programmeculte') }}">
                                                    @csrf
                                                    <div class="d-flex gap-2">
                                                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                                            <label for="id_jour">jour</label>
                                                            <select name="jour" id="id_jour" class="form-control">
                                                                <option value="{{ old('jour', "Lundi") }}">Lundi</option>
                                                                <option value="{{ old('jour', "Mardi") }}">Mardi</option>
                                                                <option value="{{ old('jour', "Mercredi") }}">Mercredi</option>
                                                                <option value="{{ old('jour', "Jeudi") }}">Jeudi</option>
                                                                <option value="{{ old('jour', "Vendredi") }}">Vendredi</option>
                                                                <option value="{{ old('jour', "Samedi") }}">Samedi</option>
                                                                <option value="{{ old('jour', "Dimanche") }}">Dimanche</option>
                                                                <option value="{{ old('jour', "Tous les jours") }}">Tous les jours</option>
                                                                <option value="{{ old('jour', "Du lundi au samedi") }}">Du lundi au samedi</option>
                                                            </select>
                                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('jour')"/>
                                                        </div>
                                                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                                            <label for="id_interval_de_temps">désignation</label>
                                                            <input type="text" class="form-control" placeholder="interval de temps" name="interval_de_temps" id="id_interval_de_temps">
                                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('interval_de_temps')"/>
                                                        </div>

                                                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                                            <label for="id_designation">désignation</label>
                                                            <input type="text" class="form-control" placeholder="programme" name="programme" id="id_programme">
                                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('programme')"/>
                                                        </div>
                                                        
                                                        <button type="submit" class="btn btn-info text-light mb-3" style="font-weight: normal">
                                                            Ajouter
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table-sm table-striped w-100" id="multi-filter-select5">
                                <thead>
                                    <tr>
                                        <th class="cell">N°</th>
                                        <th class="cell">Jour</th>
                                        <th class="cell">Programme</th>
                                        <th class="cell">Interval de temps</th>
                                        <th class="cell"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($programmedeculte as $programme)
                                        <tr>
                                            <form action="{{ route('parametres.editer_programmeculte') }}" method="post">
                                                @csrf
                                                @method('put')
                                                <td><input type="hidden" name="id" class="form-control" style="border: none; background: transparent" value="{{ $programme->id }}">{{ $loop->iteration }}</td>
                                                <td style="font-size: 0!important"><input type="text" name="jour" value="{{ $programme->jour }}" class="form-control" style="border: none; background: transparent">{{ $programme->jour }}</td>
                                                <td style="font-size: 0!important"><input type="text" name="interval_de_temps" value="{{ $programme->interval_de_temps }}" class="form-control" style="border: none; background: transparent">{{ $programme->interval_de_temps }}</td>
                                                <td style="font-size: 0!important"><input type="text" name="programme" value="{{ $programme->programme }}" class="form-control" style="border: none; background: transparent">{{ $programme->programme }}</td>
                                                <td class="d-flex">
                                                    <button type="submit" class="btn"><span class="bi-pencil-square text-info"></span></button>
                                                    <a href="#" class="btn" data-bs-target="#modaldeleteprogrammedeculte" data-bs-toggle="modal" data-role="{{ $programme->id }}" onclick="loadidprogrammedeculte(this)"><span class="bi-trash-fill text-danger"></span></a>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div>
            </div><!--//row-->

            <hr class="my-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Disponibilité du pasteur</h3>
                    <div class="section-intro">CRUD des programmes du pasteur</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <div class="d-flex row">
                                <div class="col-7"><h5>Programme de disponibilité du pasteur</h5></div>
                                <div class="col-5"><a href="#" style="float: right; font-weight: normal" class="btn text-secondary" data-bs-target="#modal-add-programmedupasteur" data-bs-toggle="modal"><span class="bi-plus-circle-fill text-info"></span> ajouter un programme</a></div>
                            </div>
                            <div class="modal fade" id='modal-add-programmedupasteur'>
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title h5 text-center " id="exampleModalCenteredScrollableTitle">
                                                Ajouter un programme
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="w-100 fw-normal">
                                                <form method="post" action="{{ route('parametres.ajouter_programmedupasteur') }}">
                                                    @csrf
                                                    <div class="d-flex gap-2">
                                                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                                            <label for="id_jour">jour</label>
                                                            <select name="jour" id="id_jour" class="form-control">
                                                                <option value="{{ old('jour', "Lundi") }}">Lundi</option>
                                                                <option value="{{ old('jour', "Mardi") }}">Mardi</option>
                                                                <option value="{{ old('jour', "Mercredi") }}">Mercredi</option>
                                                                <option value="{{ old('jour', "Jeudi") }}">Jeudi</option>
                                                                <option value="{{ old('jour', "Vendredi") }}">Vendredi</option>
                                                                <option value="{{ old('jour', "Samedi") }}">Samedi</option>
                                                                <option value="{{ old('jour', "Dimanche") }}">Dimanche</option>
                                                                <option value="{{ old('jour', "Tous les jours") }}">Tous les jours</option>
                                                                <option value="{{ old('jour', "Du lundi au samedi") }}">Du lundi au samedi</option>
                                                            </select>
                                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('jour')"/>
                                                        </div>
                                                        <div class="form-group-kaiadmin form-group-default-kaiadmin">
                                                            <label for="id_interval_de_temps">interval de temps</label>
                                                            <input type="text" class="form-control" placeholder="De 00:00 - 00:00" name="interval_de_temps" id="id_interval_de_temps">
                                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('interval_de_temps')"/>
                                                        </div>
                                                        
                                                        <button type="submit" class="btn btn-info text-light mb-3" style="font-weight: normal">
                                                            Ajouter
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table-sm table-striped w-100" id="multi-filter-select6">
                                <thead>
                                    <tr>
                                        <th class="cell">N°</th>
                                        <th class="cell">Jour</th>
                                        <th class="cell">Interval de temps</th>
                                        <th class="cell"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($programmedupasteur as $programme)
                                        <tr>
                                            <form action="{{ route('parametres.editer_programmedupasteur') }}" method="post">
                                                @csrf
                                                @method('put')
                                                <td><input type="hidden" name="id" class="form-control" style="border: none; background: transparent" value="{{ $programme->id }}">{{ $loop->iteration }}</td>
                                                <td style="font-size: 0!important"><input type="text" name="jour" value="{{ $programme->jour }}" class="form-control" style="border: none; background: transparent">{{ $programme->jour }}</td>
                                                <td style="font-size: 0!important"><input type="text" name="interval_de_temps" value="{{ $programme->interval_de_temps }}" class="form-control" style="border: none; background: transparent">{{ $programme->interval_de_temps }}</td>
                                                <td class="d-flex">
                                                    <button type="submit" class="btn"><span class="bi-pencil-square text-info"></span></button>
                                                    <a href="#" class="btn" data-bs-target="#modaldeleteprogrammedupasteur" data-bs-toggle="modal" data-role="{{ $programme->id }}" onclick="loadidprogrammedupasteur(this)"><span class="bi-trash-fill text-danger"></span></a>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div>
            </div><!--//row-->

            <hr class="my-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Droits et permissions des utilisateurs</h3>
                    <div class="section-intro">Contrôler et gérer les droits et permissions des utilisateurs dans cette section
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">

                        <div class="app-card-body table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">N°</th>
                                        <th class="cell">Groupe utilisateurs</th>
                                        <th class="cell" style="text-align: right">
                                            <div class="col-auto">
                                                <a href="#" class="btn-sm app-text-primary" data-bs-toggle="modal"  data-bs-target='#modal'><i class='bx bxs-plus-circle' style="font-size: 11pt"><span style="font-size: 10pt; vertical-align: top">ajouter un groupe</span></i></a>
                                                <div class="modal fade" id='modal'>
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title h5 text-center " id="exampleModalCenteredScrollableTitle">
                                                                    Ajout d'un groupe d'utilisateur
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="w-100 fw-normal">
                                                                    <form method="post" action="{{ route('parametres.add_users_group') }}">
                                                                        @csrf
                                                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('groupe')"/>
                                                                        <div class="d-flex gap-2">
                                                                            <input class="form-control" placeholder="entrez la désignation du groupe" name="groupe" type="text">
                                                                            <button type="submit" class="btn btn-info text-light" style="font-weight: normal" title="ajouter ce groupe d'utilisateur">
                                                                                Ajouter
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-danger text-light" style="font-weight: normal" type="button" data-bs-dismiss="modal">Fermer</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users_group as $group)
                                        <tr>
                                            <td class="cell">{{ $loop->iteration }}</td>
                                            <td class="cell">{{ $group->groupe }}</td>
                                            <td class="cell" style="text-align: right">
                                                <a class="btn-sm text-secondary" href="{{ route('parametres.autorisations', $group->id) }}"><i class='bx bxs-edit-alt' style="font-size: 12pt"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!--//app-card-body-->

                    </div><!--//app-card-->
                </div>
            </div><!--//row-->
            

            <hr class="my-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Diffusion des messages</h3>
                    <div class="section-intro">Diffuser un message pour le bulletin d'information</div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <form class="settings-form">
                                <div>
                                    <textarea name="message" class="form-control" id="id_message" cols="30" rows="10" placeholder="Entrez le message à diffuser"></textarea>
                                    <button class="bi-send btn btn-primary mt-2 text-light"> Diffuser ce message</button>
                                </div>
                            </form>
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div>
            </div><!--//row-->
            <hr class="my-4">
        </div><!--//container-fluid-->
    </div><!--//app-content-->
@endsection
@section('scripts')
    <script>
        function loadidparoisse(element) {
            let input_id = document.getElementById("id_paroisse");
            input_id.value = element.getAttribute('data-role');
        }
        function loadidqualite(element) {
            let input_id = document.getElementById("id_qualite");
            input_id.value = element.getAttribute('data-role');
        }
        function loadiddepartement(element) {
            let input_id = document.getElementById("id_departement");
            input_id.value = element.getAttribute('data-role');
        }
        function loadidzone(element) {
            let input_id = document.getElementById("id_zone");
            input_id.value = element.getAttribute('data-role');
        }
        function loadidprogrammedupasteur(element) {
            let input_id = document.getElementById("id_programmedupasteur");
            input_id.value = element.getAttribute('data-role');
        }
        function loadidprogrammedeculte(element) {
            let input_id = document.getElementById("id_programmedeculte");
            input_id.value = element.getAttribute('data-role');
        }
    </script>
@endsection

