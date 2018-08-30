<ul>
    @foreach($pages as $page)
    <li><a href="{{$page->url}}" class="{{
    Request::url() == (($page->url == '/') ? 'http://osago.local' : ('http://osago.local' . $page->url)) ? 'active' : ''
    }}" > {{$page->title}}</a></li>
    @endforeach
</ul>
