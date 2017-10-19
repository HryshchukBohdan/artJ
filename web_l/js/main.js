$(document).ready(function(){

    $(".chosen-select").chosen({no_results_text: "Oops, nothing found!" , width: "270px"});

    $('#region').change(function () {

        valid($(this));
        var ter_id = $(this).val();

        $.ajax({
            type: "POST",
            url: '/ajaxTer',
            data: {ter_id: ter_id},

            success: function (data) {

                // console.log(data);

                $('#city, #city-region').find('.del').remove();
                $('#city').closest('.select-field').removeClass('hidden').find('option[value=""]').prop('selected', true).after(data);
                $('#city-region').removeClass('is-active').closest('.select-field').addClass('hidden').find('option[value=""]').prop('selected', true);
                $(".chosen-select").trigger("chosen:updated");
            }
        });
    });

    $('#city').change(function () {

        valid($(this));
        var ter_id = $(this).val();

        $.ajax({
            type: "POST",
            url: '/ajaxTer',
            data: {ter_id: ter_id},

            success: function (data) {

                // console.log(data);

                $('#city-region').find('.del').remove();

                if (data.length) {
                    $('#city-region').addClass('is-active').closest('.select-field').removeClass('hidden').find('option[value=""]').prop('selected', true).after(data);
                } else {
                    $('#city-region').removeClass('is-active').removeClass('has-error').closest('.select-field').addClass('hidden').find('option[value=""]').prop('selected', true);
                }

                $(".chosen-select").trigger("chosen:updated");
            }
        });
    });

    $('#city-region').change(function () {

        valid($(this));
    });

    var checkError = function (that, val, rv, e_rv) {
            var error = '';

            if (!$.trim(val)) {
                error = 'Поле обизательное';
            } else if(val.length < 6) {
                error = 'Слишком коротко';
            } else if(!rv.test(val)) {
                error = e_rv;
            }

            if (error == '') {
                $(that).removeClass('has-error').addClass('has-success');
                $(that).parent().next().html('');
            } else {
                $(that).removeClass('has-success').addClass('has-error');
                $(that).parent().next().html(error);

            }
        },
        validName = function (_this, val) {
            var rv_name = /^[а-яА-Яa-zA-Z]+\s+[а-яА-Яa-zA-Z]+\s+[а-яА-Яa-zA-Z]+$/,
                that = _this,
                error_rv ='Что-то пошло не так. </br> Введите ФИО через пробел между словами';
            checkError(that, val, rv_name, error_rv);
        },
        validEmail = function (_this, val) {
            var rv_mail = /.+@.+\..+/i,
                that = _this,
                error_rv ='Что-то пошло не так. </br> Неверный формат email';

            checkError(that, val, rv_mail, error_rv);
        },
        validTer = function (_this, val) {
            var rv_ter = /.{1,}/i,
                that = _this,
                error_rv ='Что-то пошло не так. </br> Поле не заполненно';

            checkError(that, val, rv_ter, error_rv);
        };

    $('form .input-field input').blur(function () {

        valid(this);
    });

    function valid(_this) {
        var name = $(_this).attr('data-name'),
            val = $(_this).val();

        switch (name) {
            case 'name':
                validName(_this, val);
                break;
            case 'email':
                validEmail(_this, val);
                break;
            case 'region':
            case 'city':
            case 'city-region':
                validTer(_this, val);
                break;
        } // end switch(...)
    }

    $('#send').bind('click', function(){

        var filter = ['#name', '#email', '#region', '#city-region.is-active', '#city'];

        for (var i = 0; i < filter.length; i++) {

            valid($(filter[i]));
        }

        if (!$('.has-error').length) {

            var data = new FormData();

            data.append('name', $('#name').val());
            data.append('email', $('#email').val());
            data.append('region', $('#region').val());
            data.append('city-region', $('#city-region').val());
            data.append('city', $('#city').val());

            $.ajax({
                type: "POST",
                url: '/reg',
                data: data,
                contentType: false,
                processData: false,

                success: function (data) {

                    if (data) {
                        $('#modalEmail .modal-body').html(data);
                        $('#modalEmail').modal('show');

                    } else {
                        alert('Все Ок');
                        window.location.href = '/';
                    }
                }
            });
        }
    });
});