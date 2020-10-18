@extends('admin_layout')
@section('admin-content')
<div style="text-align:center;">
    <h1> Thêm danh mục sản phẩm</h1>

</div>
<?php
			$message = Session::get('message');
			if($message){
				echo '<span style="color:green;">'. $message.'</span>';
				Session::put('message',null);
			}
			?>
<form action="{{URL::to('/save-category-product')}}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="">Tên danh mục</label>
        <input type="text" class="form-control" id="category-product-name" name="category_product_name"
            placeholder="name@example.com">
    </div>

    <div class="form-group">
        <label for="">Mô tả</label>
        <textarea class="form-control" id="category-product-decreption" name="category_product_decreption"
            rows="3"></textarea>
    </div>

    <div class="form-group">
        <label for="">Hiển thị</label>
        <select name="category_product_status" class="form-control" id="display-category">
            <option value="0">Ẩn</option>
            <option value="1">Hiện</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Thêm danh mục</button>
</form>
@endsection