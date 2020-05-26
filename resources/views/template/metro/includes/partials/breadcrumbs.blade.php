@if ($breadcrumbs)
@foreach ($breadcrumbs as $breadcrumb)
    @if (!$breadcrumb->last)
        @if ($breadcrumb->title=='Home')
            <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a><i class="fa fa-circle"></i></li>
        @else
            <li><a href="#" onclick=Consyst.loadForm("{{$breadcrumb->url}}")>{{ $breadcrumb->title }}</a><i class="fa fa-circle"></i></li>
        @endif
    @else
        <li><span>{{ $breadcrumb->title }}</span></li>
    @endif
@endforeach
@endif
