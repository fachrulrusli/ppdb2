@extends(config('consyst.view_includes').'content')
@section('content-child')

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class=" icon-user font-dark"></i>
                        <span class="caption-subject bold uppercase"> {!! $pages->title !!}</span>
                    </div>
                </div>
                <div class="portlet-body">
                <div class="row">
                        <div id="toolbar"></div>
                        <div id="gridlist"></div>
                </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
   <style>
        #gridlist {
            height: 700px;
            margin-top: 10px;
        }
    </style>
    <script type="application/javascript">
        $(document).ready(function() {
            $.ajax({
                type: 'POST',
                url: '{{route('data-menu')}}',
                dataType: "json",
                success: function (data) {
                    loadTable(data);
                }
            });
      function loadTable(Data)
        {
            var status =[{
                "ID":1,
                "Name":"Aktif"},{
                "ID":0,
                "Name":"Non Aktif"
            }];
            var lookupMenuGrup = {
                store: new DevExpress.data.CustomStore({
                    key: "id_menu",
                    loadMode: "raw",
                    load: function() {
                        return $.getJSON('{{ route('get-menu') }}');
                    }
                }),
                sort: "nama_menu"
            };
            Consyst.InitGridX("#gridlist");
            $("#gridlist").dxDataGrid({
                dataSource: Data,
                loadPanel: {
                    enabled:true
                },
                "export":{
                    enabled:true,
                    fileName:"{!! $pages->subtitle !!}"
                },
                paging: {
                    pageSize: 15
                },
                groupPanel: {
                    visible: true
                },
                filterRow: {
                    visible: true,
                    applyFilter: "auto"
                },

                headerFilter: {
                    visible: true
                },
                editing: {
                    mode: "batch",
                    allowDeleting: true,
                    allowUpdating: true,
                    allowAdding: true,
                    popup: {
                        title: "Data Menu",
                        showTitle: true,
                        width: 700,
                        height: 500,
                        position: {
                            my: "center",
                            at: "center",
                            of: window
                        }
                    }
                },
                columns: [
                    {
                        dataField: "nama_menu",
                        caption:'Nama Menu'
                    },
                    {
                        dataField: "deskripsi",
                        caption:'Deskripsi'
                    },
                    {
                        dataField: "menu_grup",
                        caption:'Menu Group',
                        lookup: {
                            dataSource: lookupMenuGrup,
                            valueExpr: "id_menu",
                            displayExpr: "nama_menu"
                        }
                    },
                    {
                        dataField: "icon",
                        caption:'Icon'
                    },
                    {
                        dataField: "url",
                        caption:'Url'
                    },
                    {
                        dataField: "urutan",
                        caption:'Urutan'
                    },
                    {
                        dataField: "status",
                        caption:'Status',
                        lookup: {
                            dataSource: status,
                            valueExpr: "ID",
                            displayExpr: "Name"
                        }
                    },
                    {dataField: 'menu_grup', caption: 'Menu utama',alignment: 'center',width:70,allowEditing: false,
                        cellTemplate: function (container, options) {
                            if (options.rowType !== 'groupFooter') {
                                if(options.data.menu_grup==0){
                                    $('<div/>').html('<span class ="label label-success"><i class="fa fa-check-circle"></i></span>')
                                        .appendTo(container);
                                }else{
                                    $('<div/>').html('<a onclick="menu_utama('+options.data.id_menu+')"<span class ="label label-danger"><i class="fa fa-times-circle"></i></span></a>')
                                        .appendTo(container);
                                }
                            }

                        }}
                ],
                onRowInserted: function (info) {
                    $.ajax({
                        type: 'POST',
                        url: '{{route('menu-insert')}}',
                        data: JSON.stringify(info.data),
                        contentType: "application/json; charset=utf-8",
                        traditional: true,
                        success: function (data) {
                            if(data.status===0){
                                Consyst.showNoticeNotify(data.msg);
                            }else{
                                Consyst.showInfoNotify(data.msg);
                                $.ajax({
                                    type: 'POST',
                                    url: '{{route('data-menu')}}',
                                    dataType: "json",
                                    success: function (data) {
                                        loadTable(data);
                                    }
                                });
                            }
                        }
                    });
                },
                onRowRemoved: function (info) {
                    var id =info.data.id_menu;
                    $.ajax({
                        type: 'POST',
                        url: '{{route('menu-delete')}}/'+id,
                        contentType: "application/json; charset=utf-8",
                        traditional: true,
                        success: function (data) {
                            if(data.status===0){
                                Consyst.showNoticeNotify(data.msg);
                            }else{
                                Consyst.showInfoNotify(data.msg)
                            }
                        }

                    });
                },
                onRowUpdated: function (info) {
                    var id =info.key.id_menu;
                    $.ajax({
                        type: 'POST',
                        url: '{{route('menu-edit')}}/'+id,
                        data: JSON.stringify(info.data),
                        contentType: "application/json; charset=utf-8",
                        traditional: true,
                        success: function (data) {
                            if(data.status===0){
                                Consyst.showNoticeNotify(data.msg)
                            }else{
                                Consyst.showInfoNotify(data.msg)
                            }
                        }
                    });
                },
                onCellPrepared: function(e) {
                    if(e.rowType === "data" && e.column.command === "edit") {
                        var isEditing = e.row.isEditing,
                            $links = e.cellElement.find(".dx-link");
                        $links.text("");

                        if(isEditing){
                            $links.filter(".dx-link-save").addClass("dx-icon-save");
                            $links.filter(".dx-link-cancel").addClass("dx-icon-revert");
                        } else {
                            $links.filter(".dx-link-edit").addClass("dx-icon-edit");
                            $links.filter(".dx-link-delete").addClass("dx-icon-trash");
                        }
                    }
                }
        });
        }
    });
        function menu_utama(id) {
            bootbox.confirm('{{trans('message.submit_confirm')}}', function (result) {
                if (result === true) {
                    $.ajax({
                        type: 'POST',
                        url: '{{route('update-menu-utama')}}/'+id,
                        contentType: "application/json; charset=utf-8",
                        traditional: true,
                        success: function (data) {
                            if(data.status===0){
                                Consyst.showNoticeNotify(data.msg);
                            }else{
                                Consyst.showInfoNotify(data.msg)
                            }
                        }
                    });

                }
            });
        }
    </script>
@endsection
