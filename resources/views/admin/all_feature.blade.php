@extends('admin_layout')
@section('admin-content')
<div>
    <h1>Liệt kê đặc trưng sản phẩm</h1>
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

        <caption>List of feature</caption>
        <thead>
            <tr>
                <th scope="col"><input type="checkbox"></th>
                <th>STT</th>
                <th scope="col">Tên danh mục </th>
                <th>Miêu tả</th>
                <th>Giá</th>
                <th scope="col">Hiển thị </th>

                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($all_feature as $key =>$fea)
            <tr>
                <th scope="row"><input type="checkbox"></th>
                <td>{{$fea->STT}}</td>
                <td>{{$fea->feature_name}}</td>
                <td>{{$fea->feature_desc}}</td>
                <td>{{$fea->feature_price}}</td>
                <td><?php
             if($fea->feature_status==0){
               ?>
                    <a href="{{URL::to('/active-feature/'.$fea->feature_id)}}"><span
                            class='fa-styling-off fa fa-toggle-on'></span></a>
                    <?php
              }else{
              ?>
                    <a href="{{URL::to('/unactive-feature/'.$fea->feature_id)}}"><span
                            class='fa-styling-on fa fa-toggle-on '></span></a>
                    <?php
              }
             ?>
                </td>

                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{URL::to('/edit-feature/'.$fea->feature_id)}}"><i
                                class="fa fa-pencil-square-o"></i></a>
                        <a onclick="return confirm('Are you sure you want to delete this item?');"
                            href="{{URL::to('/delete-feature/'.$fea->feature_id)}}"><i class="fa fa-trash"></i></a>
                    </div>
                </td>
            </tr>

            @endforeach
        </tbody>

    </table>
    <nav aria-label="Page navigation example">
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