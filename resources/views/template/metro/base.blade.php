<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>

    <meta charset="utf-8"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
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
    
    <!-- END THEME STYLES -->

</head>
<!-- END HEAD -->
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-closed page-footer-fixed">
<div class="page-wrapper">
    <!-- BEGIN HEADER -->
@include(config('consyst.view_base').'includes.header')
<!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
    @include(config('consyst.view_base').'includes.sidebar')
    <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
    @yield('content')
    <!-- END CONTENT -->
        <!-- BEGIN QUICK SIDEBAR -->

        <!-- END QUICK SIDEBAR -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
@include(config('consyst.view_base').'includes.footer')
<!-- END FOOTER -->
</div>


<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="{{$theme_path}}/global/plugins/respond.min.js"></script>
<script src="{{$theme_path}}/global/plugins/excanvas.min.js"></script>
<![endif]-->

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
<script src="{{$theme_path}}/global/scripts/quick-nav.min.js"></script>



</body>