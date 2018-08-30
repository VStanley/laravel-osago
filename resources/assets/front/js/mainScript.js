
$(function () {


});

ObjectOsago = {


    /*
            отправка аджакс
     */


    // возврат данных
    ajaxResponse: function (data, action, callback) {

        jQuery.ajax({

            url: action,
            type: 'POST',
            data: data,
            dataType: 'json',

            beforeSend: function(){


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

    //  получаем данные с базы
    getFieldsData : function (data, action) {

        this.ajaxResponse(data, action, function (response) {

            console.log(response)
        })
    },


    /*-------------------
     *
     *       калькулятор
     */
    //  показать с ограничениями
    showLimitsTime : function () {

        $('.noLimitsTimeBlock').css('display', 'none').find('#bonusSmall').attr('disabled', true);
        $('.limitsTimeBlock').fadeIn("slow");
        this.toggleElemDriver(false);
    },

    //  показать без ограничений
    showNoLimitsTime : function () {

        $('.limitsTimeBlock').css('display', 'none');
        $('.noLimitsTimeBlock').fadeIn("slow").find('#bonusSmall').attr('disabled', false);
        this.toggleElemDriver(true);
    },

    //  вырубаем все элементы у водителя
    toggleElemDriver : function (value) {

        $('.limitsTimeBlock').find('input, select').each(function () {

            $(this).attr('disabled', value);
        });
    },

    //  Создаем новый блок водителя
    addDriver : function (numberDriver) {

        var blockDriver = $('.driver').clone();

        blockDriver.find('.ageLabel').attr('class', ('ageLabel' + numberDriver))
            .attr('for', ('ageDriver' + numberDriver));
        blockDriver.find('#ageDriver').attr('id', ('ageDriver' + numberDriver))
            .attr('name', ('ageDriver' + numberDriver)).val('');

        blockDriver.find('.experienceLabel').attr('class', ('experienceLabel' + numberDriver))
            .attr('for', ('experienceDriver' + numberDriver));
        blockDriver.find('#experienceDriver').attr('id', ('experienceDriver' + numberDriver))
            .attr('name', ('experienceDriver' + numberDriver)).val('');

        blockDriver.find('.bonusLabel').attr('class', ('bonusLabel' + numberDriver))
            .attr('for', ('bonusSmall' + numberDriver));
        blockDriver.find('#bonusSmall').attr('id', ('bonusSmall' + numberDriver))
            .attr('name', ('bonusSmall' + numberDriver));

        blockDriver.find('#addDriver').attr('id', ('driver' + numberDriver))
            .attr('class', 'btn btn-danger delete')
            .html('Удалить водителя');

        blockDriver.attr('class', ('driver' + numberDriver + ' row'));
        blockDriver.appendTo('.limitsTimeBlock');

        numberDriver = parseInt(numberDriver) + 1;
        $('.numberDriver').val(parseInt(numberDriver));

        ObjectOsago.checkNumberDriver(numberDriver);
    },

    checkNumberDriver : function (numberDriver) {

        if (numberDriver === 3) {

            $('#addDriver').attr('disabled', true);
        } else {

            $('#addDriver').attr('disabled', false);
        }
    }

    /*
     *       калькулятор енд
     *
       ------------------------
     */
};

$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip();
    ObjectOsago.toggleElemDriver(true);


    /*  --------------------------
    *
    *        калькулятор
     */

    /*
            действия пользователя на калькуляторе
     */
    // физическое лицо
    $('#individualPerson').click(function () {

        $('#limitsTime').attr('disabled', false);
        $('.limitsTime').css('opacity', '1');
    });

    //  юридическое лицо
    $('#entityPerson').click(function () {

        $('#noLimitsTime').prop('checked', true);
        $('#limitsTime').prop('checked', false).attr('disabled', true);
        $('.limitsTime').css('opacity', '0.2');
        ObjectOsago.showNoLimitsTime();
    });

    //  без ограничений
    $('#noLimitsTime').click(function () {

        ObjectOsago.showNoLimitsTime();
    });

    //  с ограничениями
    $('#limitsTime').click(function () {

        ObjectOsago.showLimitsTime();
    });

    //  добавить водителя
    $('#addDriver').click(function (event) {

        event.preventDefault();
        ObjectOsago.addDriver($('.numberDriver').val());
    });

    //  удалить водителя
    $('.limitsTimeBlock').on('click', '.delete', function (event) {

        var numberDriver = $('.numberDriver').val();

        numberDriver = numberDriver - 1;
        $('.numberDriver').val(numberDriver);

        ObjectOsago.checkNumberDriver(numberDriver);

        event.preventDefault();
        $('.driver' + numberDriver + '').remove();
    });

    // $('#noDiagnostic').change(function () {
    //
    //     if ($(this).prop('checked')){
    //
    //         $('.diagnostic').html('500p');
    //         $('.priceWithDiagnostic').html( (parseInt($('.price').html()) + 500) + 'p' );
    //     } else {
    //
    //         $('.diagnostic').html('0p');
    //         $('.priceWithDiagnostic').html( parseInt($('.price').html()) + 'p');
    //     }
    // });
    //
    /*
    *       калькулятор end
    *
    *
    *    --------------------------
     */
});