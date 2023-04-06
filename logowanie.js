$(document).ready(function () {

    function markFieldAsError(field, hasError) {
        if (hasError) {
            field.addClass('field-error').css({ "border-color": "tomato" });
        } else {
            field.removeClass('field-error').css({ "border-color": "green" });
            removeFieldError(field);
        }
    }

    function removeFieldError(field) {
        const errorText = field.next();
        if (errorText !== null) {
            if (errorText.hasClass('form-error-text')) {
                errorText.remove();
            }
        }
    };

    function createFieldError(field, text) {
        removeFieldError(field);

        var div = $('<div>' + text + '</div>');
        div.addClass('form-error-text');
        if (field.next() === null) {
            field.parent().append(div);
        } else {
            if (!field.next().hasClass('form-error-text')) {
                field.parent().append(div);
            }
        }
    };

    function testFormat(field, format) {
        console.log(field.val().match(format));
        return field.val().match(format);
    };

    $('#userForm').submit(function (e) {
        e.preventDefault();

        const $form = $(this);
        const $inputEmail = $form.find("input[name='email']");
        const $inputPassword = $form.find("input[name='haslo']");

        const $mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        const $passwordformat = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        var formsErrors = false;

        for (const el of [$inputEmail, $inputPassword]) {
            markFieldAsError(el, false);
            removeFieldError(el);
        }

        if (!testFormat($inputEmail, $mailformat)) {
            markFieldAsError($inputEmail, true);
            createFieldError($inputEmail, "Wpisany email jest niepoprawny");
            formsErrors = true;
        }

        if (!testFormat($inputPassword, $passwordformat)) {
            markFieldAsError($inputPassword, true);
            createFieldError($inputPassword, "");
            $('#response').html("Hasło powinno mieć minimum osiem znaków, co najmniej jedna wielka litera, jedna mała litera, jedna cyfra i jeden znak specjalny");
            formsErrors = true;
        }

        if (!formsErrors) {
            $.ajax({
                type: "POST",
                url: 'logowanie.php',
                data: $form.serialize(),
                success: function (data) {
                    $('#response').html("Logowanie przebiegło pomyślnie");
                },
                error: function () {
                    $('#response').html("Przepraszamy wystąpił nieoczekiwany błąd, spróbój ponownie później");
                },
            })
        }
    });
});
