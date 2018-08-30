
/*
    структура полей объекта и некоторые
    значения по умолчанию
*/
var fields = {

    type: 1,      // начмнаем с окна
    checkField: 'all',

    typeConstruction: {
        1: 'Окно',
        2: 'Дверь'
    },

    profile: {
        1: 'Wintech 3-х камерный',
        2: 'Rehau 3-х камерный'
    },

    fittings: {
        1: 'Maco',
        2: 'Accado',
        3: 'Дверная'
    },

    sectionsNumber: {
        1: '1'
    },

    widthMin: 500,
    widthMax: 2400,

    heightMin: 500,
    heightMax: 3000,

    step: 50
};

/*
        тут все функции ! ! !
 */
CalculatorObject = {

    //  получаем данные с базы
    getFieldsData : function (data, action) {

        this.ajaxResponse(data, action, function (response) {

            //  отправляем полученые поля для заполнения формы
            CalculatorObject.fillFields(response);
        })
    },

    //  заполнение полей
    fillFields : function (response) {

        // заполняем наш объект получеными данными
        for (field in response) {

            fields[field] = response[field]
        }

        //  при выборе окно или дверь меняем сортировку для верного отображения (а как иначе??)
        if  (fields.type === 5){ fields.typeConstruction = {1: 'Дверь', 2: 'Окно'} }
        if  (fields.type === 1){ fields.typeConstruction = {1: 'Окно', 2: 'Дверь'} }

        // typeConstruction
        this.fillSelectIOptions(fields.typeConstruction, '.typeConstruction');

        // profile
        if  (fields.checkField === 'fittings') {

            this.fillSelectIOptions(fields.profile, '.profile');
        }

        // fittings
        if  (fields.checkField === 'profile') {

            this.fillSelectIOptions(fields.fittings, '.fittings');
        }

        // fittings & profile
        if  (fields.checkField === 'all') {

            this.fillSelectIOptions(fields.fittings, '.fittings');
            this.fillSelectIOptions(fields.profile, '.profile');
        }

        // width бегунок
        this.fillSlideRollers('#slider', '#amount', 'horizontal', fields.widthMin, fields.widthMax, fields.step, fields.widthMin);

        // height бегунок
        this.fillSlideRollers('#slider-vertical', '#amount1', 'vertical', fields.heightMin, fields.heightMax, fields.step, fields.heightMin);

        // получаем цену
        CalculatorObject.getPrice(CalculatorObject.getDataForm());
    },

    // заполняем селект
    fillSelectIOptions : function (fields, name) {

        $(name).empty();

        $.each(fields, function (key, value) {

            $(name).append($("<option value='" + value + "'>" + value + "</option>"));
        });
    },

    // заполняем бегунки
    fillSlideRollers : function (name, nameSlide, orientation, min, max, step, value) {

        $(name).slider({
            orientation: orientation,
            range: "min",
            min: parseInt(min),
            max: parseInt(max),
            step: parseInt(step),
            value: parseInt(value),
            slide: function( event, ui ) {
                $(nameSlide).val( ui.value );
            }
        });
        $(nameSlide).val( $(name).slider( "value" ) );
    },

    // возврат данных
    ajaxResponse: function (data, action, callback) {

        jQuery.ajax({

            url: action,
            type: 'POST',
            data: data,
            dataType: 'json',

            beforeSend: function(){

                $('.price').html('<img src="/images/bx_loader.gif">');
            },

            success: function (response) {

                console.log('ok');
                callback(response);
            },

            error: function (response) {

                console.log('bad');
                console.log(response);
            }
        });
    },

    // получение цены
    getPrice : function (data) {

        this.ajaxResponse(data, '/calculator/getPrice.php', function (response) {

            $('.price').html(response);
        })
    },

    // собираем данные с формы
    getDataForm : function () {

        var $data = {};

        $('.formCalculator').find('input, select').each(function () {

            $data[this.name] = $(this).val();
        });

        return $data;
    }
};

/*
        формирование объекта с данными СТАРТ КАЛЬКУЛЯТОРА
 */
(function () {

    //  загружаем 1 секцию все параметры
    var data = 'sectionsNumber=1&checkField=all';

    // начальное значение загрузки параметров 1 секции
    CalculatorObject.getFieldsData(data, '/calculator/getFieldsData.php');

})(jQuery);

/*
        действия пользователя
 */
$(document).ready(function () {

    // sectionsNumber выбораем по клику тип конфигурации
    $('.section .number').click(function () {

        var sectionsNumber = $(this).val();

        fields.checkField = 'all';

        var data = 'sectionsNumber= ' + sectionsNumber + ' &checkField=' + fields.checkField;

        // подгружаем все параметры в зависимости от выбранной секции
        CalculatorObject.getFieldsData(data, '/calculator/getFieldsData.php');

        $('.sectionsNumber').val(sectionsNumber);
    });

    // выбор окно или дверь
    $('.typeConstruction').change(function () {

        //  1-4 окна, 5-6 двери. 1 и 5 стартовые конфигурации
        fields.type = (fields.type === 1) ? 5 : 1;
        fields.checkField = 'all';
        var data = 'sectionsNumber= ' + fields.type + ' &checkField=' + fields.checkField;

        if  (fields.type === 1){

            $('.door').css('display', 'none');
            $('.window').css('display', 'block');
        } else {

            $('.window').css('display', 'none');
            $('.door').css('display', 'block');
        }

        // подгружаем все параметры после смены конструкции
        CalculatorObject.getFieldsData(data, '/calculator/getFieldsData.php');

        $('.sectionsNumber').val(fields.type);
    });

    //  выбор фурнитуры и профиля
    $('.fittings, .profile').change(function () {

        var data = CalculatorObject.getDataForm();

        fields.checkField = $(this).attr('name');

        data.checkField = fields.checkField;
        $(data).serialize();

        CalculatorObject.getFieldsData(data, '/calculator/getFieldsData.php');
    });

    // изменение бегунка
    $('#slider, #slider-vertical').bind("mouseup", function(){

        CalculatorObject.getPrice(CalculatorObject.getDataForm())
    });

});