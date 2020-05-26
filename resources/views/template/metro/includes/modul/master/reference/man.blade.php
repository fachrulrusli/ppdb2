@extends(config('consyst.view_includes').'content')
@section('content-child')
    <!-- BEGIN VALIDATION STATES-->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-cogs"></i>
                <span class="caption-subject sbold uppercase">{!! $pages->title !!}</span>
            </div>
        </div>
        <div class="portlet-body form">
             {!! Form::open(array('id' => 'form-reference')) !!}
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{!! trans('view.ref.form.kode_ref') !!}</label>
                                <div class="input-icon">
                                    <i class="fa fa-pencil-square-o"></i>
                                    {!! Form::text('kode_ref', isset($data->kode_ref) ? $data->kode_ref : '', ['class' => 'form-control','placeholder'=>trans('view.ref.form.m_kode_ref')])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{!! trans('view.ref.form.nama') !!}</label>
                                <div class="input-icon">
                                    <i class="fa fa-pencil-square-o"></i>
                                    {!! Form::text('nama', isset($data->nama) ? $data->nama : '', ['class' => 'form-control','placeholder'=>trans('view.ref.form.m_nama')])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{!! trans('view.ref.form.jenis') !!}</label>
                                   {!! Form::select('jenis', $ref->reference,isset($data->jenis) ? $data->jenis : 1, array('class' => 'form-control select2')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{!! trans('view.ref.form.keterangan') !!}</label>
                                <div class="input-icon">
                                    <i class="fa fa-pencil-square-o"></i>
                                    {!! Form::text('keterangan', isset($data->keterangan) ? $data->keterangan : '', ['class' => 'form-control','placeholder'=>trans('view.ref.form.m_keterangan')])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{!! trans('view.ref.form.status') !!}</label>
                                {!! Form::select('status', array('1' => 'Aktif', '0' => 'Tidak Aktif'),isset($data->status) ? $data->status : 1, array('class' => 'form-control select2')) !!}
                            </div>
                        </div>
                    </div>
                </div>
                @if (isset($action))
                @if ($action==2)
                    {!! Form::hidden('action',  $action ) !!}
                    {!! Form::hidden('id_ref',  $data->id_ref) !!}
                @endif
                @else
                    {!! Form::hidden('action',  1 ) !!}
                @endif
                <div class="form-actions noborder">
                    <button type="button" class="btn dark" id="btnReturn">
                        <i class="fa fa-reply"></i> {!! trans('button.global.back') !!}
                    </button>
                    <button type="submit" id="submit" class="btn blue">
                        <i class="fa fa-save"></i> {!! trans('button.global.save') !!}
                    </button>
                </div>
            {!! Form::close() !!}
            </div>
        </div>
@endsection
@section('script-onpage')
    <script type="application/javascript">
        $(".select2").select2();
        $(document).ready(function() {
            $("#form-reference").submit(function(e){
                e.preventDefault();
                var formData = $('#form-reference').serialize();
                bootbox.confirm("{{trans('message.confirm')}}", function(result) {
                   if(result) 
                   {
                         $.ajax({
                            type: "POST",
                            url: "{{route('post-reference')}}",
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
                                            Consyst.loadForm("{{route('reference')}}");
                                        }, 2000);
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
                Consyst.loadForm("{{route('reference')}}");
            });
        });
    </script>
@endsection
