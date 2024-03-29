@extends(config('consyst.view_includes').'content')
@section('content-child')
    <!-- BEGIN VALIDATION STATES-->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-directions font-green"></i>
                <span class="caption-subject font-green bold uppercase"> {!! $pages->title !!}</span>
            </div>
        </div>
        <div class="portlet-body form">
            <div id="alertcontent"></div>
            {!! Form::open(array('id' => 'user-akses','role'=>'form','class'=>'form-horizontal form-row-seperated')) !!}
            <div class="form-body">
                <!-- BEGIN FORM-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('caption', 'Username :') !!}
                            {!! Form::label($user->username, $user->username, ['class' => 'control-label']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('akses', 'Akses:', ['class' => 'control-label']) !!}
                            {!! Form::select('akses[]', $akses,isset($data) ? $data : '',['class' => 'form-control multi-perm','style="width: 100%;"','multiple']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::hidden('action',  1 ) !!}
                {!! Form::hidden('id',  $user->id_user  ) !!}
                {!! Form::close() !!}
            </div>
            <div class="form-actions noborder">
                <button type="button" class="btn dark" id="btnReturn"><i
                            class="fa fa-reply"></i> {!! trans('button.global.back') !!}
                </button>
                <button type="button" class="btn blue" id="btnSubmit"><i
                            class="fa fa-save"></i> {!! trans('button.global.save') !!}</button>

            </div>

            <!-- END FORM-->
        </div>
    </div>
    <!-- END PORTLET-->


@endsection
@section('script-onpage')
    <script type="application/javascript">
        $(document).ready(function () {
            var multi = $('#user-akses').bootstrapDualListbox({
                nonSelectedListLabel: 'Available',
                selectedListLabel: 'Selected',
                preserveSelectionOnMove: 'moved',
                moveOnSelect: true,
                selectorMinimalHeight: 300
            });
            $('#btnReturn').click(function () {
                Consyst.loadForm("{{route('user')}}");
            });
            $('#btnSubmit').click(function (e) {

                e.preventDefault();
                bootbox.confirm("{{trans('message.submit_confirm')}}", function (result) {
                    if (result) {
                        $.ajax({
                            url: "{{route('post-user-akses')}}",
                            data: $('#user-akses').serialize(),
                            statusCode: {
                                201: function (data) {
                                    bootbox.alert(data.html);
                                },
                            }
                        })
                                .done(function (data) {
                                    if (data.status == 0) {
                                        Consyst.msgError("Error", data.msg);
                                    } else if (data.status == 1) {
                                        Consyst.msgInfo("Save", data.msg);
                                    }
                                })
                    }
                });
            });
        });
    </script>
@endsection
