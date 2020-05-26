@extends(config('consyst.view_includes').'content')
@section('content-child')

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class=" icon-users font-dark"></i>
                        <span class="caption-subject bold uppercase"> {!! $pages->title !!}</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover order-column" id="tbl_data">
                        <thead>
                        <tr>
                            <th> ID </th>
                            <th> {!! trans('view.group.table.nama_grup') !!} </th>
                            <th> {!! trans('view.group.table.keterangan') !!} </th>
                            <th class="al-Center"> {!! trans('view.group.table.status') !!} </th>
                            <th> </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection
@section('script-onpage')
    <script type="application/javascript">
        var grid = new Datatable();
        grid.init({
            src: $("#tbl_data"),
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options
                pageLength: '{{$page_record}}',
                ajax: '{!! route('data-group') !!}',
                aoColumns: [
                    { "mData": "id_grup"},
                    { "mData": "nama_grup"},
                    { "mData": "keterangan" },
                    { "mData": "status",sClass: 'al-Center'},
                    { "mData": "action", searchable: false, sClass: 'al-Center'}
                ],
                createdRow: function (row, data, index) {
                    var uri;
                    uri = '{{route('grup-change-status', null)}}';
                    $('td', row).eq(3).html((data['status'] == 1 ) ? Consyst.generateStatusButton(data['id_grup'], uri + '/' + data['id_grup'], data['status'], "") : Consyst.generateStatusButton(data['id_grup'], uri + '/' + data['id_grup'], data['status'], ""));


                },
                "columnDefs": [
                    { "width": "10px", "targets": 0 },
                    { "width": "40px", "targets": 3 },
                    { "width": "30px", "targets": 4 },
                ]
            }
        });
        $("div.toolbar").html('{!! $pages->toolbar !!}');
        $('#refresh').on('click', function () {
            var table = $('#tbl_data').DataTable();
            table.ajax.reload();
        });
        $('.new').on('click', function () {
            Consyst.loadForm("{{route('group-man',['act'=>1, 'id'=>0])}}");
        });
        function ajaxEdit(selector) {
            Consyst.ajaxEdit(selector);
        }
        function showConfirm(selector) {
            var idx = selector.split("-");
            bootbox.confirm("{{trans('message.delete_confirm')}}", function(result) {
                if(result)
                {
                    $.ajax({
                        type: "POST",
                        url: "{{route('post-group')}}",
                        data: {id_grup: idx[1], action: 3, _token: '{{ csrf_token() }}'},
                        beforeSend:
                                function() {
                                    App.blockUI({
                                        btnoxed: true
                                    });
                                },
                        success:
                                function(data) {
                                    App.unblockUI();
                                    if( data.status == 99) {
                                        toastr.success(data.msg);
                                        setTimeout(function(){
                                            var table = $('#tbl_data').DataTable();
                                            table.ajax.reload();
                                        }, 1000);
                                    }
                                    else {
                                        toastr.error(data.msg);
                                        return false;
                                    }
                                },
                        error:
                                function(data) {
                                    App.unblockUI();
                                    toastr.error(data.msg);
                                    return false;
                                }
                    })
                }
                bootbox.hideAll();
                return false;
            });
        }
        function ajaxChangeStatus(selector) {
            bootbox.confirm('{{trans('message.submit_confirm')}}', function (result) {
                if (result === true) {
                    var url = $(selector).attr('data');
                    $.ajax({
                        url: url
                    })
                            .done(function (data) {
                                if (data.status == 0) {
                                    toastr.error(data.msg);
                                    return false;
                                } else if (data.status == 1) {
                                    toastr.success(data.msg);
                                    setTimeout(function(){
                                        var table = $('#tbl_data').DataTable();
                                        table.ajax.reload();
                                    }, 1000);
                                } else {
                                    toastr.error(data.msg);
                                    return false;
                                }
                            })

                }
            });


        }
    </script>
@endsection