@extends('admin/layouts/app')

@section('content')
<main class="content-main-block">
    <section class="main-page-handle">
      <div class="page-handle-name">
        <span>páginas</span>
        <span class="space">/</span>
        <span>Plataforma</span>
      </div>
       <div class="main-page-name">
        <h2>Plataforma</h2>
       </div>
    </section>
   
    <section class="income-block">
      <div class="total-earning-block">
        <div class="eraning-left"> 
               
            <h3>Total ganho</h3>
            <h1>R$ <?php echo  number_format((float)$sum, 2, '.', '') ; ?></h1>
            <div class="monthly-detail">
              <!-- <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="10.5228" cy="10.2771" r="9.64857" fill="white"/>
              <path d="M13.6555 12.9085L10.5229 9.6192L7.3902 12.9085L6.13714 12.2506L10.5229 7.64563L14.9086 12.2506L13.6555 12.9085Z" fill="#43D62D"/>
              </svg>
              <h5 class="m-0">+ $ <?php echo  number_format((float)$lsum, 2, '.', '') ; ?> (<?php echo $difference; ?>%) (último mês)</h5> -->
            </div>

          </div>
           
          <div class="eraning-right">
            <svg width="130" height="130" viewBox="0 0 130 130" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M2.80428 129.429C2.60159 129.294 2.3989 129.159 2.1962 129.058C0.574642 128.179 -0.26992 126.49 0.101687 124.868C0.507077 123.112 1.95972 121.929 3.85154 121.862C5.13527 121.828 6.45279 121.862 7.87165 121.862C7.87165 121.288 7.87165 120.848 7.87165 120.409C7.87165 112.268 7.87165 104.126 7.87165 96.0182C7.87165 92.9778 9.3243 91.559 12.3647 91.559C17.0267 91.559 21.7225 91.559 26.3844 91.559C29.087 91.559 30.6073 93.0792 30.6073 95.7818C30.6073 103.957 30.6073 112.132 30.6073 120.308C30.6073 120.781 30.6073 121.22 30.6073 121.794C33.1072 121.794 35.5733 121.794 38.2083 121.794C38.2083 121.321 38.2083 120.848 38.2083 120.342C38.2083 109.227 38.2083 98.079 38.2083 86.9645C38.2083 83.8566 39.6272 82.4377 42.7689 82.4377C47.3971 82.4377 52.0253 82.4377 56.6873 82.4377C59.4575 82.4377 60.9439 83.9579 60.9777 86.7618C60.9777 97.9438 60.9777 109.092 60.9777 120.274C60.9777 120.781 60.9777 121.254 60.9777 121.828C63.5114 121.828 65.9437 121.828 68.5788 121.828C68.5788 121.355 68.5788 120.882 68.5788 120.409C68.5788 104.633 68.5788 88.8901 68.5788 73.1137C68.5788 69.972 69.9976 68.5531 73.1056 68.5531C77.5987 68.5531 82.1255 68.5531 86.6186 68.5531C89.9293 68.5531 91.3143 69.9044 91.3143 73.2151C91.3143 88.8901 91.3143 104.565 91.3143 120.24C91.3143 120.747 91.3143 121.254 91.3143 121.828C93.848 121.828 96.3141 121.828 98.9154 121.828C98.9154 121.321 98.9154 120.815 98.9154 120.342C98.9154 96.1872 98.9154 72.0327 98.9154 47.912C98.9154 44.7027 100.3 43.2838 103.51 43.2838C108.07 43.2838 112.597 43.2838 117.158 43.2838C120.198 43.2838 121.651 44.7365 121.651 47.7431C121.651 71.9313 121.651 96.1196 121.651 120.308C121.651 120.815 121.651 121.288 121.651 121.862C124.624 122.065 127.935 121.017 129.489 124.666C129.489 125.341 129.489 126.017 129.489 126.693C128.88 127.943 127.968 128.855 126.718 129.463C85.4024 129.429 44.0865 129.429 2.80428 129.429Z" fill="white"/>
              <path d="M129.489 27.7439C128.07 30.7167 125.57 31.5613 123.374 29.7032C122.698 29.1627 122.192 28.2506 121.955 27.406C120.807 23.4197 119.759 19.3658 118.678 15.3457C118.577 15.0417 118.476 14.7376 118.374 14.3998C116.212 17.5416 114.219 20.7171 111.956 23.69C95.2333 45.7161 73.849 61.6952 48.377 72.2354C38.445 76.3231 28.1413 79.1608 17.4998 80.4783C13.0406 81.0188 8.5137 81.1539 4.02063 81.3566C1.68964 81.4918 0.0343006 79.8364 0.00051816 77.7081C-0.0332643 75.6136 1.58829 73.9583 3.85172 73.8569C6.08136 73.7556 8.31101 73.7556 10.5406 73.5867C22.0267 72.8097 33.0736 70.1409 43.7488 65.9181C67.9033 56.3576 88.2741 41.5609 104.388 21.1225C107.159 17.6091 109.557 13.7917 112.158 10.1094C112.057 10.0081 111.989 9.87294 111.888 9.77159C111.314 9.90672 110.739 10.0081 110.165 10.177C105.976 11.2918 101.821 12.4404 97.5981 13.5552C94.7266 14.2984 92.328 12.4404 92.5307 9.67025C92.632 8.08247 93.7131 6.76495 95.3346 6.32578C103.037 4.23127 110.773 2.17054 118.509 0.14359C120.671 -0.430712 122.563 0.751674 123.171 3.08266C125.029 9.94051 126.854 16.7983 128.712 23.69C128.914 24.5007 129.218 25.2777 129.455 26.0547C129.489 26.5615 129.489 27.1696 129.489 27.7439Z" fill="white"/>
            </svg>
           </div>
      </div>
      <div class="earning-list">
        <div class="earning-list-items">
          <h2><?php echo $suppliers; ?></h2>
          <p>Fornecedores</p>
        </div>
        <div class="earning-list-items">
          <h2><?php echo $collector; ?></h2>
          <p> Número total de coletores</p>
        </div>
        <div class="earning-list-items">
          <h2><?php echo $todayuser; ?></h2>
          <p>Novos registros</p>
        </div>
        <div class="earning-list-items">
          <!-- <h2>R$ 89.00</h2> -->
          <h2>R$ <?php echo  number_format((float)$sum, 2, '.', '') ; ?></h2>
          <p>Total ganho</p>
        </div>
      </div>
    </section>
    <section class="activities-details">
      <h3 class="activity-heading">Atividades recentes</h3>
      <div class="activity-schedule">
          <table  id="myTable">
            <thead>
              <tr>
                 <th scope="col">Número</th>
                <th scope="col">Nome do Fornecedor</th>
                <th scope="col">Nome do coletor</th>
                <th scope="col">Status</th>
                 <th scope="col">data e hora</th>
                 <th scope="col">Local</th> 
              </tr>
            </thead>
            <tbody>
              @foreach($datas as $data)
               <?php $sdata = App\User::where('id',$data->supplier_id)->where('status','0')->first();
               $cdata = App\User::where('id',$data->collector_id)->where('status','0')->first(); 
                if($sdata!=null && $cdata!=null){ ?>
              <tr>
               <td>{{$data->id}}</td>
               <?php $sdata = App\User::where('id',$data->supplier_id)->first(); ?>
               <td><?php echo $sdata->name; ?></td>
                <?php $cdata = App\User::where('id',$data->collector_id)->first(); ?>
               <td><?php echo $cdata->name; ?></td>
                  @if($data->status == '3')
                <td  class="completed">Job Completed</td>
                @elseif($data->status == '2')
                <td class="cancel">Cancel</td>
                 @elseif($data->status == '1')
                <td>In Process</td>
                @endif
                <td>{{ $data->time }} on {{$data->date}}</td>
                <td><?php echo $sdata->address_line1; ?>,<?php echo $sdata->city; ?></td>
             </tr>
             <?php } else { ?>
                 
              <?php } ?>
             @endforeach
            </tbody>
          </table>
      </div>
    </section>




  </main>
@endsection