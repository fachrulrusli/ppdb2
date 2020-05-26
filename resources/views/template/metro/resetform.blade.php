 <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link href="{{$theme_path}}/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{$theme_path}}/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{$theme_path}}/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{$theme_path}}/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    {{--<link href="{{$theme_path}}/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />--}}
    <link href="{{$theme_path}}/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="{{$theme_path}}/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
      <link href="{{$theme_path}}/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{$theme_path}}/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css" />
    {{--<link href="{{$theme_path}}/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />--}}
    <link href="{{$theme_path}}/global/plugins/bootstrap-editable/inputs-ext/address/address.css" rel="stylesheet" type="text/css" />
    <link href="{{$theme_path}}/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{$theme_path}}/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{$theme_path}}/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
    <link href="{{$theme_path}}/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="{{$theme_path}}/pages/css/error.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{$theme_path}}/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{$theme_path}}/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
    <link href="{{$theme_path}}/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{$theme_path}}/consyst.css" rel="stylesheet" type="text/css"/>
    <link href="{{$theme_path}}/layouts/layout/css/themes/red.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{$theme_path}}/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{$theme_path}}/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" >
    <link href="{{$theme_path}}/global/plugins/bootstrap-duallistbox/bootstrap-duallistbox.min.css" rel="stylesheet" type="text/css" >
     <link href="{{$theme_path}}/global/slider-radio/slider-radio.css" rel="stylesheet" type="text/css" >



    <link href="{{$theme_path}}/apps/dx/css/dx.common.css" rel="stylesheet" type="text/css" >
    <link href="{{$theme_path}}/apps/dx/css/dx.greenmist.css" rel="stylesheet" type="text/css" >
    <link href="{{$theme_path}}/apps/dhtmlx/codebase/fonts/font_roboto/roboto.css" rel="stylesheet" type="text/css" >
    <link href="{{$theme_path}}/apps/dhtmlx/codebase/dhtmlx.css" rel="stylesheet" type="text/css" >
    <link href="{{$theme_path}}/apps/dhtmlx/skins/web/dhtmlx.css" rel="stylesheet" type="text/css" >
    <link href="{{$theme_path}}/apps/dhtmlx/skins/custom_scroll/customscroll.css" rel="stylesheet" type="text/css" >
    <link href="{{$theme_path}}/global/L.Control.Locate.min.css" rel="stylesheet" type="text/css" >
    <script src="{{$theme_path}}/global/webcam.min.js" type="text/javascript"></script>
    <script src="{{$theme_path}}/global/plugins/jquery.min.js" type="text/javascript"></script>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-wrapper" style="
        padding-top:10%;">

    
    <div class="page-container">

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @if ($message = Session::get('warning'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('reset') }}">
                        {!! csrf_field() !!}


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Kode Verifikasi Anda</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="kode_otp">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" id="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                                 <span id='message'></span>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i>Reset Password
                                </button>
                                 @if ($message = Session::get('success'))
                                 <button id="back" class="btn btn-danger">
                                    <i class="fa fa-btn fa-arrow-left"></i>Kembali
                                </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    </div>

</div>

<script type="text/javascript">
    $('#password, #password_confirmation').on('keyup', function () {
        if ($('#password').val() == $('#password_confirmation').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else 
        $('#message').html('Not Matching').css('color', 'red');
    });

    $("#back").click(function(){
        window.location = "/";
    });

</script>

<script src="{{$theme_path}}/global/scripts/app.js" type="text/javascript"></script>
<script src="{{$theme_path}}/all.js" type="text/javascript"></script>
<script src="{{$theme_path}}/apps/dhtmlx/codebase/dhtmlx.js" type="text/javascript"></script>
<script src="{{$theme_path}}/apps/dhtmlx/sources/dhtmlxTreeGrid/codebase/dhtmlxtreegrid.js" type="text/javascript"></script>
<script src="{{$theme_path}}/apps/dhtmlx/sources/dhtmlxTreeGrid/codebase/ext/dhtmlxtreegrid_filter.js" type="text/javascript"></script>
<script src="{{$theme_path}}/apps/dhtmlx/skins/custom_scroll/customscroll.js" type="text/javascript"></script>
<script src="{{$theme_path}}/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<script src="{{$theme_path}}/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script src="{{$theme_path}}/global/plugins/bootstrap-summernote/summernote.js" type="text/javascript"></script>
<script src="{{$theme_path}}/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js" type="text/javascript"></script>
<script src="{{$theme_path}}/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="{{$theme_path}}/consyst.js" type="text/javascript"></script>
<script src="{{$theme_path}}/global/slider-radio/slider-radio.js" type="text/javascript"></script>
<script src="{{$theme_path}}/global/L.Control.Locate.js" type="text/javascript"></script>
