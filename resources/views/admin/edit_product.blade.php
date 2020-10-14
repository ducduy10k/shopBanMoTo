@extends('admin_layout')
@section('admin-content')
<div style="text-align:center;">
    <h1> Cập nhật sản phẩm</h1>
    
</div>
<?php
			$message = Session::get('message');
			if($message){
				echo '<span style="color:green;">'. $message.'</span>';
				Session::put('message',null);
			}
			?>
            @foreach($edit_product as $key => $pro)
<form action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post">
{{ csrf_field() }}
  <div class="form-group">
    <label for="">Tên sản phẩm</label>
    <input type="text" class="form-control" id="product-name" value='{{$pro->product_name}}' name="product_name" >
  </div>
  
  <div class="form-group">
    <label for="">Mô tả</label>
    <textarea class="form-control" id="product-descreption" name="product_descreption" rows="3">{{$pro->product_desc}}</textarea>
  </div>
  <div class="form-group">
    <label for="">Nội dung sản phẩm</label>
    <textarea class="form-control" id="product-content" name="product_content" rows="3">{{$pro->product_content}}</textarea>
  </div>
  <div class="form-group">
    <label for="">Giá sản phẩm</label>
    <input type="text" class="form-control" value="{{$pro->product_price}}" id="product-price" name="product_price" >
  </div>
  <div class="form-group">
    <label for="">Danh mục sản phẩm </label>
    <select name="product_cate" class="form-control" id="">
      @foreach($cate_product as $key =>$cate)
         
    if($cate->category_id==$pro.category_id){
        <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
    }
    else{
        <option  value="{{$cate->category_id}}">{{$cate->category_name}}</option>
    }
      
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="">Thương hiệu</label>
    <select name="product_brand" class="form-control" id="">
    @foreach($brand_product as $key =>$brand)
           
    if($brand->brand_id==$pro.brand_id){
        <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>  
    }
    else{
        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>  
    }
    @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="">Hiển thị</label>
    <select name="product_status" class="form-control" id="">
      <?php
    if($pro->product_status==0){
      echo '<option selected value="0">Ẩn</option>
      <option value="1">Hiện</option>';
    }
    else{
      echo '<option value="0">Ẩn</option>
      <option  selected value="1">Hiện</option>';
    }
    ?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
</form>
@endforeach
@endsection