@extends('admin_layout')
@section('admin-content')
<div style="text-align:center;">
    <h1> Thêm sản phẩm</h1>
    
</div>
<?php
			$message = Session::get('message');
			if($message){
				echo '<span style="color:green;">'. $message.'</span>';
				Session::put('message',null);
			}
			?>
<form action="{{URL::to('/save-product')}}" method="post" enctype='multipart/form-data'>
{{ csrf_field() }}
  <div class="form-group">
    <label for="">Tên sản phẩm</label>
    <input type="text" class="form-control" id="product-name" name="product_name" placeholder="name@example.com">
  </div>
  
  <div class="form-group">
    <label for="">Mô tả</label>
    <textarea class="form-control" id="product-descreption" name="product_descreption" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="">Nội dung sản phẩm</label>
    <textarea class="form-control" id="product-content" name="product_content" rows="3"></textarea>
  </div>

  <div class="form-group">
    <label for="">Hình ảnh sản phẩm</label>
    <input type="file" class="form-control" id="product-image" name="product_image">
  </div>

  <div class="form-group">
    <label for="">Giá sản phẩm</label>
    <input type="text" class="form-control" id="product-price" name="product_price" >
  </div>
  <div class="form-group">
    <label for="">Danh mục sản phẩm </label>
    <select name="product_cate" class="form-control" id="">
      @foreach($category_product as $key =>$cate)
      <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="">Thương hiệu</label>
    <select name="product_brand" class="form-control" id="">
    @foreach($brand_product as $key =>$brand)
      <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="">Hiển thị</label>
    <select name="product_status" class="form-control" id="">
      <option value="0">Ẩn</option>
      <option value="1">Hiện</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
</form>
@endsection