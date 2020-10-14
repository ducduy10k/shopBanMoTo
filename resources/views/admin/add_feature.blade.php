@extends('admin_layout')
@section('admin-content')
<div style="text-align:center;">
    <h1> Thêm danh đặc trưng</h1>
    
</div>
<?php
			$message = Session::get('message');
			if($message){
				echo '<span style="color:green;">'. $message.'</span>';
				Session::put('message',null);
			}
			?>
<form action="{{URL::to('/save-feature')}}" method="post">
{{ csrf_field() }}
  <div class="form-group">
    <label for="">Tên đặc trưng</label>
    <input type="text" class="form-control" id="feature-name" name="feature_name" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="">STT</label>
    <input type="text" class="form-control" id="STT" name="STT">
  </div>
  <div class="form-group">
    <label for="">Mô tả</label>
    <textarea class="form-control" id="feature-descreption" name="feature_descreption" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="">Giá</label>
    <input type="text" class="form-control" id="feature-price" name="feature_price">
  </div>
 
  <div class="form-group">
    <label for="">Hiển thị</label>
    <select name="feature_status" class="form-control" id="display-feature">
      <option value="0">Ẩn</option>
      <option value="1">Hiện</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Thêm đặc tính</button>
</form>
@endsection