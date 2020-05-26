@extends(config('consyst.view_includes').'content')
@section('content-child')
    <!-- BEGIN CONTENT REF -->
    <div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-dark">
            <i class="icon-cog font-dark"></i>
            <span class="caption-subject bold uppercase">{{$pages->title}}</span>
        </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-header-fixed table-bordered table-hover table-checkable order-column" id="tbl_data">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ trans('view.ref.table.kode_ref') }}</th>
                    <th>{{ trans('view.ref.table.nama') }}</th>
                    <th>{{ trans('view.ref.table.nama_jenis') }}</th>
                    <th>{{ trans('view.ref.table.keterangan') }}</th>
                    <th>{{ trans('view.ref.table.status') }}</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    </div>
    </div>
    <!-- END CONTENT HTML REF -->
@endsection
@section('script-onpage')
<script type="application/javascript">
    $(document).ready(function() {
        var grid = new Datatable();
        grid.init({
            src: $("#tbl_data"),
            dataTable: {
                pageLength: '{{$page_record}}',
                ajax: '{!! route('data-reference') !!}',
                aoColumns: [
                    {"mData": "id_ref", "sTitle": "ID", width: "5%", sClass: 'al-left'},
                    {"mData": "kode_ref", "sTitle": "{{ trans('view.ref.table.kode_ref') }}", width: "12%", sClass: 'al-left'},
                    {"mData": "nama", "sTitle": "{{ trans('view.ref.table.nama') }}", width: "20%"},
                    {"mData": "parent.nama", "sTitle": "{{ trans('view.ref.table.nama_jenis') }}", sClass: 'al-left',"defaultContent": "ROOT    "},
                    {"mData": "keterangan", "sTitle": "{{ trans('view.ref.table.keterangan') }}", sClass: 'al-left'},
                    {"mData": "status", "sTitle": "{{ trans('view.ref.table.status') }}", sClass: 'al-left',width: "10px"},
                    {"mData": "action", orderable: false, searchable: false, sClass: 'al-Center', width: "10px"}
                ],
                createdRow: function (row, data, index) {
                    var uri;
                    $('td', row).eq(5).html((data['status'] == 1 ) ? Consyst.generateStatusButton(data['id_ref'], uri + '/' + data['status'], data['status'], "") : Consyst.generateStatusButton(data['id_ref'], uri + '/' + data['status'], data['status'], ""));
                },
                "columnDefs": [
                ]
             }
        });
        $("div.toolbar").html('{!! $pages->toolbar !!}');
        $('.new').click(function(){
            Consyst.loadForm("{{route('form-reference', array('id'=>'0', 'act'=>'1' ))}}");
        });
    });
    function ajaxChangeStatus(id)
    {
        var idx = id.split("-");
        var status = $(id).attr('data').split("/");
        bootbox.confirm("{{trans('message.update_confirm')}}", function(result) {
           if(result)
           {
                 $.ajax({
                    type: "POST",
                    url: "{{route('post-reference')}}",
                    data: {id_ref: idx[1], status: status[1], action: 4, _token: '{{ csrf_token() }}'},
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
                                    Consyst.loadForm("{{route('reference')}}");
                                }, 3000);
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
                .done(function(data) {
                    //console.log(data);
                });
           }
           bootbox.hideAll();
           return false;
        });
    }

    function rmvRef(id)
    {
        var idx = id.split("-");
        var status = $(id).attr('data').split("/");
        bootbox.confirm("{{trans('message.delete_confirm')}}", function(result) {
           if(result)
           {
                 $.ajax({
                    type: "POST",
                    url: "{{route('post-reference')}}",
                    data: {id_ref: idx[1], status: status[1], action: 3, _token: '{{ csrf_token() }}'},
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
                                    Consyst.loadForm("{{route('reference')}}");
                                }, 3000);
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
                .done(function(data) {
                    //console.log(data);
                });
           }
           bootbox.hideAll();
           return false;
        });

    }


    function editRef(id){
       var url = $(id).attr('data');
       Consyst.loadForm(url);
    }
</script>
@endsection
