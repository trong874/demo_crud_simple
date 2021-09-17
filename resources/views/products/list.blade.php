@extends('layouts.master')
@section('content')
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Simple Tables</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
            </ol>
        </div>
        <div class="card-header py-3 flex-row align-items-center justify-content-between" style="margin-bottom: 30px">
            <form method="GET" action="{{route('product.filter')}}">
                <div class="row">
                    <div class="col-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-indent"></i></span>
                            </div>
                            <input type="text" name="id" value="{{$old_data['id']??''}}" class="form-control"
                                   placeholder="ID" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i
                                        class="fas fa-align-left"></i></span>
                            </div>
                            <input type="text" value="{{$old_data['title']??''}}" name="title" class="form-control"
                                   placeholder="Tiêu đề" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i
                                        class="fas fa-align-justify"></i></span>
                            </div>
                            <select class="custom-select" name="category_id" id="inputGroupSelect01">
                                <option value="">--Tất cả danh mục--</option>
                                {{oldCategory($categories,$old_data['category_id']??'',0,'')}}
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Từ</span>
                            </div>
                            <input type="text" name="price_from" value="{{$old_data['price_from']??0}}"
                                   class="form-control"
                                   placeholder="Giá sản phẩm" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Đến</span>
                            </div>
                            <input type="text" value="{{$old_data['price_to']??''}}" name="price_to"
                                   class="form-control"
                                   placeholder="Giá sản phẩm"
                                   aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        <a href="{{route('product.list')}}" class="btn btn-outline-secondary"><i
                                class="fas fa-window-close"></i>
                            Reset
                        </a>

                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <a class="btn btn-primary" href="{{route('product.create')}}">Thêm sản phẩm</a>
                <div class="row" style="margin: 20px">
                    <div class="col" style="display: inherit;text-align: center">
                        <div class="input-group mb-3" style="margin-bottom: 0px !important;">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Display</span>
                            </div>
                            <input style="max-width: 130px;" id="changePaginate" type="number" class="form-control"
                                   value="{{$paginate}}">
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAll">
                        Xóa mục đã chọn
                    </button>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="deleteAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận thao tác</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Xóa tất cả những sản phẩm đã chọn ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-danger delete_all"
                                    data-url="{{ route('product.destroyAll') }}">Xóa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th><input type="checkbox"  id="master"></th>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Giá sản phẩm</th>
                        <th>Mô tả</th>
                        <th>Danh mục</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products  as $product)
                        <tr>
                            <td><input type="checkbox" class="sub_chk" data-id="{{$product->id}}"></td>
                            <td><a href="#">{{$product->id}}</a></td>
                            <td>{{$product->title}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->category->title}}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#exampleModal{{$product->id}}">
                                    Xóa
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$product->id}}" tabindex="-1"
                                     role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Xác nhận thao
                                                    tác</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn thực sự muốn xóa sản phẩm {{$product->title}} ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close
                                                </button>
                                                <a href="{{route('product.destroy',$product->id)}}"
                                                   class="btn btn-danger">Xóa</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{route('product.edit',$product->id)}}"
                                   class="btn btn-sm btn-warning">Sửa</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="row" style="float:right;margin-right: 100px">
                    {{ $products->links() }}
                </div>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
    <?php
    function oldCategory($categories,$old_category_id, $parent_id = 0, $char = '')
    {
        foreach ($categories as $key => $item)
        {
            // Nếu là chuyên mục con thì hiển thị
            if ($item->parent_id == $parent_id)
            {
                // Xử lý hiển thị chuyên mục
                if($old_category_id == $item->id){
                    echo '<option value="'.$item->id.'" selected>'.$char.$item->title.'</option>';
                }
                else{
                    echo '<option value="'.$item->id.'">'.$char.$item->title.'</option>';
                }

                // Xóa chuyên mục đã lặp
                unset($categories[$key]);

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                oldCategory($categories,$old_category_id, $item->id, $char.'---');
            }
        }
    }
    ?>
    <!--Row-->

    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                    <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div>
<?php

?>

    <script>
        $('#master').on('click', function (e) {
            if ($('#master').is(':checked', true)) {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked', false);
            }
        });
        $('.delete_all').on('click', function (e) {
            var allVals = [];
            $(".sub_chk:checked").each(function () {
                allVals.push($(this).attr('data-id'));
            });


            if (allVals.length <= 0) {
                alert("Chưa chọn mục nào !");
            } else {
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: $(this).data('url'),
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'ids=' + join_selected_values,
                        "_token": "{{ csrf_token() }}",
                        success: function (data) {
                            location.reload();
                            if (data['error']) {
                                alert(data['error']);
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });
                    $.each(allVals, function (index, value) {
                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
            }
        });
        $('#changePaginate').on('input', function () {
            if (e.keyCode == 13) {
                let number = $('#changePaginate').val()
                if (number > 0) {
                    $.ajax({
                        url: '/quan-ly-sp/' + number + '/paginate',
                        method: 'GET',
                        success: function () {
                            window.location.href = '/quan-ly-sp/' + number + '/paginate';
                            console.log(number);
                        }
                    })
                }
            }

        }).on('change', function () {
            let number = $('#changePaginate').val()
            if (number > 0 && number !== null) {
                $.ajax({
                    url: '/quan-ly-sp/' + number + '/paginate',
                    method: 'GET',
                    success: function () {
                        window.location.href = '/quan-ly-sp/' + number + '/paginate';
                        console.log(number)
                    }
                })
            }
        })
    </script>
    <!---Container Fluid-->
@endsection
