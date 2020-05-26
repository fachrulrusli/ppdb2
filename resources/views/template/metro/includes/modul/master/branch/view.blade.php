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
                  <div class="btn-group">

                    <button type="button" class="btn btn-success " id="btnPlus"><i class="fa fa-plus"></i>{!! trans('button.global.new') !!}</button>
                    <!--             <button type="button" class="btn btn-default " id="btnCopy"><i class="fa fa-copy"></i>{!! trans('button.simpanan.copy_data') !!}</button> -->
                </div>
                <div class="row">
                        <div id="toolbar"></div>
                        <div id="gridlist"></div>
                </div>

                  <div id="popup">
                    <div class="progress-info">
                        <span id="info"></span>
                    </div>
                    <div id="progressBarStatus"></div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->


                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <script type="application/javascript">
        $(document).ready(function() {
            $.ajax({
                type: 'POST',
                url: '{{route('data-branch')}}',
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
                "export":{
                    enabled:true,
                    fileName:"{!! $pages->subtitle !!}"
                },
                paging: {
                    pageSize: 10
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
                    mode: "popup",
                    allowDeleting: true,
                    allowUpdating: false,
                    allowAdding: false,
                    popup: {
                        title: "Data Member",
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
                        dataField: "id_cabang",
                        caption:'ID'
                    },
                    {
                        dataField: "nama_cabang",
                        caption:'Nama Cabang'
                    },
                    {
                        dataField: "kode_vendor",
                        caption:'Kode Lama'
                    },
                    {
                        dataField: "regional",
                        caption:'Regional'
                    },
                    {
                        caption :"Status",
                        width:'70px',
                        alignment:'center',
                        cellTemplate: function (container, options) {
                         var uri;
                         uri = '{{route('branch-change-status', null)}}';
                              // $('td', row).eq(4).html((data['status'] == 1 ) ? Consyst.generateStatusButton(data['id_cabang'], uri + '/' + data['id_cabang'], data['status'], "") : Consyst.generateStatusButton(data['id_cabang'], uri + '/' + data['id_cabang'], data['status'], ""));
                         $('<div>').html((options.data.status == 1 ) ? Consyst.generateStatusButton(options.data.id_cabang, uri + '/' + options.data.id_cabang, options.data.status, "") : Consyst.generateStatusButton(options.data.id_cabang, uri + '/' + options.data.id_cabang, options.data.status, "")).appendTo(container);


                        }
                    },
                    {
                        caption :"#",
                        width:'70px',
                        alignment:'center',
                        cellTemplate: function (container, options) {
                            $('<div/>').html(Consyst.generateEditButton(options.data.id_cabang))
                                    .on('click', function () {

                                        var url = "{{route('form-branch', array('id'=>'', 'act'=>'2' ))}}/"+options.data.id_cabang;

                                        Consyst.loadForm(url);
                                    })
                                    .appendTo(container);
                        }
                    }
                ],

                onRowRemoved: function (info) {
                    var id =info.data.id_cabang;
                    $.ajax({
                        type: 'POST',
                        url: '{{route('post-branch')}}?id_cabang='+id+'&action=3',
                        contentType: "application/json; charset=utf-8",
                        traditional: true,
                        success: function (data) {
                            if(data.status===0){
                                Consyst.showNoticeNotify(data.msg)
                                Consyst.loadForm("{{route('branch')}}");
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
            Consyst.InitGridX("#gridContainer");
        }
        $('#btnPlus').click(function(){
            Consyst.loadForm("{{route('form-branch',['act'=>1, 'id'=>0])}}");
        });
    });
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
                                        Consyst.loadForm("{{route('branch')}}");
                                    });
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
