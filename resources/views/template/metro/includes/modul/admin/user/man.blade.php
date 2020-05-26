@extends(config('consyst.view_includes').'content')
@section('content-child')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-user"></i>
                <span class="caption-subject sbold uppercase">{!! $pages->action!!} {!! $pages->title !!}</span>

            </div>
        </div>
        {!! $pages->title !!}
        <div class="portlet-body form">
            <div id="alertcontent"> </div>
            {!! Form::open(array('id' => 'user')) !!}
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{!! trans('view.user.form.username') !!}</label>
                                <div class="input-icon">
                                    <i class="fa fa-user"></i>
                                    {!! Form::text('username', isset($data->username) ? $data->username : '', ['class' => 'form-control','placeholder'=>trans('view.user.form.m_username'),'required',$pages->readonly])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{!! trans('view.user.form.name') !!}</label>
                                <div class="input-icon">
                                    <i class="fa fa-user"></i>
                                    {!! Form::text('nama_user', isset($data->nama_user) ? $data->nama_user : '', ['class' => 'form-control','placeholder'=>trans('view.user.form.m_name'),'required'])!!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="multiple" class="control-label">{!! trans('view.user.form.grup') !!}</label>
                                {!! Form::select('grup[]',$ref->grup,isset($grup) ? $grup : 1,array('class' => 'form-control select2', 'multiple'=>'multiple','required')) !!}
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>{!! trans('view.user.form.pass') !!} Baru</label>
                                    <div class="input-icon">
                                        <i class="fa fa-key"></i>
                                        <input type="password" name="password" id="password" class="form-control required" placeholder="{!! trans('view.user.form.pass') !!}...">
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{!! trans('view.user.form.k_pass') !!}</label>
                                <div class="input-icon">
                                    <i class="fa fa-key"></i>
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control required" placeholder="{!! trans('view.user.form.k_pass') !!}...">
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="single" class="control-label">{!! trans('view.user.form.status') !!}</label>
                                {!! Form::select('status', array('1' => 'Aktif', '0' => 'Non Aktif'),isset($data->status) ? $data->status : 1,array('class' => 'form-control select2','required')) !!}
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="single" class="control-label">Email</label>
                                <div class="input-icon">
                                    <i class="fa fa-envelope"></i>
                                {!! Form::text('email', isset($data->email) ? $data->email : '', ['class' => 'form-control'])!!}
                            </div>
                            </div>
                        </div>
                    </div>
                   
                   
                </div>

            @if (isset($act))
                @if ($act==2)
                    {!! Form::hidden('action',  $act ) !!}
                    {!! Form::hidden('id',  $data->id_user  ) !!}
                @endif
            @else
                {!! Form::hidden('action',  1 ) !!}
            @endif
            <div class="form-actions noborder">
                <button type="button" class="btn dark" id="btnReturn"><i class="fa fa-reply"></i> {!! trans('button.global.back') !!}</button>
                <button type="button" class="btn blue" id="btsubmit"><i class="fa fa-save"></i> {!! trans('button.global.save') !!}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('script-onpage')
    <script type="application/javascript">
        $(document).ready(function() {

            $(".select2").select2();
            var jenis = $("#jenis").val();
            
            $('#btnReturn').click(function(){
                Consyst.loadForm("{{route('user')}}");
            });
            $('#btsubmit').click( function (e) {

                e.preventDefault();

                var pass1 = $("#user").find('#password').val()
                var pass2 = $("#user").find('#confirm_password').val();
                var otor1 = $("#user").find('#password_otorisasi').val();
                var otor2 = $("#user").find('#confirm_password_otorisasi').val();

                if(pass1 == pass2){

                    if(otor1 == otor2)
                    {
                        $.ajax({
                            type: "POST",
                            url: "{{route('post-user')}}",
                            data: $('#user').serialize(),
                            statusCode: {
                                201: function (data) {
                                    Consyst.showValidationError(data.html,'#alertcontent')
                                },
                            }
                        })
                        .done(function (data) {

                            if (data.status == 0) {
                                Consyst.showNoticeNotify("Error", data.msg);
                            } else if (data.status == 1) {
                                Consyst.showInfoNotify("Save", data.msg);
                                setTimeout(function () {
                                    Consyst.loadForm("{!! route('user') !!}");
                                }, 1000);

                            }
                        })
                    }else{
                        bootbox.alert('{!! trans('message.otor_password_didnt_match') !!}');
                    }
                }else{
                    bootbox.alert('{!! trans('message.password_didnt_match') !!}');
                }
            });
        }); 
    </script>
@endsection
