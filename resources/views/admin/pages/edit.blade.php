@extends('admin.layout.base')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="inqbox float-e-margins">
                <div class="inqbox-title border-top-info">
                    <h5>Настройки страницы</h5>
                </div>
                <div class="inqbox-content">

                    @if (isset($page->id))
                        <form method="post" action="{{route('pages.update', $page->id)}}" class="form-horizontal">
                            <input name="_method" type="hidden" value="PUT">
                    @else
                        <form method="post" action="{{route('pages.store')}}" class="form-horizontal">
                    @endif

                            <div class="form-group">
                                @include('admin.errors')
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">page title</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{$page->title or ''}}" name="title" class="form-control"
                                           placeholder="название страницы">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">h1</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{$page->h1 or ''}}" name="h1" class="form-control"
                                           placeholder="заголовок страницы">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">url</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{$page->url or ''}}" name="url" class="form-control"
                                           placeholder="url страницы">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">description</label>
                                <div class="col-sm-10">
                                <textarea name="description" id="" cols="100"
                                          rows="5">{{$page->description or ''}}</textarea>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">keywords</label>
                                <div class="col-sm-10">
                                    <textarea name="keywords" id="" cols="100"
                                              rows="5">{{$page->keywords or ''}}</textarea>
                                </div>
                            </div>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-w-m btn-success">Сохранить</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection