<meta charset="utf-8"/>
<title>{{$app_name}} | Log in</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta name="robots" content="noindex, nofollow">
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" href="{{$theme_path}}/global/plugins/font-awesome/css/font-awesome.min.css">
<link href="{{$theme_path}}/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"
      type="text/css"/>
<link href="{{$theme_path}}/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="{{$theme_path}}/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet"
      type="text/css"/>

<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{$theme_path}}/global/plugins/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css"/>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="{{$theme_path}}/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css"/>
<link href="{{$theme_path}}/global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="{{$theme_path}}/global/plugins/pnotify/pnotify.css" media="all">
<link rel="stylesheet" href="{{$theme_path}}/global/plugins/bootstrap-toastr/toastr.css" media="all">
<link href="{{$theme_path}}/global/plugins/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css"/>
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{$theme_path}}/pages/css/login-5.min.css" rel="stylesheet" type="text/css"/>
<link href="{{$theme_path}}/consyst.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<!-- END THEME LAYOUT STYLES -->
<link rel="shortcut icon" href="favicon.ico"/> </head>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<!-- END THEME LAYOUT STYLES -->
<!-- END HEAD -->
<!-- BEGIN LOGIN -->
<body class=" login">
<!-- BEGIN LOGO -->
<div class="user-login-5">
    <div class="row bs-reset">
        <div class="col-md-6 login-container bs-reset">
            <img class="login-logo login-6" src="{{$theme_path}}/layouts/layout/img/kspsb.png" />
            <div class="login-content">
                <h1>{{trans('view.login.title')}}</h1>
                <form action="{{route('login')}}" class="login-form" method="post">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span>{{trans('view.login.alert')}}</span>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group form-md-line-input has-success form-md-floating-label">
                                <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="{{trans('view.login.form.username')}}" name="username" required/> </div>
                            </div>
                        <div class="col-xs-6">
                                <div class="form-group form-md-line-input">
                                    <div class="input-group col-md-12">
                                        <div class="input-group-control">
                                            <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="{{trans('view.login.form.password')}}" name="password" id="myPass" required/>
                                        </div>
                                        <div style="margin-top: 10px; margin-right: -20px; z-index: 10000000">
                                        <span style="margin-top: 10px;">
                                            <a onclick="myFunction()">
                                                <i id="text" class="fa fa-eye fa-2x"></i>
                                            </a>
                                        </span>
                                        </div>    
                                    </div>
                                </div>
                             <!--  <div class="form-group form-md-line-input has-success form-md-floating-label">
                                                    <div class="input-icon right">
                                                        
                                                        <button><i class="icon-eye"></i></button>
                                                    </div>
                                                </div>
                          
 -->
                         <!--    <div class="md-checkbox" style="margin-top: -20px;">
                                <input type="checkbox" id="showhidepass" class="md-check" onclick="myFunction()">
                                <label for="showhidepass">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span><b id="text">Show Password</b></label>
                                </div> -->
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label class="rememberme mt-checkbox mt-checkbox-outline">

                                <input type="checkbox" name="remember" value="1" /> Remember me
                                <span></span>
                            </label>
                        </div>
                        <div class="col-sm-8 text-right">
                            <button class="btn blue" id="btlogin" type="submit">{{trans('view.login.button.login')}}</button>
                        </div>
                    </div>
                </form>
                <div class="text-right">
                    <a data-target="#myModal2" data-toggle="modal" class="MainNavText" id="MainNavHelp" 
                   href="#myModal2">Forgot My Password ?</a>
                </div>
                
            </div>
            <div class="login-footer">
                <div class="row bs-reset">
                    <div class="login-copyright text-right">
                        <p>Copyright &copy; Consyst Team {{date('Y')}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="overlay">
            <center><img src="{{$theme_path}}/layouts/layout/img/loading.gif" alt="Loading" /></center>
        </div>
        <div class="col-md-6 bs-reset">
            <div class="login-bg"> </div>
        </div>
    </div>
</div>







<div id="myModal2" class="modal modal-success fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                  aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Nomor Whatsapp</h4>
                </div>
                <div class='modal-body' style='background-color: #fff !important; color: #000 !important;'>
          
                   <div class="row">
                            <div class="panel panel-default">
                              <div class="panel-body">
                                <div class="text-center">
                                  <h3><i class="fa fa-lock fa-4x" style="margin-top: 40px; color:#075E54 "></i></h3>
                                  <h2 class="text-center" style="margin-top: 70px;">Forgot Password?</h2>
                                  <p>You can reset your password here.</p>
                                  <div class="panel-body">

                                     {!! Form::open(array('id' => 'form-send-wa')) !!}

                                        <div class="form-group has-success">
                                         <label>Masukkan Nomor Whatsapp Terdaftar</label>
                                         <div class="input-group input-group-lg">
                                            <span class="input-group-addon" id="sizing-addon1" style="background: #075E54"><i class="fa fa-whatsapp" style="color: #FFF"></i></span>
                                            <input type="text" class="form-control" name="nowa" placeholder="ex : 0812345678910" aria-describedby="sizing-addon1"> </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="button" class="btn btn-lg btn-primary btn-block" id="SendWa">
                                                <i class="fa fa-btn fa-whatsapp"></i> SEND TO WHATSAPP
                                            </button>
                                        </div> 
                                    {!! Form::close() !!}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  <!-- END EXAMPLE TABLE PORTLET-->
                </div>
              </div><!-- /.modal-content -->
              <div class="modal-footer">
              </div>
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
        </div>        



<div id="myModal3" class="modal modal-success fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                  aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">CHANGE PASSWORD</h4>
                </div>
                <div class='modal-body' style='background-color: #fff !important; color: #000 !important;'>
          
                   <div class="row">
                            <div class="panel panel-default">
                              <div class="panel-body">
                                <div class="text-center">
                                  <h3><i class="fa fa-lock fa-4x" style="margin-top: 40px;"></i></h3>
                                  <h2 class="text-center" style="margin-top: 70px;">Change Your Password</h2>
                                  <p>You can reset your password here.</p>
                                  <div class="panel-body">

                                    
                                     {!! Form::open(array('id' => 'form-ganti-pass')) !!}

                                        <div class="form-group">
                                         <div class="input-group input-group-lg">
                                            <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-lock color-blue"></i></span>
                                            <input type="password" class="form-control" name="password" id="password"  placeholder="New Password" aria-describedby="sizing-addon1"> </div>
                                        </div>
                                         <div class="form-group">
                                         <div align="left"><span id='message' style="margin-bottom: 10px;"></span></div>
                                         <div class="input-group input-group-lg" id="conf">
                                            <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-lock color-blue"></i></span>
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" aria-describedby="sizing-addon1"> </div>
                                            
                                        </div>
                                        

                                        
                                        <div class="col-md-4 pull-right">
                                            <button type="button" class="btn btn-lg btn-primary btn-block" id="next">
                                                <i class="fa fa-btn fa-angle-double-right"></i> NEXT
                                        </div> 
                                

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                  <!-- END EXAMPLE TABLE PORTLET-->
                </div>
              </div><!-- /.modal-content -->
              <div class="modal-footer">
              </div>
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
        </div>        


<div id="myModal4" class="modal modal-success fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                  aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Verifiy Your Code</h4>
                </div>
                <div class='modal-body' style='background-color: #fff !important; color: #000 !important;'>
          
                   <div class="row">
                            <div class="panel panel-default">
                              <div class="panel-body">
                                <div class="text-center">
                                  <h3><i class="fa fa-mobile-phone fa-4x" style="margin-top: 40px;"></i></h3>
                                  <h3 class="text-center" style="margin-top: 70px;">Cek Your Whatsapp And Fill Your Code Below....</h3>
                                  <p>haven't received the code? click <a id='backmodal2' class="MainNavText">here</a></p>
                                  <div class="panel-body">
                                        <center>
                                            <div class="row" style="position: relative; left: 6%; right: 10%; margin-bottom: 20px;">

                                                <div class="form-group has-success">
                                                    <input class="inputs form-control text-center" type="text" name="kode1" id="kode1" maxlength="1" />

                                                    <input class="inputs form-control text-center" type="text" name="kode2" maxlength="1" />

                                                    <input class="inputs form-control text-center" type="text" name="kode3" maxlength="1" />

                                                    <input class="inputs form-control text-center" type="text" name="kode4" maxlength="1" />
                                                    
                                                    <input class="inputs form-control text-center" type="text" name="kode5" maxlength="1" />
                                                    
                                                    <input class="inputs form-control text-center" type="text" name="kode6" maxlength="1" />
                                                </div>
                                            </div>      

                                        </center>                                   


                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-lg btn-success btn-circle" id="next2">
                                                <i class="fa fa-btn fa-angle-double-right"></i> Confirmation</button>
                                        </div>
                                        {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                  <!-- END EXAMPLE TABLE PORTLET-->
                </div>
              </div><!-- /.modal-content -->
              <div class="modal-footer">
              </div>
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
        </div>        



<!-- END : LOGIN PAGE 5-1 -->
<!-- END LOGIN -->
<!--[if lt IE 9]>
</body>
</html>
<script src="{{$theme_path}}/global/plugins/respond.min.js"></script>
<script src="{{$theme_path}}/global/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{$theme_path}}/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="{{$theme_path}}/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{$theme_path}}/consyst.js" type="text/javascript"></script>
<script src="{{$theme_path}}/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="{{$theme_path}}/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="{{$theme_path}}/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{{$theme_path}}/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{$theme_path}}/global/plugins/jquery-validation/js/jquery.validate.min.js"
        type="text/javascript"></script>
<script src="{{$theme_path}}/global/plugins/jquery-validation/js/additional-methods.min.js"
        type="text/javascript"></script>
<script src="{{$theme_path}}/global/plugins/ladda/spin.min.js" type="text/javascript"></script>
<script src="{{$theme_path}}/global/plugins/ladda/ladda.min.js" type="text/javascript"></script>
<script src="{{$theme_path}}/pages/scripts/ui-buttons.min.js" type="text/javascript"></script>
<script src="{{$theme_path}}/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script src="{{$theme_path}}/global/plugins/pnotify/pnotify.js"></script>
<script src="{{$theme_path}}/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{$theme_path}}/global/scripts/app.js" type="text/javascript"></script>
<script src="{{$theme_path}}/login.js" type="text/javascript"></script>
{{--<script src="{{$theme_path}}/pages/scripts/login-5.min.js" type="text/javascript"></script>--}}

<!-- END THEME GLOBAL SCRIPTS -->
<style type="text/css">
    .inputs{
        margin-right: 6px;
        margin-bottom: 10px;
        float: left;
        width: 14%;
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
    }
</style>
<script type="text/javascript">
    $('#myModal2, #myModal4').on('hidden.bs.modal', function (e) {
      $(this)
      .find("input,textarea,select")
      .val('')
      .end()
      .find("input[type=checkbox], input[type=radio]")
      .prop("checked", "")
      .end();
  })
    $(".inputs").keyup(function () {
        if (this.value.length == this.maxLength) {
        $(this).next('.inputs').focus();
      }
    });


    $('body').on('keyup', '.inputs', function()
    {
      var key = event.keyCode || event.charCode;
      var inputs = $('.inputs');
      if(($(this).val().length === this.size) && key != 32) 
      {
        inputs.eq(inputs.index(this) + 1).focus();  
      } 
      if( key == 8 || key == 46 )
      {
        var indexNum = inputs.index(this);
        if(indexNum != 0)
        {
        inputs.eq(inputs.index(this) - 1).val('').focus();
        }
      }
      
    });
    validate();
    $('.inputs').on('keyup', validate);

    function validate() {
      var inputsWithValues = 0;
      // get all input fields except for type='submit'
      var myInputs = $(".inputs");

      myInputs.each(function(e) {
        // if it has a value, increment the counter
        if ($(this).val()) {
          inputsWithValues += 1;
      }
    });
        if (inputsWithValues == myInputs.length) {
            $("#next2").prop("disabled", false);
        } else {
            $("#next2").prop("disabled", true);
        }
    }

    $("#next").prop('disabled', true)//use prop()
    
    $("#password, #password_confirmation").keyup(function () {
        var user_pass = $("#password").val();
        var user_pass2 = $("#password_confirmation").val();

        if (user_pass == user_pass2) {
            $("#next").prop('disabled', false)//use prop()
            $('#message').html('Match').css('color', 'green');
            $('#conf').addClass('has-success').removeClass('has-error');
        } else {
            $("#next").prop('disabled', true)//use prop()
            $('#message').html('Those Password didnt Match. Try Again').css('color', 'red');
            $('#conf').addClass('has-error').removeClass('has-success');
        }
    });
   


    function myFunction() {
          var x = document.getElementById("myPass");
          var z = document.getElementById("text");
          
          if (x.type === "password") {
            x.type = "text";
            z.className = 'fa fa-eye-slash fa-2x';
        } else {
            x.type = "password";
            z.className = 'fa fa-eye fa-2x';
            
        }
    }
    $(window).load(function(){
        // PAGE IS FULLY LOADED
        // FADE OUT YOUR OVERLAYING DIV
        $('#overlay').fadeOut();
    });
    $(document).ready(function () {

        $('#myModal4').on('shown.bs.modal', function () {
            $('#kode1').focus();
        }) 

        $("#next").click(function(){
            $('#myModal3').modal('hide');
            $('#myModal4').modal('show');
            document.getElementById("kode1").focus();

        });
        $('#backmodal2').click(function(){
            $('#myModal2').modal('show');
            $('#myModal4').modal('hide');
        });
        
        

        $("#SendWa").click(function(){
            var formData = $('#form-send-wa').serialize();
            $.ajax({
              type: 'POST',
              url: '{!! route('forgot-link')!!}',
              data: formData,
              dataType: "json",
              success: function (data)
                {
                    if (data.status===99) {
                        Consyst.msgInfo("Kode Verifikasi Sudah Terikirim Silahkan Cek Nomor Whatsapp Anda");
                        $('#myModal2').modal('hide');
                        $('#myModal3').modal('show');
                    } else if(data.status === 50){
                        Consyst.msgError("Nomor Whatsapp Tidak Terdaftar");
                    } else {
                        Consyst.msgError("Periksa Kembali Nomor Anda");
                    }
                }
            });
        });

        $('#next2').click(function(){
           var formData = $('#form-ganti-pass').serialize();
            $.ajax({
              type: 'POST',
              url: '{!! route('reset')!!}',
              data: formData,
              dataType: "json",
              success: function (data)
                {
                    if (data === 99) {
                        Consyst.msgInfo("Password Successfully Changed");
                        location.reload();
                    } else if(data === 50){
                        Consyst.msgError("Your Verification Code doesn't Match");
                    } else {
                        Consyst.msgError("Error, Please Try With another Way");
                    }
                }
            });
        });


        $('.login-form').submit(function (e) {
            e.preventDefault();
            var btnSelector = $('#btlogin')[0];
            var l = Ladda.create(btnSelector);
            l.start();
            var data = $('.login-form').serialize();
            $.ajax({
                type: 'post',
                methode: 'post',
                url: '{{route('login')}}',
                data: data,
                success: function (e) {
                    l.toggle();
                    if (e !== '') {
                        var rtn = $.parseJSON(e);
                        if (rtn.status == 1) {
                            Login.info("{{trans('message.msg_box_title.login.success')}}", rtn.info);
                            window.location = '{{url('/adminppdb')}}';

                        } else {
                            Login.error("{{trans('message.msg_box_title.login.failed')}}", rtn.info);
                        }
                    }
                }
            });
        });
        $('.login-bg').backstretch([
                "{{$theme_path}}/pages/img/login/bg1.jpg",
                "{{$theme_path}}/pages/img/login/bg2.jpg",
                "{{$theme_path}}/pages/img/login/bg3.jpg"
            ], {
                fade: 1000,
                duration: 8000
            }
        );
    });
</script>
