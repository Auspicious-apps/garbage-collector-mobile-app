@extends('admin/layouts/app')

@section('content')
<main class="content-main-block">
      @foreach($users as $user)
    <section class="main-page-handle">
      <div class="page-handle-name">
        <!--<span>Supplier</span>-->
        <!--<span class="space">/</span>-->
        <span>Solicitação pendente</span>
      </div>
       <div class="main-page-name">
        <h2>{{ $user->name}}</h2>
       </div>
    </section>
    <section class="information-block">
        
      <div class="user-profile">
        <div class="user-image-block">
          <div class="user-image">
          @if($user->image!=null)
          <img src="{{asset('uploads/'.$user->image)}}">
         @else
          <img src="{{asset('images/placeholder.png')}}">
           @endif
        </div>
      </div>
        <div class="supplier-profile-content-main">
          <div class="supplier-profile-content">
          <h3>Perfil do Fornecedor</h3>
              <ul class="supplier-details">
            <li>
              <h3>Nome Completo</h3>
              <h4 class="light">{{ $user->name}}</h4>
            </li>
            <li>
              <h3>Email</h3>
              <h4 class="light">{{ $user->email}}</h4>
            </li>
            <li>
              <h3>Número de telefone</h3>
              <h4 class="light">{{ $user->phone_number}}</h4>
            </li>
            <li>
              <h3>Endereço 1</h3>
              <h4 class="light">{{ $user->address_line1}}</h4>
            </li>
            <li>
              <h3>Endereço 2</h3>
              <h4 class="light">{{ $user->address_line2}}</h4>
            </li>
            <li>
              <h3>Cidade</h3>
              <h4 class="light">{{ $user->city}}</h4>
            </li>
            <li>
              <h3>CEP</h3>
              <h4 class="light">{{ $user->zip_code}}</h4>
            </li>
          </ul>
        </div>
         <form method="post" action="{{url('delete-collector')}}">
            @csrf
            <input type="hidden" name="id" value="{{$user->id}}">
        <div class="account-dlt-btn">
          <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm">Excluir conta</button>
        </div>
        </form>
      </div>
      </div>
    </section>
    @endforeach
  </main>
  @endsection