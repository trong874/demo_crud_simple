@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="css/my.css">
    <menu id="nestable-menu">
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
                    <button type="button" class="btn btn-outline-primary" data-action="expand-all">Expand All</button>
                    <button type="button" class="btn btn-outline-primary" data-action="collapse-all">Collapse All</button>
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
    </menu>
    <div class="dd" id="nestable" style="margin-left: 20px;">
        <ol class="dd-list">
            {{showCategory($categories)}}
        </ol>
    </div>
    <?php

    function showCategory($categories, $parent_id = '')
    {
        foreach ($categories as $key => $item) {
            // Nếu là chuyên mục con thì hiển thị
            if ($item->parent_id == $parent_id) {
                // Xử lý hiển thị chuyên mục
                echo '<li class="dd-item" data-id="' . $item->id . '">
                 <div class="dd-handle" ><input type="checkbox"
                        id="master-' . $item->id . '"
                         class="sub_chk-' . $parent_id . ' checkbox_category"
                           onclick="setId(' . $item->id . ')"
                            onmousedown="disabledEventPropagation(event)"
                            data-id="' . $item->id . '"
                            style="margin-right:10px">' . $item->title . '
                    <div style="float: right" onmousedown="disabledEventPropagation(event)">
                        <a class="btn btn-sm btn-danger" href="/danh-muc-san-pham/' . $item->id . '/destroy"">Xóa</a>
                        <a class="btn btn-sm btn-warning" href="/danh-muc-san-pham/' . $item->id . '/edit">Sửa</a>
                    </div>
                 </div>';
                if ($categories[$key]->category->all() != []) {
                    echo ' <ol class="dd-list">';
                    showCategory($categories[$key]->category, $item->id);
                    echo '</ol>';
                }
                echo '</li>';
            }
        }
    }

    ?>
    {{--<div class="dd" id="nestable2">--}}
    {{--    <ol class="dd-list">--}}
    {{--        <li class="dd-item" data-id="13">--}}
    {{--            <div class="dd-handle">Item 13</div>--}}
    {{--        </li>--}}
    {{--        <li class="dd-item" data-id="14">--}}
    {{--            <div class="dd-handle">Item 14</div>--}}
    {{--        </li>--}}
    {{--        <li class="dd-item" data-id="15">--}}
    {{--            <div class="dd-handle">Item 15</div>--}}
    {{--            <ol class="dd-list">--}}
    {{--                <li class="dd-item" data-id="16"><div class="dd-handle">Item 16</div></li>--}}
    {{--                <li class="dd-item" data-id="17"><div class="dd-handle">Item 17</div></li>--}}
    {{--                <li class="dd-item" data-id="18"><div class="dd-handle">Item 18</div></li>--}}
    {{--            </ol>--}}
    {{--        </li>--}}
    {{--    </ol>--}}
    {{--</div>--}}

{{--    <textarea id="nestable-output" disabled="true"></textarea>--}}
    {{--<textarea id="nestable2-output"></textarea>--}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/jquery.nestable.js"></script>
    <script>
        function disabledEventPropagation(event)
        {
            if (event.stopPropagation){
                event.stopPropagation();
            }
            else if(window.event){
                window.event.cancelBubble=true;
            }
        }
        $(document).ready(function () {
            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
                $.ajax({
                    method: "POST",
                    url: "danh-muc-san-pham/update-list",
                    data: {
                        list: list.nestable('serialize'),
                        "_token": "{{ csrf_token() }}",
                    }
                }).fail(function(jqXHR, textStatus, errorThrown){
                    alert("Unable to save new list order: " + errorThrown);
                });
            };
            // activate Nestable for list 1
            $('#nestable').nestable({
                group: 1
            })
                .on('change', updateOutput);

            // activate Nestable for list 2
            // $('#nestable2').nestable({
            //     group: 1
            // })
            //     .on('change', updateOutput);

            // output initial serialised data
            console.log()
            updateOutput($('#nestable').data('output', $('#nestable-output')));
            // updateOutput($('#nestable2').data('output', $('#nestable2-output')));
            $('#nestable-menu').on('click', function (e) {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });

            $('#nestable3').nestable();

        });
    </script>
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
@endsection
