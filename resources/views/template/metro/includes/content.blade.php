<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN PAGE HEADER-->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            {!!($pages->breadcrumb)!!}
        </ul>
        <div class="page-toolbar">
            <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body"
                 data-placement="bottom" data-original-title="Nama Cabang">
                <i class="fa fa-bank"></i>
                &nbsp;
                <span class="thin uppercase hidden-xs"></span>&nbsp;

            </div>
        </div>
    </div>
    <br>
    <!-- BEGIN PAGE CONTENT-->

    <div class="full-height-content full-height-content-scrollable">
        <div class="full-height-content-body" style="background: #FFFFFF">

            @yield('content-child')

        </div>
    </div>


    <!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTENT-->
@yield('content-footer')
@yield('script-onpage')
<!-- END CONTENT -->
