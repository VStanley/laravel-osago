@extends('admin.layout.base')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="inqbox float-e-margins">
                <div class="inqbox-title border-top-info">
                    <h5>Базовые цены</h5>
                </div>
                <div class="inqbox-content">




                        <div class="form-group">
                            @include('admin.errors')
                        </div>

                        @forelse($autoCategories as $autoCategory)

                    <form method="post" action="{{route('autoCategories.update', $autoCategory->id)}}" class="form-horizontal">
                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{$autoCategory->title}}</label>
                            <div class="col-sm-3">
                                <input type="text" value="{{$autoCategory->price}}" name="price" class="form-control"
                                       placeholder="{{$autoCategory->title}}">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-w-m btn-success">
                                    <i class="fa fa-upload"></i>&nbsp;
                                    <span class="bold">Обновить</span>
                                </button>
                            </div>

                        </div>
                        <div class="hr-line-dashed"></div>

                    </form>

                    @empty

                        <p>пусто</p>

                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
@endsection