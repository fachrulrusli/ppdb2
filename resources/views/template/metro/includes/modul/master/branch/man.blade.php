@extends(config('consyst.view_includes').'content')
@section('content-child')
    <!-- BEGIN VALIDATION STATES-->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-user"></i>
                <span class="caption-subject sbold uppercase">{!! $pages->action!!} {!! $pages->title !!}</span>
            </div>
            <div class="tools">
                <a href="" class="collapse" data-original-title="" title=""> </a>
                <a href="" class="reload" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body form">
            {!! Form::open(array('id' => 'cabang')) !!}
            <div class="form-body">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="#tab_15_1" data-toggle="tab"> 1. Data Utama </a>
                        </li>
                        <li>
                            <a href="#tab_15_2" data-toggle="tab"> 2. Data Penampungan</a>
                        </li>
                        <li>
                            <a href="#tab_15_3" data-toggle="tab"> 3. Cek Cabang Baru</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_15_1">
                            <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{!! trans('view.branch.form.nama_cabang') !!}</label>
                                <div class="input-icon">
                                    <i class="fa fa-bank"></i>
                                    {!! Form::text('nama_cabang', isset($data->nama_cabang) ? $data->nama_cabang : '', ['class' => 'form-control','placeholder'=>trans('view.branch.form.m_nama_cabang'),'maxlenght' => '50','required'])!!}
                             </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{!! trans('view.branch.form.regional') !!}</label>
                                <div class="input-icon">
                                    <i class="fa fa-map"></i>
                                    {!! Form::text('regional', isset($data->regional) ? $data->regional : '', ['class' => 'form-control','placeholder'=>trans('view.branch.form.m_regional'),'maxlenght' => '4','required'])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">{!! trans('view.branch.form.id_kota') !!}</label>
                                {!! Form::select('id_kota', $ref->kota ,isset($data->id_kota) ? $data->id_kota : '',array('class' => 'form-control select2','required')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{!! trans('view.branch.form.kode_cabang') !!}</label>
                                     <div class="input-icon">
                                    <i class="fa fa-barcode"></i>
                                {!! Form::text('id_cabang', isset($data->id_cabang) ? $data->id_cabang : '', ['class' => 'form-control','maxlenght' => '4','placeholder'=>trans('view.branch.form.m_kode_cabang'),'required'])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{!! trans('view.branch.form.urutan') !!}</label>
                                <div class="input-icon">
                                    <i class="fa fa-sort-amount-desc"></i>
                                    {!! Form::text('urutan', isset($data->urutan) ? $data->urutan : '', ['class' => 'form-control','placeholder'=>trans('view.branch.form.m_urutan')])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{!! trans('view.branch.form.bm') !!}</label>
                                <div class="input-icon">
                                    <i class="fa fa-user"></i>
                                    {!! Form::text('bm', isset($data->bm) ? $data->bm : '', ['class' => 'form-control','placeholder'=>trans('view.branch.form.m_bm'),'maxlenght' => '8','required'])!!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <label>{!! trans('view.branch.form.rm') !!}</label>
                                <div class="input-icon">
                                    <i class="fa fa-user"></i>
                                    {!! Form::text('rm', isset($data->rm) ? $data->rm : '', ['class' => 'form-control','placeholder'=>trans('view.branch.form.m_rm'),'maxlenght' => '8','required'])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{!! trans('view.branch.form.tgl_berdiri') !!}</label>
                                <div class="input-icon">
                                    <i class="fa fa-calendar"></i>
                                    {!! Form::text('tgl_berdiri', isset($data->tgl_berdiri) ? $data->tgl_berdiri : '', ['class' => 'form-control datepicker','placeholder'=>trans('view.branch.form.m_tgl_berdiri'),'required'])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{!! trans('view.branch.form.alamat') !!}</label>
                                <div class="input-icon">
                                    <i class="fa fa-map-signs"></i>
                                    {!! Form::text('alamat', isset($data->alamat) ? $data->alamat : '', ['class' => 'form-control','placeholder'=>trans('view.branch.form.m_alamat'),'maxlenght' => '500','required'])!!}
                                </div>
                            </div>
                        </div>
                    </div>





                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">{!! trans('view.branch.form.id_bank') !!}</label>
                                {!! Form::select('id_bank', $ref->bank,isset($data->id_bank) ? $data->id_bank : '',array('class' => 'form-control select2','required')) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{!! trans('view.branch.form.a_n_rek') !!}</label>
                                <div class="input-icon">
                                    <i class="fa fa-credit-card"></i>
                                    {!! Form::text('atas_nama_rekening', isset($data->atas_nama_rekening) ? $data->atas_nama_rekening : '', ['class' => 'form-control','placeholder'=>trans('view.branch.form.m_a_n_rek'),'maxlenght' => '50','required'])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{!! trans('view.branch.form.no_rekening') !!}</label>
                                <div class="input-icon">
                                    <i class="fa fa-credit-card"></i>
                                    {!! Form::text('no_rekening', isset($data->no_rekening) ? $data->no_rekening: '', ['class' => 'form-control','placeholder'=>trans('view.branch.form.m_no_rekening'),'maxlenght' => '50','required'])!!}
                                </div>
                            </div>
                        </div>
                    </div>
          

                     <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <label>Kode Lama</label>
                                <div class="input-icon">
                                    <i class="fa fa-barcode"></i>
                                    {!! Form::text('kode_vendor', isset($data->kode_vendor) ? $data->kode_vendor : '', ['class' => 'form-control','placeholder'=>'Kode Lama','maxlenght' => '8','required'])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{!! trans('view.branch.form.jenis') !!}</label>
                                <div class="input-icon">
                                        {!! Form::select('jenis', array('1' => 'Pinjaman', '2' => 'Simpanan', '3'=>'Pinjaman - Simpanan'),isset($data->jenis) ? $data->jenis : 3,array('class' => 'form-control select2')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{!! trans('view.user.form.status') !!}</label>
                                <div class="input-icon">
                                     {!! Form::select('status', array('1' => 'Aktif', '0' => 'Non Aktif'),isset($data->status) ? $data->status : 0,array('class' => 'form-control select2')) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions noborder">
                        <button type="button" class="btn dark" id="btnReturn"><i class="fa fa-reply"></i> {!! trans('button.global.back') !!}</button>
                        <button type="submit" id="submit" class="btn blue"><i class="fa fa-save"></i> {!! trans('button.global.save') !!}</button>
                    </div>
                        </div>

                        <div class="tab-pane" id="tab_15_2">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        {!! Form::label('penampungan_da', trans("view.branch.form.penampungan_da"), ['class' => 'control-label col-sm-3']) !!}
                                        <div class="col-md-6">    
                                        {!! Form::text('penampungan_da', isset($data->penampungan_da) ? $data->penampungan_da : '', ['class' => 'form-control','placeholder'=>trans("view.branch.form.penampungan_da")])   !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="row">
                                         {!! Form::label('penampungan_titipan_mps', trans("view.branch.form.penampungan_titipan_mps"), ['class' => 'control-label col-sm-3']) !!}
                                        <div class="col-md-6">    
                                         {!! Form::text('penampungan_titipan_mps', isset($data->penampungan_titipan_mps) ? $data->penampungan_titipan_mps : '', ['class' => 'form-control','placeholder'=>trans("view.branch.form.penampungan_titipan_mps")])   !!}
                                        </div>
                                    </div>
                                </div>
                            </div>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    {!! Form::label('penampungan_titipan_mpp', trans("view.branch.form.penampungan_titipan_mpp"), ['class' => 'control-label col-sm-3']) !!}
                                    <div class="col-md-6">    
                                    {!! Form::text('penampungan_titipan_mpp', isset($data->penampungan_titipan_mpp) ? $data->penampungan_titipan_mpp : '', ['class' => 'form-control','placeholder'=>trans("view.branch.form.penampungan_titipan_mpp")])   !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"> 
                                <div class="row">
                                     {!! Form::label('penampungan_titipan_bpa', trans("view.branch.form.penampungan_titipan_bpa"), ['class' => 'control-label col-sm-3']) !!}
                                    <div class="col-md-6">    
                                     {!! Form::text('penampungan_titipan_bpa', isset($data->penampungan_titipan_bpa) ? $data->penampungan_titipan_bpa : '', ['class' => 'form-control','placeholder'=>trans("view.branch.form.penampungan_titipan_bpa")])   !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    {!! Form::label('penampungan_titipan_bkt', trans("view.branch.form.penampungan_titipan_bkt"), ['class' => 'control-label col-sm-3']) !!}
                                    <div class="col-md-6">    
                                    {!! Form::text('penampungan_titipan_bkt', isset($data->penampungan_titipan_bkt) ? $data->penampungan_titipan_bkt : '', ['class' => 'form-control','placeholder'=>trans("view.branch.form.penampungan_titipan_bkt")])   !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"> 
                                <div class="row">
                                     {!! Form::label('penampungan_titipan_bpp', trans("view.branch.form.penampungan_titipan_bpp"), ['class' => 'control-label col-sm-3']) !!}
                                    <div class="col-md-6">    
                                     {!! Form::text('penampungan_titipan_bpp', isset($data->penampungan_titipan_bpp) ? $data->penampungan_titipan_bpp : '', ['class' => 'form-control','placeholder'=>trans("view.branch.form.penampungan_titipan_bpp")])   !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    {!! Form::label('penampungan_titipan_bkpt', trans("view.branch.form.penampungan_titipan_bkpt"), ['class' => 'control-label col-sm-3']) !!}
                                    <div class="col-md-6">    
                                    {!! Form::text('penampungan_titipan_bkpt', isset($data->penampungan_titipan_bkpt) ? $data->penampungan_titipan_bkpt : '', ['class' => 'form-control','placeholder'=>trans("view.branch.form.penampungan_titipan_bkpt")])   !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"> 
                                <div class="row">
                                     {!! Form::label('penampungan_titipan_bkpa', trans("view.branch.form.penampungan_titipan_bkpa"), ['class' => 'control-label col-sm-3']) !!}
                                    <div class="col-md-6">    
                                     {!! Form::text('penampungan_titipan_bkpa', isset($data->penampungan_titipan_bkpa) ? $data->penampungan_titipan_bkpa : '', ['class' => 'form-control','placeholder'=>trans("view.branch.form.penampungan_titipan_bkpa")])   !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    {!! Form::label('penampungan_titipan_mpp_ip', trans("view.branch.form.penampungan_titipan_mpp_ip"), ['class' => 'control-label col-sm-3']) !!}
                                    <div class="col-md-6">    
                                    {!! Form::text('penampungan_titipan_mpp_ip', isset($data->penampungan_titipan_mpp_ip) ? $data->penampungan_titipan_mpp_ip : '', ['class' => 'form-control','placeholder'=>trans("view.branch.form.penampungan_titipan_mpp_ip")])   !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"> 
                                <div class="row">
                                     {!! Form::label('penampungan_titipan_mpp_pp', trans("view.branch.form.penampungan_titipan_mpp_pp"), ['class' => 'control-label col-sm-3']) !!}
                                    <div class="col-md-6">    
                                     {!! Form::text('penampungan_titipan_mpp_pp', isset($data->penampungan_titipan_mpp_pp) ? $data->penampungan_titipan_mpp_pp : '', ['class' => 'form-control','placeholder'=>trans("view.branch.form.penampungan_titipan_mpp_pp")])   !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                          <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    {!! Form::label('penampungan_titipan_mpp_kt', trans("view.branch.form.penampungan_titipan_mpp_kt"), ['class' => 'control-label col-sm-3']) !!}
                                    <div class="col-md-6">    
                                    {!! Form::text('penampungan_titipan_mpp_kt', isset($data->penampungan_titipan_mpp_kt) ? $data->penampungan_titipan_mpp_kt : '', ['class' => 'form-control','placeholder'=>trans("view.branch.form.penampungan_titipan_mpp_kt")])   !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"> 
                                <div class="row">
                                     {!! Form::label('penampungan_tfp_spsw', trans("view.branch.form.penampungan_tfp_spsw"), ['class' => 'control-label col-sm-3']) !!}
                                    <div class="col-md-6">    
                                     {!! Form::text('penampungan_tfp_spsw', isset($data->penampungan_tfp_spsw) ? $data->penampungan_tfp_spsw : '', ['class' => 'form-control','placeholder'=>trans("view.branch.form.penampungan_tfp_spsw")])   !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    {!! Form::label('norek_konfiden', trans("view.branch.form.norek_konfiden"), ['class' => 'control-label col-sm-3']) !!}
                                    <div class="col-md-6">    
                                    {!! Form::text('norek_konfiden', isset($data->norek_konfiden) ? $data->norek_konfiden : '', ['class' => 'form-control','placeholder'=>trans("view.branch.form.norek_konfiden")])   !!}
                                    </div>
                                </div>
                            </div>
                           
                        </div>
          
                        <div class="form-actions noborder">
                            <button type="button" class="btn dark" id="btnReturn2"><i class="fa fa-reply"></i> {!! trans('button.global.back') !!}</button>
                            <button type="submit" id="submit" class="btn blue"><i class="fa fa-save"></i> {!! trans('button.global.save') !!}</button>
                        </div>

                    </div><!--TUTUP TAB 2-->

                      <div class="tab-pane" id="tab_15_3">
                        <div id="gridlistnew">
                      </div>

            @if (isset($action))
                @if ($action==2)
                    {!! Form::hidden('action',  $action ) !!}
                    {!! Form::hidden('id',  $data->id_cabang ) !!}
                @endif
            @else
                {!! Form::hidden('action',  1 ) !!}
            @endif

            {!! Form::close() !!}
        </div>
        </div>
    </div>
@endsection
@section('script-onpage')
  <style>
        #gridlistnew {

            height: 700px;
            margin-top: 10px;
        }
        .options {
            margin-top: 5px;
        }

        .options > div > div:first-child {
            float: left;
            margin: 1px 20px 1px 0;
        }
    </style>
    <script type="application/javascript">


        $(document).ready(function() {
              $.ajax({
                type: 'POST',
                url: '{{route('data-branch-new')}}',
                dataType: "json",
                success: function (data) {

                    loadTablenew(data);

                }
            });

        
      function loadTablenew(Data)
        {
            Consyst.InitGridX("#gridlistnew");
            $("#gridlistnew").dxDataGrid({
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
                    mode: "popup",
                    allowDeleting: false,
                    allowUpdating: false,
                    allowAdding: true,
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
                        dataField: "Kd_cabang",
                        caption:'ID Cabang'
                    },
                    {
                        dataField: "NamaCabang",
                        caption:'Nama Cabang'
                    },
                  
                    {
                        dataField: "alamat1",
                        caption:'Alamat'
                    },                   
                    {
                        caption :"#",
                        width:'70px',
                        alignment:'center',
                        cellTemplate: function (container, options) {
                        var id = options.data.Kd_cabang;
                        var nama = options.data.NamaCabang;
                        var alamat = options.data.alamat1;
                              // $('td', row).eq(4).html((data['status'] == 1 ) ? Consyst.generateStatusButton(data['id_cabang'], uri + '/' + data['id_cabang'], data['status'], "") : Consyst.generateStatusButton(data['id_cabang'], uri + '/' + data['id_cabang'], data['status'], ""));
                         $("<div>").html("<a onclick='fungsi()' href='{{route('post-branch-baru')}}?id_cabang=" + id + "&nama=" + nama +"&alamat=" + alamat +"' class='label label-success'><i class='fa fa-save'></i> Save</a>").appendTo(container);


                        }
                    },
                   
                ],
                onRowInserting: function (info) {
                    var id =info.data.id_cabang;
                    $.ajax({
                        type: 'POST',
                        url: '{{route('post-branch')}}?id_cabang='+id+'&action=3',
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
            Consyst.InitGridX("#gridContainer");
        }   
        $('#btnPlus').click(function(){
            Consyst.loadForm("{{route('form-branch',['act'=>1, 'id'=>0])}}");
        });




            $(".select2").select2();
            $('.datepicker').datepicker();
            $("#cabang").submit(function(e){
                e.preventDefault();
                var formData = $('#cabang').serialize();
                bootbox.confirm("{{trans('message.confirm')}}", function(result) {
                   if(result) 
                   {
                         $.ajax({
                            type: "POST",
                            url: "{{route('post-branch')}}",
                            data: formData,
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
                                            Consyst.loadForm("{{route('branch')}}");
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
                        .done(function(data) {
                            //console.log(data);
                        });
                   }
                   bootbox.hideAll();
                   return false;
                });
            });
            $('#btnReturn').click(function(){
                Consyst.loadForm("{{route('branch')}}");
            });
             $('#btnReturn2').click(function(){
                Consyst.loadForm("{{route('branch')}}");
            });
        });


    function fungsi() {
        // alert('test');
         swal({
                    title: "Cabang Berhasil Disimpan",
                    text: "",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    html: true,
                    closeOnConfirm: false,
                    closeOnCancel: false,
                    showLoaderOnConfirm:true
                });

        }


    </script>
@endsection
