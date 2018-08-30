@extends('front.layout.base')

@section('content')
<div class="my_content">
    <div class="container">

        <!--sidebar start-->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="left_sidebar">
                <p>Документы для расчета ОСАГО</p>
                <ul>
                    <li>Никаких документов не требуется</li>
                </ul>
                <hr>
                <p>Преимущества Е-ОСАГО</p>
                <ul>
                    <li>Оформление до 20 минут</li>
                    <li>Никаких очередей</li>
                    <li>Никаких навязанных услуг</li>
                    <li>Несколько вариантов оплаты</li>
                </ul>
                <hr>
                <p>Документы для оформления полиса ОСАГО</p>
                <ul>
                    <li>Паспорт</li>
                    <li>Водительское удостоверение</li>
                    <li>Регистрационные документы на автомобиль: (ПТС, СТС)</li>
                </ul>
            </div>
        </div>
        <!--sidebar end-->

        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="right_content">
                <h1>Калькулятор ОСАГО 2018</h1>
                <p>расчитйте стоимость за 3 минуты</p>

                <hr>

                <form action="{{route('calculate')}}" method="post" data-pro-alert="login-user-alert" class="formCalculator form-horizontal pro-ajax">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-4">Страхователь
                            <span class="badge cursor" data-toggle="tooltip" data-placement="top"
                                  title="подсказка">?</span>
                        </div>
                        <label class="col-md-4 cursor" for="individualPerson">
                            <input type="radio" id="individualPerson" name="person" value="individualPerson" checked>
                            Физическое лицо
                        </label>
                        <label class="col-md-4 cursor" for="entityPerson">
                            <input type="radio" id="entityPerson" name="person" value="entityPerson">
                            Юридическое лицо
                        </label>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4">Выберите регион проживания
                            <span class="badge cursor" data-toggle="tooltip" data-placement="top"
                                  title="подсказка">?</span>
                        </div>
                        <div class="col-md-8">
                            <select name="region" id="region" class="form-control">
                                <option value="">Выберите регион</option>

                                @foreach($regions as $region)
                                    <option value="{{$region->id}}" class="region">{{$region->region}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group locationBlock" style="display:none;">
                        <div class="col-md-4">Место жительства собственника
                            <span class="badge cursor" data-toggle="tooltip" data-placement="top"
                                  title="подсказка">?</span>
                        </div>
                        <div class="col-md-8">
                            <select name="location" id="location" class="form-control" disabled="disabled">
                                <option value="">Выберите город</option>

                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-4">Категория авто
                            <span class="badge cursor">?</span>
                        </div>
                        <div class="col-md-8">
                            <select name="autoCategory" id="autoCategory" class="form-control">

                                @foreach($autoCategories as $autoCategory)

                                <option value="{{$autoCategory->id}}">{{$autoCategory->title}}</option>

                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4">Мощность авто
                            <span class="badge cursor">?</span>
                        </div>
                        <div class="col-md-8">
                            <select name="autoPower" id="autoPower" class="form-control">
                                <option value="0.6">До 50 включительно</option>
                                <option value="1">свыше 50 до 70 включительно</option>
                                <option value="1.1">свыше 70 до 100 включительно</option>
                                <option value="1.2">свыше 100 до 120 включительно</option>
                                <option value="1.4">свыше 120 до 150 включительно</option>
                                <option value="1.6">свыше 150</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4">Период использования
                            <span class="badge cursor">?</span>
                        </div>
                        <div class="col-md-8">
                            <select name="usePeriod" id="usePeriod" class="form-control">
                                <option value="1">1 год</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4">Диагностическая карта
                            <span class="badge cursor">?</span>
                        </div>
                        <label class="col-md-4 cursor" for="noDiagnostic">
                            <input type="checkbox" id="noDiagnostic" name="noDiagnostic" checked>
                            Оформить
                        </label>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4">Лица допущенные к управлению
                            <span class="badge cursor">?</span>
                        </div>
                        <label class="col-md-4 cursor noLimitsTime" for="noLimitsTime">
                            <input type="radio" id="noLimitsTime" name="limit" value="noLimitsTime" checked>
                            Без ограничений
                        </label>
                        <label class="col-md-4 cursor limitsTime" for="limitsTime">
                            <input type="radio" id="limitsTime" name="limit" value="limitsTime">
                            С ограничением
                        </label>
                    </div>

                    <hr>

                    <!--                    без ограничений-->
                    <div class="form-group noLimitsTimeBlock" style="display:block;">
                        <div class="col-md-4">Класс бонус-малус
                            <span class="badge cursor">?</span>
                        </div>
                        <div class="col-md-8">
                            <select name="bonusSmall" id="bonusSmall" class="form-control bonusSmall">
                                <option value="2.45">M</option>
                                <option value="2.3">0</option>
                                <option value="1.55">1</option>
                                <option value="1.4">2</option>
                                <option value="1">3</option>
                                <option value="0.95">4</option>
                                <option value="0.9">5</option>
                                <option value="0.85">6</option>
                                <option value="0.8">7</option>
                                <option value="0.75">8</option>
                                <option value="0.7">9</option>
                                <option value="0.65">10</option>
                                <option value="0.6">11</option>
                                <option value="0.55">12</option>
                                <option value="0.5">13</option>
                            </select>
                        </div>
                    </div>

                    <!--                    с ограничениями-->
                    <div class="limitsTimeBlock" style="display:none;">

                        <div class="driver row">

                            <div class="col-md-4">Водитель
                                <span class="badge cursor">?</span>
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="ageLabel" for="ageDriver">Возраст
                                                <span class="badge cursor">?</span>
                                            </label>
                                            <input type="text" id="ageDriver" name="ageDriver" maxlength="2" class="form-control ageDriver" style="width:80%;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="experienceLabel" for="experienceDriver">Стаж
                                                <span class="badge cursor">?</span>
                                            </label>
                                            <input type="text" id="experienceDriver" maxlength="2" name="experienceDriver" class="form-control experienceDriver" style="width:93%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bonusLabel" for="bonusSmall">Класс бонус-малус
                                                <span class="badge cursor">?</span>
                                            </label>
                                            <div class="">
                                                <select name="bonusSmall" id="bonusSmall" class="form-control bonusSmall">
                                                    <option value="2.45">M</option>
                                                    <option value="2.3">0</option>
                                                    <option value="1.55">1</option>
                                                    <option value="1.4">2</option>
                                                    <option value="1">3</option>
                                                    <option value="0.95">4</option>
                                                    <option value="0.9">5</option>
                                                    <option value="0.85">6</option>
                                                    <option value="0.8">7</option>
                                                    <option value="0.75">8</option>
                                                    <option value="0.7">9</option>
                                                    <option value="0.65">10</option>
                                                    <option value="0.6">11</option>
                                                    <option value="0.55">12</option>
                                                    <option value="0.5">13</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group text-center" style="margin-top: 25px;">
                                        <button id="addDriver" class="btn btn-success addDriver">Добавить водителя</button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>

                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-md-8" >
                            <hr>
                            <input type="hidden" name="numberDriver" class="numberDriver" value="1">
                            <button type="submit" class="btn btn-success">Расчитать</button>
                        </div>
                    </div>

                </form>

                <hr>

                <div class="row" style="font-weight:bold;">



                    <div class="col-sm-offset-8 col-md-4">
                        <div class="row">
                            <h4 class="col-md-6 text-right">СТОИМОСТЬ:</h4>
                            <div class="col-md-6 price">0р</div>
                        </div>
                        <div class="row">
                            <h4 class="col-md-6 text-right">ДК:</h4>
                            <div class="col-md-6 diagnostic">0р</div>
                        </div>
                        <div class="row">
                            <h4 class="col-md-6 text-right">ИТОГО:</h4>
                            <div class="col-md-6 priceWithDiagnostic">0р</div>
                        </div>
                    </div>

                </div>

                <div class="row text-center" style="margin-top: 20px;">
                    <div class="col-sm-offset-8 col-md-4">
                        <button class="btn btn-success">Оформить ОСАГО</button>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>
<!--content section end-->

<!--text section start-->
<div class="text_section bs_bottompadder30 bs_toppadder30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p>
                    <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, autem consectetur deserunt ea eaque enim expedita fugit incidunt mollitia nam odio praesentium quidem, rem reprehenderit temporibus unde vel vero voluptatem?</span>
                    <span>Ad animi asperiores consequatur cupiditate debitis delectus dignissimos dolores enim eum explicabo illo libero magnam magni, nobis, officia omnis, quas quidem quos recusandae reprehenderit similique sit sunt unde vitae voluptatibus?</span>
                    <span>Aperiam, assumenda doloribus et excepturi explicabo incidunt iste nemo quisquam. Alias, amet atque ea esse, et minima nemo nihil optio possimus praesentium quae quia quibusdam quidem reiciendis reprehenderit sit voluptate?</span>
                    <span>Ab alias consequatur dignissimos est perspiciatis quam quibusdam quo vero? Animi assumenda et eum exercitationem facere ipsa laborum nam qui, sunt voluptatibus! Delectus eaque, eveniet libero numquam quis quisquam unde?</span>
                    <span>A architecto culpa dolore dolorum eum facere illum iusto laborum magnam necessitatibus odio, quas, sint sunt ullam unde ut voluptas. Assumenda delectus dicta inventore maxime obcaecati quis quo sed ullam.</span>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="/front/js/proajaxFront.js"></script>

<script>
    $(document).ready(function () {

        $('#region').change(function () {

            $.get(  "{{ URL::to('/calculate/getData') }}",
                {region: $(this).val()},
                function (data) {

                    $('#location').empty().attr('disabled', false).append( $("<option value=''>Выберите город</option>") );

                    $.each(data, function (index, value) {

                        $('#location').append( $("<option value='" + value.id + "'>" + value.location + "</option>") )
                    });

                    $('.locationBlock').fadeIn("slow");
                });
        });
    })
</script>
@endsection