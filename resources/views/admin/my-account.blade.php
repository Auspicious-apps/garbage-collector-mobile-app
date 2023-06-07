@extends('admin/layouts/app')

@section('content')

<main class="content-main-block">
    <section class="main-page-handle">
      <div class="page-handle-name">
        <span>Plataforma</span>
        <span class="space">/</span>
        <span>Minha conta</span>
      </div>
       <div class="main-page-name">
              @if(Session('status'))
            <h6 class="alert alert-success">{{Session('status')}}</h6>
            @endif
        <h2>Minha conta</h2>
       </div>
    </section>
      @foreach($user as $data)
       <form class="account-form-detail" action="{{url('/myaccount/'.$data->id)}}" method="post" enctype="multipart/form-data">
      @csrf
    <section class="main-account-details">
     
       <div class="user_image-block">
      <div class="user_image">
      <div class="file-upload">
        <div class="image-upload-wrap">
               
        <input class="file-upload-input" type='file' name="image" onchange="readURL(this);" accept="image/*" />
       
          <div class="drag-text">
             @if($data->image!=null)
          <img src="{{asset('uploads/'.$data->image)}}">
        
           @else
          <img src="{{asset('images/placeholder.png')}}">
            @endif
           <!-- <img src="{{asset('uploads/'.$data->image)}}"> -->
          </div>
          <!--@endforeach-->
        </div>
        <div class="file-upload-content">
         <img class="file-upload-image" src="#" alt="your image" />
        </div>
        <div class="upload-img">
          <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Choose Image</button>
        </div>
      </div>
    </div>
  </div>
  <div class="user_details_main">
    <div class="user_details">
      <h3>Informações da conta</h3>
      <!--@foreach($user as $data)-->
      <!--<form class="account-form-detail" action="{{url('/myaccount/1')}}" method="post">-->
      <!--@csrf-->
      
        <div class="col">
          <label>Nome completo</label>
          <input type="text" id="first name" name="name" value="{{$data->name}}">
        </div>
        <div class="col">
          <label>Email</label>
          <input type="email" id="email" name="email" value="{{$data->email}}">
        </div>
        <div class="col">
          <label>Número de telefone</label>
            <input type="tel" id="phone_number" name="phone_number" value="{{$data->phone_number}}">
          </div>
          <div class="col">
          <label>Endereço 1</label>
          <input type="text" id="address" name="address_line1" value="{{$data->address_line1}}">
        </div>
        <div class="col">
          <label>Endereço 2</label>
          <input type="text" id="address" name="address_line2" value="{{$data->address_line2}}">
        </div>
        <div class="col">
           <label>Cidade</label>
            <input type="text" id="first name" name="city" value="{{$data->city}}">
        </div>
        <div class="col">
           <label>CEP</label>
          <input type="text" id="text" maxlength="6" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" name="zip_code" value="{{$data->zip_code}}">
          
        </div>

        <div class="account-dlt-btn account-save-btn">
          <button type="submit" class="btn" >Save</button>
        </div>
       
      <!--</form>-->
     
      
    </div>
    
       
  </div>

 
    </section>
      </form>
     @endforeach
  </main>
  @endsection