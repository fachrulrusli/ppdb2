<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
         <div class="page-bar">
            <ul class="page-breadcrumb">
                {!!($pages->breadcrumb)!!}
            </ul>

            <div class="page-toolbar">
                <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Nama Cabang">
                    <i class="fa fa-bank"></i>
                    <span class="thin uppercase hidden-xs"></span>&nbsp;

                </div>
            </div>
        </div>
       <h1 class="page-title"> {!! trans('view.dashboard.title') !!}
                <small></small>
        </h1>
 
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
        
             @include(config('consyst.view_base').'includes.modul.dashboard.modul')
  
            </div>
        </div>
         <div id="popup">
             <div id="overlay">
                 <center><img src="{{$theme_path}}/layouts/layout/img/loading.gif" alt="Loading" /></center>
             </div>


            <div class="popup"></div>
            
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>

{{--@if (Auth::user())--}}
  {{--<script>--}}
  {{--$(document).ready(function() {--}}
   {{----}}
    {{--$(function() {--}}
      {{--setInterval(function checkSession() {--}}
        {{--$.get('/check-session', function(data) {--}}
          {{--// if session was expired--}}
          {{--if (data.guest) {--}}
            {{--location.reload();--}}
          {{--}--}}
        {{--});--}}
      {{--}, 60000); // every minute--}}
    {{--});--}}
    {{--});--}}
  {{--</script>--}}
{{--@endif--}}

<!-- END CONTENT -->