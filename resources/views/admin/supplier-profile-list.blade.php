@extends('admin/layouts/app')

@section('content')
<main class="content-main-block">
    <section class="main-page-handle">
      <div class="page-handle-name">
        <span>Fornecedor</span>
        <span class="space">/</span>
        <span>Pedido pendente</span>
      </div>
       <div class="main-page-name">
              @if(Session('status'))
            <h6 class="alert alert-success">{{Session('status')}}</h6>
            @endif
        <h2>Lista de fornecedores</h2>
       </div>
    </section>
    <section class="supplier-lists">
        @foreach($users as $user)
      <a href="{{url('/supplierprofile/'.$user->id)}}">
        <div class="supplier-list-item">
          @if($user->image!=null)
          <img src="{{asset('uploads/'.$user->image)}}">
          @else
          <img src="{{asset('images/placeholder.png')}}">
           @endif
          <h3 class="supplier-name">{{ $user->name }}</h3>
        </div>
      </a>
      @endforeach
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-2.png')}}">-->
      <!--    <h3 class="supplier-name">Hattie Hodkiewicz</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-3.png')}}">-->
      <!--    <h3 class="supplier-name">Karlee Schamberger</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-4.png')}}">-->
      <!--    <h3 class="supplier-name">Karlee Schamberger</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-5.png')}}">-->
      <!--    <h3 class="supplier-name">Karlee Schamberger</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-6.png')}}">-->
      <!--    <h3 class="supplier-name">Mariana Muller</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="{{url('/supplierprofile')}}">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-7.png')}}">-->
      <!--    <h3 class="supplier-name">Clifton Koss</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-8.png')}}">-->
      <!--    <h3 class="supplier-name">Charlie Klocko</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-9.png')}}">-->
      <!--    <h3 class="supplier-name">Charlie Klocko</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-10.png')}}">-->
      <!--    <h3 class="supplier-name">Charlie Klocko</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-11.png')}}">-->
      <!--    <h3 class="supplier-name">Mariana Muller</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-12.png')}}">-->
      <!--    <h3 class="supplier-name">Clifton Koss</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-13.png')}}">-->
      <!--    <h3 class="supplier-name">Charlie Klocko</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-14.png')}}">-->
      <!--    <h3 class="supplier-name">Charlie Klocko</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-15.png')}}">-->
      <!--    <h3 class="supplier-name">Charlie Klocko</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-16.png')}}">-->
      <!--    <h3 class="supplier-name">Mariana Muller</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-17.png')}}">-->
      <!--    <h3 class="supplier-name">Clifton Koss</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-18.png')}}">-->
      <!--    <h3 class="supplier-name">Charlie Klocko</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-19.png')}}">-->
      <!--    <h3 class="supplier-name">Charlie Klocko</h3>-->
      <!--  </div>-->
      <!--</a>-->
      <!--<a href="supplier-profile.html">-->
      <!--  <div class="supplier-list-item">-->
      <!--    <img src="{{asset('images/supplier-20.png')}}">-->
      <!--    <h3 class="supplier-name">Charlie Klocko</h3>-->
      <!--  </div>-->
      <!--</a>-->
    </section>

  </main>
  @endsection