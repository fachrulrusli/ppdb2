@if(isset($menu['id_menu']))
<li class="nav-item start">
    <a href="{{$menu['url']}}" class="ajax nav-link nav-toggle">
        <i class="{{$menu['icon'] }}"></i>
        @if(count( $menu['childs'])>0)
            <span class="title">{{$menu['nama_menu']}}<span class="badge badge-success" style='float:right'> {{count($menu['childs'])}}</span></span>
        @else
            <span class="title">{{$menu['nama_menu']}}</span>
        @endif
        @if(count( $menu['childs'])>0)
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item">
                @foreach ($menu['childs'] as $menu)
                    @include(config('consyst.view_base').'includes.submenu',$menu)
                @endforeach
        </li>
    </ul>
    @else
    </a>
    @endif
</li>
@endif
