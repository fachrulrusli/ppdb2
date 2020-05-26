@extends(config('consyst.view_includes').'content')
@section('content-child')
    <!-- BEGIN VALIDATION STATES-->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-layers font-dark"></i>
                <span class="caption-subject sbold uppercase">{!! $pages->action!!} {!! $pages->title !!}</span>
            </div>
        </div>
        <div class="portlet-body form">
            {!! Form::open(array('id' => 'group')) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{!! trans('view.group.form.nama_grup') !!}</label>
                            <div class="input-icon">
                                <i class="fa fa-flag-o"></i>
                                {!! Form::text('nama_grup', isset($data->nama_grup) ? $data->nama_grup : '', ['class' => 'form-control','placeholder'=>trans("view.group.form.nama_grup"),'required'])   !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{!! trans('view.group.form.keterangan') !!}</label>
                            <div class="input-icon">
                                <i class="fa fa-file-text"></i>
                                {!! Form::text('keterangan', isset($data->keterangan) ? $data->keterangan : '', ['class' => 'form-control','placeholder'=>trans('view.group.form.keterangan')])!!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="single" class="control-label">{!! trans('view.group.form.status') !!}</label>
                            {!! Form::select('status', array('1' => 'Aktif', '0' => 'Non Aktif'),isset($data->status) ? $data->status : 1,array('class' => 'form-control select2','required')) !!}
                        </div>
                    </div>
                </div>
            </div>
            @if (isset($action))
                @if ($action==2)
                    {!! Form::hidden('action',  $action ) !!}
                    {!! Form::hidden('id',  $data->id_grup ) !!}
                @endif
            @else
                {!! Form::hidden('action',  1 ) !!}
            @endif
            <div class="form-actions noborder">
                <button type="button" class="btn dark" id="btnReturn"><i class="fa fa-reply"></i> {!! trans('button.global.back') !!}</button>
                <button type="submit" class="btn blue"><i class="fa fa-save"></i> {!! trans('button.global.save') !!}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('script-onpage')
    <script type="application/javascript">
        $(document).ready(function() {
            $(".select2").select2();
            $("#group").submit(function(e){
                e.preventDefault();
                var formData = $('#group').serialize();
                bootbox.confirm("{{trans('view.menu.confirm.title')}}", function(result) {
                    if(result)
                    {
                        $.ajax({
                            type: "POST",
                            url: "{{route('post-group')}}",
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
                                                Consyst.loadForm("{{route('group')}}");
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
                Consyst.loadForm("{{route('group')}}");
            });
        });
    </script>
@endsection
