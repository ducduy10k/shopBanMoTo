@extends('admin_layout')
@section('admin-content')
<div>
  <h1>Liệt kê thương hiệu sản phẩm</h1>
</div>
<div class="table-responsive">
<?php
			$message = Session::get('message');
			if($message){
				echo '<span style="color:green;">'. $message.'</span>';
				Session::put('message',null);
			}
			?>
    <table class="table">

        <caption>List of Brand</caption>
        <thead>
            <tr>
            <th scope="col"><input type="checkbox"></th>
            <th scope="col">Tên thương hiệu </th>
            <th scope="col">Hiển thị </th>
            
            <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($all_brand_product as $key =>$cate_pro)
            <tr>
            <th scope="row"><input type="checkbox"></th>
            <td>{{$cate_pro->brand_name}}</td>
             <td><?php
             if($cate_pro->brand_status==0){
               ?>
                <a href="{{URL::to('/active-brand-product/'.$cate_pro->brand_id)}}"><span class='fa-styling-off fa fa-toggle-on' ></span></a>
                <?php
              }else{
              ?>
              <a   href="{{URL::to('/unactive-brand-product/'.$cate_pro->brand_id)}}"><span class='fa-styling-on fa fa-toggle-on '></span></a>
              <?php
              }
             ?>
             </td>
           
            <td>
            <div class="btn-group" role="group" aria-label="Basic example">
              <a href="{{URL::to('/edit-brand-product/'.$cate_pro->brand_id)}}"><i class= "fa fa-pencil-square-o"></i></a>
              <a onclick="return confirm('Are you sure you want to delete this item?');" href="{{URL::to('/delete-brand-product/'.$cate_pro->brand_id)}}"><i class="fa fa-trash"></i></a>
            </div>
            </td>
            </tr>
            
            @endforeach
        </tbody>
     
    </table><nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>
@endsection