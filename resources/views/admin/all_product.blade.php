@extends('admin_layout')
@section('admin-content')
<div>
    <h1>Liệt kê sản phẩm</h1>
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

        <caption>List of product</caption>
        <thead>
            <tr>
                <th scope="col"><input type="checkbox"></th>
                <th scope="col">Thương hiệu</th>
                <th scope="col">Thể loại </th>
                <th scope="col">Tên sản phẩm </th>
                <th scope="col">Miêu tả </th>
                <th scope="col">Nội dung sản phẩm</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Giá </th>
                <th scope="col">Hiển thị </th>

                <th></th>
            </tr>
        </thead>
        <tbody>

            @foreach($all_product as $key =>$pro)
            <tr>
                <th scope="row"><input type="checkbox"></th>
                <td>{{$pro->brand_name}}</td>
                <td>{{$pro->category_name}}</td>
                <td>{{$pro->product_name}}</td>
                <td>{{$pro->product_desc}}</td>
                <td>{{$pro->product_content}}</td>
                <td><img src="public/upload/product/{{($pro->product_image)}}" style='width:100px;height:100px' ;
                        alt=""></td>
                <td>{{$pro->product_price}}</td>
                <td><?php
             if($pro->product_status==0){
               ?>
                    <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span
                            class='fa-styling-off fa fa-toggle-on'></span></a>
                    <?php
              }else{
              ?>
                    <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><span
                            class='fa-styling-on fa fa-toggle-on '></span></a>
                    <?php
              }
             ?>
                </td>

                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{URL::to('/edit-product/'.$pro->product_id)}}"><i
                                class="fa fa-pencil-square-o"></i></a>
                        <a onclick="return confirm('Are you sure you want to delete this item?');"
                            href="{{URL::to('/delete-product/'.$pro->product_id)}}"><i class="fa fa-trash"></i></a>
                    </div>
                </td>
            </tr>

            @endforeach
        </tbody>

    </table>
   {{ $all_product->render() }}

</div>
@endsection