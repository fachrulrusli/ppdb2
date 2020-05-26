const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.scripts(
        [

            'global/plugins/bootstrap/js/bootstrap.min.js',
            'global/plugins/js.cookie.min.js',
            'global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
            'global/plugins/jquery.blockui.min.js',
            'global/plugins/bootbox/bootbox.min.js',
            'global/plugins/flot/jquery.flot.min.js',

            'global/plugins/flot/jquery.flot.resize.min.js',
            'global/plugins/bootstrap-select/js/bootstrap-select.min.js',
            'layouts/layout/scripts/layout.min.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
            'global/plugins/moment.min.js',
            'global/plugins/jquery.mockjax.js',
            'global/plugins/select2/js/select2.full.min.js',
            'global/plugins/jquery-multi-select/js/jquery.multi-select.js',
            'global/plugins/jquery.nicescroll/jquery.nicescroll.min.js',
            'global/scripts/datatable.js',
            'global/plugins/datatables/datatables.min.js',
            'global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js',
            'pages/scripts/table-datatables-managed.min.js',
            'global/plugins/bootstrap-toastr/toastr.min.js',

            'pages/scripts/components-select2.min.js',
            'pages/scripts/components-multi-select.min.js',

            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            'pages/scripts/form-validation-md.min.js',
            'global/plugins/bootstrap-duallistbox/jquery.bootstrap-duallistbox.min.js',
            'global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js',
            'apps/dx/scripts/dx.all.js',
            'global/plugins/bootstrap-sweetalert/sweetalert.js'
        ],
        'public/assets/frameworks/metro/',
        'public/assets/frameworks/metro/'

    );
});