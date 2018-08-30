@extends('admin.layout.base')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="inqbox float-e-margins">
                <div class="inqbox-title border-top-info">
                    <h5>Страницы сайта</h5>
                </div>
                <div class="inqbox-content">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{route('pages.create')}}" class="btn btn-success " type="button">
                                <i class="fa fa-plus"></i>&nbsp;&nbsp;
                                <span class="bold">Добавить страницу</span>
                            </a>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                    </div>
                    <hr>
                    <ul>
                        @foreach($pages as $page)
                        <li>
                            <p class="h5 pageClass">{{$page->title}}</p>
<!--                            <a href="#" class="btn btn-white btn-bitbucket">-->
<!--                                <i class="fa fa-angle-up"></i>-->
<!--                            </a>-->
<!--                            <a class="btn btn-white btn-bitbucket">-->
<!--                                <i class="fa fa-angle-down"></i>-->
<!--                            </a>-->
<!--                            <a class="btn btn-white btn-bitbucket">-->
<!--                                <i class="fa fa-level-down"></i>-->
<!--                            </a>-->
                            <a href="{{route('pages.edit', $page->id)}}" class="btn btn-white btn-bitbucket">
                                <i class="fa fa-gears"></i>
                            </a>
                            <form action="{{route('pages.destroy', $page->id)}}" method="post" style="display:inline-block;">
                                <input name="_method" type="hidden" value="DELETE">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-white btn-bitbucket">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </form>
                        </li>
                        <hr>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection