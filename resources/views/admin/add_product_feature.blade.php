@extends('admin_layout')
@section('admin-content')
<div style="text-align:center;">
    <h1> Thêm đặc trưng sản phẩm</h1>
    
</div>
<?php
			$message = Session::get('message');
			if($message){
				echo '<span style="color:green;">'. $message.'</span>';
				Session::put('message',null);
			}
			?>
<form action="{{URL::to('/save-product-feature')}}" method="post" enctype='multipart/form-data'>
{{ csrf_field() }}

    <div class="form-group">
    <label for=""> Sản phẩm </label>
    <select name="product" class="form-control" id="">
    @foreach($product as $key =>$pro)
      <option value="{{$pro->product_id}}">{{$pro->product_name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="">Đặc trưng </label>
    <select name="feature" class="form-control" id="">
    @foreach($feature as $key =>$fea)
      <option value="{{$fea->feature_id}}">{{$fea->feature_name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="">Tên đặc trưng sản phẩm</label>
    <input type="text" class="form-control" id="product-feature-name" name="product_feature_name" placeholder="name@example.com">
  </div>
  
  
  <div class="form-group">
    <label for="">convert to HTML</label>
    <textarea class="form-control" id="product-feature-value" name="product_feature_value" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="">Hình ảnh sản phẩm</label>
    <input type="file" class="form-control" id="product-feature-image" name="product_feature_image">
  </div>
  <div class="form-group">
    <label for="">Giá sản phẩm</label>
    <input type="text" class="form-control" id="product-feature-price" name="product_feature_price" placeholder="name@example.com">
  </div>
  

  <div class="form-group">
    <label for="">Hiển thị</label>
    <select name="product_feature_status" class="form-control" id="">
      <option value="0">Ẩn</option>
      <option value="1">Hiện</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Thêm đặc trưng sản phẩm</button>
</form>
@endsection