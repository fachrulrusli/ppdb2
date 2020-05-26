<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> {{trans('message.msg_box_title.error_box')}}</h4>
    <ul>

        @foreach ($errors as $error)

            <li>{{$error[0]}}</li>
        @endforeach
    </ul>
</div>