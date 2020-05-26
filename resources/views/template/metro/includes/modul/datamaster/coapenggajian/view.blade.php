@extends(config('consyst.view_includes').'content')
@section('content-child')
    <div class="row">
        <div class="col-md-12">
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
        </div>
    </div>
    <script type="application/javascript">
        $(document).ready(function() {
            $.ajax({
                type: 'POST',
                url: '{{route('data-coapenggajian')}}',
                dataType: "json",
                success: function (data) {
                    loadTable(data);
                }
            });
      function loadTable(Data)
        {

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
                    mode: "row",
                    allowDeleting: false,
                    allowUpdating: true,
                    allowAdding: true,
                    popup: {
                        title: "Data Kode Transaksi",
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
                        dataField: "kode",
                        caption:'Kode'
                    },
                    {
                        dataField: "keterangan",
                        caption:'Keterangan'
                    },
                    {
                        dataField: "dk",
                        caption:'DK'
                    },
                    {
                        dataField: "glcode",
                        caption:'Kode GL',
                        // dataType: "date",
                        // format: "longTime"
                    },
                    {
                        dataField: "glcodenew",
                        caption:'Kode GL Baru',
                        // dataType: "date",
                        // format: "longTime"
                    },
                    {
                        dataField: "kodevendor",
                        caption:'Kode Vendor',
                        // dataType: "date",
                        // format: "longTime"
                    }
                ],
                onRowInserted: function (info) {
                    $.ajax({
                        type: 'POST',
                        url: '{{route('coapenggajian-insert')}}',
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
                onRowRemoved: function (info) {
                    var id =info.data.kode;
                    $.ajax({
                        type: 'POST',
                        url: '{{route('coapenggajian-delete')}}/'+id,
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
                    var id =info.key.kode;
                    $.ajax({
                        type: 'POST',
                        url: '{{route('coapenggajian-edit')}}/'+id,
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
    </script>
@endsection
