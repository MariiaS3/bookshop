$(document).ready(function() {

    function markFieldAsError(field, hasError) {
        if (hasError) {
            field.addClass('field-error');
        } else {
            field.removeClass('field-error');
            removeFieldError(field);
        }
    }
    
    function removeFieldError(field) {
        const errorText = field.next();
        if (errorText !== null) {
            console.log(errorText.hasClass('form-error-text'));
            if (errorText.hasClass('form-error-text')) {
                // errorText.remove();
                $('.form-error-text').remove();
            }
        }
    };
    
      function createFieldError(field, text) {
        removeFieldError(field);
    
        var div = $('<div>'+text+'</div>');
        div.addClass('.form-error-text');

        if (field.next() === null) {
            field.parent().append(div);
        } else {
            if (!field.next().hasClass('.form-error-text')) {
                field.parent().append(div);
            }
        }
        };
    
        function testText(field, n) {
            return field.val().length >= n;
        };
    
        function testFormat(field, format) {
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
            createFieldError($inputPassword2, "Hasło powinno mieć minimum osiem znaków, co najmniej jedna wielka litera, jedna mała litera, jedna cyfra i jeden znak specjalny");
            formsErrors = true;
        }
    
        if ($inputPassword1.value !== $inputPassword2.value) {
            markFieldAsError($inputPassword1, true);
            markFieldAsError($inputPassword2, true);
            createFieldError($inputPassword2, "Hasła są różne!!!");
            formsErrors = true;
        }
    
        if (!formsErrors) {
          // $.ajax({
          //   type: "POST",
          //   url: 'rejestracja.php',
          //   data :$form.serialize()
          // }).done(function(data) {
          //   alert("Posting post.");
          //   $('#response').html(data.val()());
          //   console.log("Posting failed.");
    
          // })
          // .fail(function() {
          //   alert("Posting hello.");
          //   $('#response').html("hello");
          //   console.log("Posting failed.");
    
          // });
          return false;
        }
        });
      });
    