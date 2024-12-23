@extends('base_dashboard')
@section('page_title', 'Pefaco Universelle')
@section('titre', '#paramètres')
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">Paramètres</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Général</h3>
                    <div class="section-intro">Gestion des informations statiques générales du site public <a href="#">En savoir plus</a></div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <form class="settings-form">
                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Historique
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
                                    <textarea type="text" class="form-control" id="setting-input-1" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Mission
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
                                    <textarea type="text" class="form-control" id="setting-input-1" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Vision
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
                                    <textarea type="text" class="form-control" id="setting-input-1" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Communauté
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
                                    <textarea type="text" class="form-control" id="setting-input-1" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Localisations
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
                                    <textarea type="text" class="form-control" id="setting-input-1" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Pasteur responsable
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
                                    <textarea type="text" class="form-control" id="setting-input-1" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-3" class="form-label">Adresse</label>
                                    <input type="email" class="form-control" id="setting-input-3"
                                           value="av.muhungu meteo">
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-2" class="form-label">Contacts</label>
                                    <input type="text" class="form-control" id="setting-input-2" value="Steve Doe"
                                           required>
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-3" class="form-label">Adresse mail</label>
                                    <input type="email" class="form-control" id="setting-input-3"
                                           value="hello@companywebsite.com">
                                </div>
                                <div class="mb-3">
                                    <label for="setting-input-1" class="form-label">Programmes des cultes
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
                                    <textarea type="text" class="form-control" id="setting-input-1" required></textarea>
                                </div>
                                <button type="submit" class="btn app-btn-primary">Enregistrer les modifications</button>
                            </form>
                        </div><!--//app-card-body-->

                    </div><!--//app-card-->
                </div>
            </div><!--//row-->
            <hr class="my-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-4">
                    <h3 class="section-title">Serviteurs au sein de l'église</h3>
                    <div class="section-intro">Settings section intro goes here. Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit. <a href="help.html">Learn more</a></div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">

                        <div class="app-card-body">
                            <div class="mb-2"><strong>Current Plan:</strong> Pro</div>
                            <div class="mb-2"><strong>Status:</strong> <span class="badge bg-success">Active</span>
                            </div>
                            <div class="mb-2"><strong>Expires:</strong> 2030-09-24</div>
                            <div class="mb-4"><strong>Invoices:</strong> <a href="#">view</a></div>
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <a class="btn app-btn-primary" href="#">Upgrade Plan</a>
                                </div>
                                <div class="col-auto">
                                    <a class="btn app-btn-secondary" href="#">Cancel Plan</a>
                                </div>
                            </div>

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
                                                <a href="#" class="btn-sm app-text-primary" data-bs-toggle="modal"  data-bs-target='#modal'><i class='bx bxs-plus-circle' style="font-size: 16pt"><span style="font-size: 12pt; vertical-align: top">ajouter un gpe</span></i></a>
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
                                                                    <form method="post" action="{{ route('add_users_group') }}">
                                                                        @csrf
                                                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('groupe')"/>
                                                                        <div class="d-flex gap-2">
                                                                            <input class="form-control" placeholder="entrez la désignation du groupe" name="groupe" type="text">
                                                                            <button type="submit" class="btn btn-primary text-light" style="font-weight: normal" title="ajouter ce groupe d'utilisateur">
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
                                                <a class="btn-sm app-btn-secondary" href="{{ route('autorisations', $group->id) }}"><i class='bx bxs-edit-alt' style="font-size: 14pt"></i></a>
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
                    <h3 class="section-title">Notifications</h3>
                    <div class="section-intro">Settings section intro goes here. Duis velit massa, faucibus non
                        hendrerit eget.
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <form class="settings-form">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="settings-switch-1" checked>
                                    <label class="form-check-label" for="settings-switch-1">Project
                                        notifications</label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="settings-switch-2">
                                    <label class="form-check-label" for="settings-switch-2">Web browser push
                                        notifications</label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="settings-switch-3" checked>
                                    <label class="form-check-label" for="settings-switch-3">Mobile push
                                        notifications</label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="settings-switch-4">
                                    <label class="form-check-label" for="settings-switch-4">Lorem ipsum
                                        notifications</label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="settings-switch-5">
                                    <label class="form-check-label" for="settings-switch-5">Lorem ipsum
                                        notifications</label>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn app-btn-primary">Save Changes</button>
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

