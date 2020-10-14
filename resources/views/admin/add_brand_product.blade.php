@extends('admin_layout')
@section('admin-content')
<div style="text-align:center;">
    <h1> Thêm thương hiệu sản phẩm</h1>
    
</div>
<?php
			$message = Session::get('message');
			if($message){
				echo '<span style="color:green;">'. $message.'</span>';
				Session::put('message',null);
			}
			?>
<form action="{{URL::to('/save-brand-product')}}" method="post">
{{ csrf_field() }}
  <div class="form-group">
    <label for="">Tên thương hiệu</label>
    <input type="text" class="form-control" id="brand-product-name" name="brand_product_name" placeholder="name@example.com">
  </div>
  
  <div class="form-group">
    <label for="">Mô tả thương hiệu </label>
    <textarea class="form-control" id="brand-product-decreption" name="brand_product_decreption" rows="3"></textarea>
  </div>

  <div class="form-group">
    <label for="">Hiển thị</label>
    <select name="brand_product_status" class="form-control" id="display-brand">
      <option value="0">Ẩn</option>
      <option value="1">Hiện</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Thêm thương hiệu</button>
</form>
@endsection