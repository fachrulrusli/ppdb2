@extends(config('consyst.view_includes').'content')
@section('content-child')

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class=" icon-user font-dark"></i>
                        <span class="caption-subject bold uppercase">Berita</span>
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
                url: '{{route('data-berita')}}',
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
                    allowUpdating: false,
                    allowAdding: false,
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
                        dataField: "title",
                        caption:'Title'
                    },
                    {
                        dataField: "isi",
                        caption:'Description'
                    },
                    {
                        dataField: "image",
                        caption:'Image'
                    },
                ],
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
