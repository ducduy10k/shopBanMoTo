@extends('admin_layout')
@section('admin-content')
<div style="text-align:center;">
    <h1> Cập nhập đặc trưng sản phẩm</h1>

</div>
<?php
			$message = Session::get('message');
			if($message){
				echo '<span style="color:green;">'. $message.'</span>';
				Session::put('message',null);
			}
			?>
@foreach($edit_product_feature as $key =>$edit_value)
<form action="{{URL::to('/update-product-feature/'.$edit_value->product_feature_id)}}" method="post"
    enctype='multipart/form-data'>
    {{ csrf_field() }}
    <div class="form-group">
        <label for=""> Sản phẩm </label>
        <select name="product" class="form-control" id="">
            @foreach($product as $key =>$pro)
            if($pro->product_id==$edit_value.product_id){
            <option selected value="{{$pro->product_id}}">{{$pro->product_name}}</option>
            }
            else{
            <option selected value="{{$pro->product_id}}">{{$pro->product_name}}</option>
            }
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Đặc trưng </label>
        <select name="feature" class="form-control" id="">

            @foreach($feature as $key =>$fea)
            if($pro->product_id==$edit_value.product_id){
            <option selected value="{{$fea->feature_id}}">{{$fea->feature_name}}</option>
            }
            else{
            <option value="{{$fea->feature_id}}">{{$fea->feature_name}}</option>
            }
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="">Tên đặc trưng sản phẩm</label>
        <input type="text" class="form-control" value="{{$edit_value->product_feature_id}}" id="product-feature-name"
            name="product_feature_name">
    </div>


    <div class="form-group">
        <label for="">convert to HTML</label>
        <textarea class="form-control" id="product-feature-value" name="product_feature_value"
            rows="3">{{$edit_value->product_feature_value}}</textarea>
    </div>
    <div class="form-group">
        <label for="">Hình ảnh sản phẩm</label>
        <input type="file" value="{{$edit_value->product_feature_image}}" class="form-control"
            id="product-feature-image" name="product_feature_image">
        <img src="{{URL::to('public/upload/product/'.$edit_value->product_feature_image)}}" width='100' height='100'
            alt="">
    </div>
    <div class="form-group">
        <label for="">Giá sản phẩm</label>
        <input type="text" class="form-control" value="{{$edit_value->product_feature_price}}"
            id="product-feature-price" name="product_feature_price">
    </div>

    <div class="form-group">
        <label for="">Hiển thị</label>
        <select name="product_feature_status" class="form-control" id="">
            <?php
    if($edit_value->product_feature_status==0){
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
    <button type="submit" class="btn btn-primary">Cập nhật đặc trưng sản phẩm</button>
</form>
@endforeach
@endsection