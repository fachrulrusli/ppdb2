@extends(config('consyst.view_base').'base', ['menus'=> $menus])
@section('title')
    {!! config('consyst.app_name') !!}
@endsection


@section('content')

    @include(config('consyst.view_moduls').'dashboard.view',['pages'=>$pages])
@endsection