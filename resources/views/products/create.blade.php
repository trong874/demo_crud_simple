@extends('layouts.master')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thêm sản phẩm</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active" aria-current="page">Form Basics</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Thêm sản phẩm</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('product.store')}}">
                            @csrf
                            <div class="form-group">
                                <label>Tiêu đề sản phẩm</label>
                                <input type="text" name="title" class="form-control" required="faile">
                            </div>
                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="number" name="price" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Mô tả về sản phẩm</label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" required></textarea>
                            </div>
                            <select class="form-control mb-3" name="category_id" required>
                                {{showCategories($categories)}}
                            </select>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </form>
                    </div>
                </div>
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

    </div>
    <?php
    function showCategories($categories, $parent_id = 0, $char = '')
    {
        foreach ($categories as $key => $item)
        {
            // Nếu là chuyên mục con thì hiển thị
            if ($item->parent_id == $parent_id)
            {
                // Xử lý hiển thị chuyên mục
                echo '<option value="'.$item->id.'">'.$char.$item->title.'</option>';

                // Xóa chuyên mục đã lặp
                unset($categories[$key]);

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showCategories($categories, $item->id, $char.'---');
            }
        }
    }
    ?>
@endsection
