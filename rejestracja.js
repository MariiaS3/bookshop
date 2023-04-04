$(document).ready(function() {

    function markFieldAsError(field, hasError) {
        if (hasError) {
            field.addClass('field-error').css({ "border-color":"tomato"});
        } else {
            field.removeClass('field-error').css({ "border-color":"green"});
            removeFieldError(field);
        }
    }
    
    function removeFieldError(field) {
        const errorText = field.next();
        if (errorText !== null) {
            if (errorText.hasClass('error-text')) {
                errorText.remove();
            }
        }
    };
    
      function createFieldError(field, text) {
        removeFieldError(field);
    
        var div = $('<div>'+text+'</div>');
        div.addClass('error-text');
        if (field.next() === null) {
            field.parent().append(div);
        } else {
            if (!field.next().hasClass('error-text')) {
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

          const $form = $( this );
          const $inputEmail     = $form.find( "input[name='email']" );
          const $inputPassword1 = $form.find( "input[name='haslo1']" );
          const $inputPassword2 = $form.find( "input[name='haslo2']" ); 
      
          const $mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
          const $passwordformat = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    
          var formsErrors = false;
    
        for (const el of [$inputEmail, $inputPassword1, $inputPassword2]) {
            markFieldAsError(el, false);
            removeFieldError(el);
        }
    
        if (!testFormat($inputEmail, $mailformat)) {
            markFieldAsError($inputEmail, true);
            createFieldError($inputEmail, "Wpisany email jest niepoprawny");
            formsErrors = true;
        }
    
        if (!testFormat($inputPassword1, $passwordformat)) {
            markFieldAsError($inputPassword2, true);
            markFieldAsError($inputPassword1, true);
            createFieldError($inputPassword2, "");
            $('#response').html("Hasło powinno mieć minimum osiem znaków, co najmniej jedna wielka litera, jedna mała litera, jedna cyfra i jeden znak specjalny");
            formsErrors = true;
        } else if ($inputPassword1.val() !== $inputPassword2.val()) {
            markFieldAsError($inputPassword1, true);
            markFieldAsError($inputPassword2, true);
            createFieldError($inputPassword2, "");
            $('#response').html("Hasła są różne!!!");
            formsErrors = true;
        }
    
        if (!formsErrors) {
          $.ajax({
            type: "POST",
            url: 'rejestracja.php',
            data :$form.serialize(),
            success: function(data){
                // alert('horray! 200 status code!');
                $('#response').html("Konto zostało pomyślnie utworzone proszę przejdź do logowania");
            },
            error: function(jqXHR) {
                if (jqXHR.status == 422) {
                    $('#response').html("Konto o takim adresie już istnieje");
                } else{
                    $('#response').html("Przepraszamy wystąpił nieoczekiwany błąd, spróbój później");
                }
            },
          })
        }
        });
      });
    