@extends('base_dashboard')
@section('style')
<style>
  .hidden {
    display: none;
  }
  #custom-search-input {
    background: #e8e6e7 none repeat scroll 0 0;
    margin: 0;
    padding: 10px;
  }

  #custom-search-input .search-query {
    background: #fff none repeat scroll 0 0 !important;
    border-radius: 4px;
    height: 33px;
    margin-bottom: 0;
    padding-left: 7px;
    padding-right: 7px;
  }

  #custom-search-input button {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: 0 none;
    border-radius: 3px;
    color: #666666;
    left: auto;
    margin-bottom: 0;
    margin-top: 7px;
    padding: 2px 5px;
    position: absolute;
    right: 0;
    z-index: 9999;
  }

  .search-query:focus+button {
    z-index: 3;
  }

  .all_conversation button {
    background: #f5f3f3 none repeat scroll 0 0;
    border: 1px solid #dddddd;
    height: 38px;
    text-align: left;
    width: 100%;
  }

  .all_conversation i {
    background: #e9e7e8 none repeat scroll 0 0;
    border-radius: 100px;
    color: #636363;
    font-size: 17px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    width: 30px;
  }

  .all_conversation .caret {
    bottom: 0;
    margin: auto;
    position: absolute;
    right: 15px;
    top: 0;
  }

  .all_conversation .dropdown-menu {
    background: #f5f3f3 none repeat scroll 0 0;
    border-radius: 0;
    margin-top: 0;
    padding: 0;
    width: 100%;
  }

  .all_conversation ul li {
    border-bottom: 1px solid #dddddd;
    line-height: normal;
    width: 100%;
  }

  .all_conversation ul li a:hover {
    background: #dddddd none repeat scroll 0 0;
    color: #333;
  }

  .all_conversation ul li a {
    color: #333;
    line-height: 30px;
    padding: 3px 20px;
  }

  .member_list .chat-body {
    margin-left: 47px;
    margin-top: 0;
  }

  .top_nav {
    overflow: visible;
  }

  .member_list .contact_sec {
    margin-top: 3px;
  }

  .member_list li {
    padding: 6px;
  }

  .member_list ul {
    border: 1px solid #dddddd;
  }

  .chat-img img {
    height: 34px;
    width: 34px;
  }

  .member_list li {
    border-bottom: 1px solid #dddddd;
    padding: 6px;
  }

  .member_list li:last-child {
    border-bottom: none;
  }

  .member_list {
    height: 380px;
    overflow-x: hidden;
    overflow-y: auto;
  }

  .sub_menu_ {
    background: #e8e6e7 none repeat scroll 0 0;
    left: 100%;
    max-width: 233px;
    position: absolute;
    width: 100%;
  }

  .sub_menu_ {
    background: #f5f3f3 none repeat scroll 0 0;
    border: 1px solid rgba(0, 0, 0, 0.15);
    display: none;
    left: 100%;
    margin-left: 0;
    max-width: 233px;
    position: absolute;
    top: 0;
    width: 100%;
  }

  .all_conversation ul li:hover .sub_menu_ {
    display: block;
  }

  .new_message_head button {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
  }

  .new_message_head {
    background: #f5f3f3 none repeat scroll 0 0;
    float: left;
    font-size: 13px;
    font-weight: 600;
    padding: 18px 10px;
    width: 100%;
  }

  .message_section {
    border: 1px solid #dddddd;
  }

  .chat_area {
    float: left;
    height: 300px;
    overflow-x: hidden;
    overflow-y: auto;
    width: 100%;
  }

  .chat_area li {
    padding: 14px 14px 0;
  }

  .chat_area li .chat-img1 img {
    height: 40px;
    width: 40px;
  }

  .chat_area .chat-body1 {
    margin-left: 50px;
  }

  .chat-body1 p {
    background: #fbf9fa none repeat scroll 0 0;
    padding: 10px;
  }

  .chat_area .admin_chat .chat-body1 {
    margin-left: 0;
    margin-right: 50px;
  }

  .chat_area li:last-child {
    padding-bottom: 10px;
  }

  .message_write {
    background: #f5f3f3 none repeat scroll 0 0;
    float: left;
    padding: 15px;
    width: 100%;
  }

  .message_write textarea.form-control {
    height: 70px;
    padding: 10px;
  }

  .chat_bottom {
    float: left;
    margin-top: 13px;
    width: 100%;
  }

  .upload_btn {
    color: #777777;
  }

  .sub_menu_>li a,
  .sub_menu_>li {
    float: left;
    width: 100%;
  }

  .member_list li:hover {
    background: #D9E6FFFF none repeat scroll 0 0;
    color: #fff;
    cursor: pointer;
  }

  .img-circle {
    border-radius: 100%;
  }
</style>
@endsection
@section('content')
  <div class="main_section">
    <div class="container">
      <div class="chat_container">
        <div class="row">
            <div class="col-sm-5 chat_sidebar">
              <div class="row">
                <div id="custom-search-input">
                  <div class="input-group col-md-12">
                    <input type="date" onchange="filter_date_research(this)" class="search-query form-control">
                    <button class="btn btn-danger" type="button">
                      <span class=" glyphicon glyphicon-search"></span>
                    </button>
                  </div>
                </div>
                
                <div class="member_list p-0">
                  <ul class="list-unstyled">
                    @foreach($liste_des_lettres as $message)
                      <li class="left clearfix {{ $message->created_at->format('Y-m-d') }} searchble" id="{{ $message->id }}" onclick="display_message(this)">
                        <div class="row">
                          <div class="col-2">
                            <span class="chat-img pull-left">
                              <img
                                src="{{ asset('css/images/utilisateur.png') }}"
                                alt="User Avatar" class="img-circle">
                            </span>
                          </div>
                          <div class="col-10">
                            <input type="hidden" id="id_mail" value="{{ $message->email }}">
                            <span class="chat-img pull-left fw-bold">{{ $message->nom }}</span><br><br>
                            <span class="chat-img pull-left mt-1 fst-italic">Email: {{ $message->email }}</span><br>
                            <span class="chat-img pull-left mt-1 fst-italic">Téléphone: {{ $message->telephone }}</span>
                            <input class="chat-img pull-left mt-1 fst-italic" type="hidden" id="message_container{{ $message->id }}" value="{{ $message->message }}">
                            <input class="chat-img pull-left mt-1 fst-italic" type="hidden" id="time{{ $message->id }}" value="{{ $message->created_at->diffForHumans() }}">
                          </div>
                        </div>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
            
            <!--chat_sidebar-->
            <div class="col-sm-7 message_section">
              <div class="row">
                <div class="new_message_head">
                  <div class="pull-left"><button><i class="fa fa-plus-square-o" aria-hidden="true"></i> Message</button>
                  </div>
                  <div class="pull-right">
                    <div class="dropdown">
                      <button class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                        <span class="caret"></span>
                      </button>
                    </div>
                  </div>
                </div>
                <!--new_message_head-->
    
                <div class="chat_area">
                  <ul class="list-unstyled">
                    <li class="left clearfix">
                      <span class="chat-img1 pull-left">
                        <img
                          src="{{ asset('css/images/utilisateur.png') }}"
                          alt="User Avatar" class="img-circle">
                      </span>
                      <div class="chat-body1 clearfix">
                        <p id="display_message" style="text-align: justify"></p>
                        <div class="chat_time pull-right d-flex">
                          <span id="id_time"></span>
                          <form action="{{ route('boite.supprimer_message') }}" method="post">
                              @csrf
                              @method('delete')
                              <input type="hidden" id="id_message" name="message_id">
                              <button type="submit" class="btn hidden" id="btn_sup"><span class="bi-trash text-danger"></span></button>
                          </form>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <!--chat_area-->
                <div class="message_write">
                  <form action="{{ route('boite.reply_letter') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="destinataire" id="destinataire_id" value="{{ old('destinataire') }}">
                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('destinataire')"/>
                    <textarea class="form-control" name="reponse" placeholder="répondre à son adresse mail" required>{{ old('reponse') }}</textarea>
                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('reponse')"/>
                    <input type="file" name="piece_jointe" class="form-control mt-1" title="pièce jointe">
                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('piece_jointe')"/>
                    <div class="clearfix"></div>
                    <div class="chat_bottom"><a href="#" class="pull-left upload_btn"></a>
                      <button class="pull-right btn btn-success" type="submit">
                        Envoyer</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <!--message_section-->
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
    <script>
        function display_message(element) {
          let id = "message_container"+element.id;
          let input_message = document.getElementById(id);
          let time = document.getElementById('time'+element.id).value;
          let display_message = document.getElementById('display_message');
          let span_time = document.getElementById('id_time');
          display_message.textContent = input_message.value;
          span_time.textContent = time;
          let btn_trash = document.getElementById('btn_sup').classList.remove('hidden');
          $('#id_message').val(element.id);
          let mail = document.getElementById("id_mail");
          $('#destinataire_id').val(mail.value);
        }

        function filter_date_research(element) {
          let date = element.value;
          const searchableElements = document.querySelectorAll('.searchble');
          if (date) {
            searchableElements.forEach(element => {
              if (element.classList.contains(date)) {
                element.classList.remove('hidden');
              }else {
                element.classList.add('hidden');
              }
            })
          }else {
            searchableElements.forEach(element => {
              element.classList.remove('hidden');
            })
          }
        }
    </script>
@endsection