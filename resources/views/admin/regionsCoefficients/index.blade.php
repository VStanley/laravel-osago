@extends('admin.layout.base')



@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">

        <div class="col-lg-4">
            <div class="inqbox float-e-margins">
                <div class="inqbox-title border-top-success">
                    <h5>Форма редактирования</h5>
                </div>
                <div class="inqbox-content">

                    <form action="" class="pro-ajax formRegion" method="post" data-pro-alert="login-user-alert">
                        <input name="_method" id="method" type="hidden" value="post">

                        <div class="kform">
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="form-group">
                                        @include('admin.errors')
                                    </div>

                                    <div class="alert-message"></div>

                                    <div class="section">
                                        <label class="field select">
                                            <select id="region" name="region" class="">
                                                <option value="region">Вводим регион</option>

                                                @foreach($regions as $region)

                                                <option value="{{$region->id}}">{{$region->region}}</option>

                                                @endforeach

                                            </select>
                                            <i class="arrow double"></i>
                                        </label>
                                    </div>

                                    <div class="section">
                                        <label class="field prepend-icon">
                                            <input type="text" name="location" id="location" class="gui-input location"
                                                   placeholder="Локация">
                                            <b class="tooltip tip-right-top"><em> Введите название региона или
                                                    города</em></b>
                                            <label for="location" class="field-icon">
                                                <i class="fa fa-location-arrow"></i>
                                            </label>
                                        </label>
                                    </div>

                                    <div class="section">
                                        <label class="field prepend-icon">
                                            <input type="text" name="auto" id="auto" class="gui-input auto"
                                                   placeholder="Автомобиль">
                                            <b class="tooltip tip-right-top"><em>коэффициент на автомобиль</em></b>
                                            <label for="auto" class="field-icon">
                                                <i class="fa fa-car"></i>
                                            </label>
                                        </label>
                                    </div>

                                    <div class="section">
                                        <label class="field prepend-icon">
                                            <input type="text" name="tractor" id="tractor" class="gui-input"
                                                   placeholder="Трактор">
                                            <b class="tooltip tip-right-top"><em>коэффициент на трактор</em></b>
                                            <label for="tractor" class="field-icon">
                                                <i class="fa fa-cogs"></i>
                                            </label>
                                        </label>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="hidden" class="updateId" value="">
                                    {{ csrf_field() }}
                                    <button id="great" class="btn btn-primary" type="submit" style="color:#fff;">
                                        <i class="fa fa-check"></i>&nbsp;
                                        <span class="bold">Создать</span>
                                    </button>
                                    <button id="update" class="btn btn-success" type="submit" style="color:#fff;">
                                        <i class="fa fa-upload"></i>&nbsp;
                                        <span class="bold">Обновить</span>
                                    </button>
                                    <button id="delete" class="btn btn-danger" type="submit" style="color:#fff;">
                                        <i class="fa fa-warning"></i>&nbsp;
                                        <span class="bold">Удалить</span>
                                    </button>
                                    <button id="clearForm" class="btn btn-info" type="submit" style="color:#fff;">
                                        <i class="fa fa-trash-o"></i>&nbsp;
                                        <span class="bold">Очистить форму</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="inqbox float-e-margins">
                <div class="inqbox-title border-top-info">
                    <h5>Территориальный коэффициент</h5>
                </div>
                <div class="inqbox-content">
                    <ul>
                        @forelse($regions as $region)
                        <li style="cursor: pointer;">
                            <span class="region" style="font-weight:bold;">{{$region->region}}</span>
                            (<span class="idRegion">{{$region->id}}</span>)
                            @if (isset($region->cityCoefficient))
                            <ul>
                                @foreach($region->cityCoefficient as $city)
                                    <li class="city" style="cursor: pointer;margin:5px 0;">
                                        <span class="location">{{$city->location}}</span>
                                        (авто - <span class="auto">{{$city->auto}}</span>
                                        трактор - <span class="tractor">{{$city->tractor}}</span>)
                                        <span class="region_id" style="display:none;">{{$region->id}}</span>
                                        <span class="city_id" style="display:none;">{{$city->id}}</span>
                                    </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @empty
                        <p>Пусто, добавьте регион</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="/admin/js/proajax.js"></script>
<script>
    $( document ).ready(function() {

        $('#great').click(function () {

            $('.pro-ajax').attr('action', "{{ URL::to('/dashboard/regionsCoefficients/') }}");
            $('#method').prop('disabled', true);
        });

        $('#update').click(function () {

            $('.pro-ajax').attr('action', "{{ URL::to('/dashboard/regionsCoefficients/') }}" + "/" + $('.updateId').val() +"");
            $('#method').val('put').prop('disabled', false);
        });

        $('#delete').click(function () {

            $('.pro-ajax').attr('action', "{{ URL::to('/dashboard/regionsCoefficients/') }}" + "/" + $('.updateId').val() + "");
            $('#method').val('delete').prop('disabled', false);
        });
    });
</script>
@endsection