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



<div class="form-gap" style="padding-top: 70px;"></div>
<hr>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x" style="margin-top: 40px;"></i></h3>
                  <h2 class="text-center" style="margin-top: 70px;">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('forgot-link') }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                           <label>Masukkan Nomor Whatsapp Terdaftar</label>
                           <div class="input-group input-group-lg">
                            <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-whatsapp color-blue"></i></span>
                            <input type="text" class="form-control" name="nowa" placeholder="ex : 0812345678910" aria-describedby="sizing-addon1"> </div>
                        </div>

                    <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">
                                <i class="fa fa-btn fa-whatsapp"></i>Send Password Link
                            </button>
                    </div> 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>



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
