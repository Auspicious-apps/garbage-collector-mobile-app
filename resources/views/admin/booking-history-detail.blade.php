@extends('admin/layouts/app')

@section('content')

<main class="content-main-block">
    <section class="main-page-handle">
      <div class="page-handle-name">
        <span>Plataforma</span>
        <span class="space">/</span>
        <span> Histórico de registros</span>
      </div>
       <div class="main-page-name">
        <h2>Detalhes do histórico de agendamentos</h2>
       </div>
    </section>



    <section class="information-block">
      @foreach($profile as $data)
      <div class="user-profile">
        <div class="user-image-block">
          <div class="user-image">
           @if($data->image!=null)
          <img src="{{asset('uploads/'.$data->image)}}">
          @else
          <img src="{{asset('images/placeholder.png')}}">
           @endif
          <div class="user-_details">
          <h2>{{$data->name}}</h2>
          <h3>{{$data->email}}</h3>
        </div>
        </div>
      </div>
      <div class="booking_content-main">
      <div class="booking-details-main-block">
        <h3>Detalhes dos agendamentos</h3>
         <div class="booking-details--list">
          <div class="booking-details-item">
            <h3>Endereço do fornecedor</h3>
            <h5>{{$data->address_line1}}</h5>
          </div>
          <div class="booking-details-item">
            <h3>Endereço do fornecedor</h3>
            <h5>{{$data->address_line2}}</h5>
          </div>
          <div class="booking-details-item">
            <h3>data/hora</h3>
            <h5>{{$data->time}} on {{$data->date}}</h5>
          </div>
         </div>
         <div class="booking-main-history">
          <ul>
            <li>
              <div class="left-list">
                <h3>Número de série</h3>
              </div>
              <div class="right-list">
                <h4>#{{$data->id}}</h4>
              </div>
            </li>
            <li>
              <div class="left-list">
                <h3>Nome do fornecedores</h3>
              </div>
              <div class="right-list">
                 <?php $sdata = App\User::where('id',$data->supplier_id)->first(); ?>
                <h4><?php echo $sdata->name; ?></h4>
              </div>
            </li>
             <li>
              <div class="left-list">
                <h3>Nome do coletor</h3>
              </div>
              <div class="right-list">
                 <?php $cdata = App\User::where('id',$data->collector_id)->first(); ?>
                <h4><?php echo $cdata->name; ?></h4>
              </div>
            </li>
            <li>
              <div class="left-list">
                <h3>Estado</h3>
              </div>
              <div class="right-list job">
               @if($data->status == '3')
                <h4>Job Completed</h4>
                @elseif($data->status == '2')
                <h4>Cancel</h4>
                 @elseif($data->status == '1')
                <h4>In Process</h4>
                @endif
              </div>
            </li>
            <li class="offer-select">
              <div class="left-list">
                <h3>Ofertas Selecionadas</h3>
              </div>
              <div class="right-list">

                 <?php $array = explode(',', $data->offer_ids);
                 // print_r($array);
                 for($i=0;$i<count($array);$i++){?>
               
               <?php $offers = App\Offers::where('id',$array[$i])->first();?> 
                <h4><span><?php echo $offers->offer_name; ?></span><span><?php echo $offers->price; ?>/KG</span></h4> 
               <?php } ?>    
              </div>
            </li>
           
         </div>
      </div>
      <div class="account-dlt-btn account-save-btn">
     <a href="{{url('/bhistory')}}"  >   <button type="button" class="btn">Back</button></a>
        </div>
    </div>
    @endforeach
  </section>
  </main>
  @endsection