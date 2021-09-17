@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="css/my.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/jquery.nestable.js"></script>

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
                                <option value="" selected>--Tất cả danh mục--</option>
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
                <div class="row" style="margin: 20px">
                    <div class="col" style="display: inherit;text-align: center">
                        <div class="input-group mb-3" style="margin-bottom: 0px !important;">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Display</span>
                            </div>
                            <input style="max-width: 130px;" id="changePaginate" type="number" class="form-control"
                                   value="{{$paginate??0}}">
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAll">
                        Xóa mục đã chọn
                    </button>
                    <a href="{{route('category.create')}}" class="btn btn-success">Thêm danh mục</a>
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
                            Xóa tất cả những danh mục đã chọn ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-danger delete_all"
                                    data-url="{{ route('category.destroyAll') }}">Xóa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            {{showCategories($categories)}}
        </div>
    </div>




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
    function oldCategory($categories, $old_category_id, $parent_id = 0, $char = '')
    {
        foreach ($categories as $key => $item) {
            // Nếu là chuyên mục con thì hiển thị
            if ($item->parent_id == $parent_id) {
                // Xử lý hiển thị chuyên mục
                if ($old_category_id == $item->id) {
                    echo '<option value="' . $item->id . '" selected>' . $char . $item->title . '</option>';
                } else {
                    echo '<option value="' . $item->id . '">' . $char . $item->title . '</option>';
                }
                // Xóa chuyên mục đã lặp

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                oldCategory($categories, $old_category_id, $item->id, $char . '---');
            }
        }
    }

    function showCategories($categories, $parent_id = '', $char = 0)
    {
        foreach ($categories as $key => $item) {
            $hidden = '';
            if ($parent_id == '') {
                $hidden = 'show';
            }
            // Nếu là chuyên mục con thì hiển thị
            if ($item->parent_id == $parent_id) {
                echo '
               <div
               id="collapse-' . $parent_id . '"
                     class="alert alert-info collapse ' . $hidden . ' "
                       style="margin-left: ' . $char . 'px">

                       <input type="checkbox"
                        id="master-' . $item->id . '"
                         class="sub_chk-' . $parent_id . ' checkbox_category"
                           onclick="setId(' . $item->id . ')"
                            data-id="' . $item->id . '">

                     <span
                 data-toggle="collapse"
                  data-target="#collapse-' . $item->id . '"
                   aria-expanded="true"> ' . $item->title . '
                        </span>
<div style="float: right">
<a class="btn btn-sm btn-danger" href="/danh-muc-san-pham/' . $item->id . '/destroy"">Xóa</a>
<a class="btn btn-sm btn-warning" href="/danh-muc-san-pham/' . $item->id . '/edit">Sửa</a>
</div>
        </div>
               ';
                // Xóa chuyên mục đã lặp

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showCategories($categories, $item->id, $char + 30);
            }
        }
    }
    ?>
    <script>
        function setId(id) {
            if ($(`#master-${id}`).is(':checked', true)) {
                console.log('true')
                $(`.sub_chk-${id}`).prop('checked', true);
            } else {
                console.log('false')
                $(`.sub_chk-${id}`).prop('checked', false);
            }
        }


        $('.delete_all').on('click', function (e) {
            var allVals = [];
            $(".checkbox_category:checked").each(function () {
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
