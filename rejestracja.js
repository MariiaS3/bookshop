
// function testText(field, n) {
//     return field.value.length >= n;
// }

// function testFormat(field, format) {
//     return field.value.match(format);
// }

// function markFieldAsError(field, hasError) {
//     if (hasError) {
//         field.classList.add(".field-error");
//     } else {
//         field.classList.remove(".field-error");
//         removeFieldError(field);
//     }
// }

// function removeFieldError(field) {
//     const errorText = field.nextElementSibling;
//     if (errorText !== null) {
//         if (errorText.classList.contains(".form-error-text")) {
//             errorText.remove();
//         }
//     }
// };

// function createFieldError(field, text) {
//     removeFieldError(field);
//     const div = document.createElement('DIV');
//     div.classList.add(".form-error-text");
//     div.innerText = text;

//     // const formField = document.querySelector("#"+field) ;
//     // formField.appendChild(div);
//     if (field.nextElementSibling === null) {
//         field.parentElement.appendChild(div);
//     } else {
//         if (!field.nextElementSibling.classList.contains(".form-error-text")) {
//             field.parentElement.insertBefore(div, field.nextElementSibling);
//         }
//     }
// };


// const form = document.querySelector("form");
// const inputName = document.querySelector("input[name=name]");
// const inputLastName = document.querySelector("input[name=lastname]");
// const inputEmail = document.querySelector("input[name=email]");
// const inputPassword1 = document.querySelector("input[name=haslo1]");
// const inputPassword2 = document.querySelector("input[name=haslo2]");
// const formMessage = form.querySelector(".form-message");
// let mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
// let passwordformat = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;


$(document).ready(function() {
    $('#userForm').submit(function() {
      // showing that something is loading

      $.ajax({
        type: "POST",
        url: 'rejestracja.php',
        data :$(this).serialize()
      }).done(function(data) {
        // demonstrate the response
        alert("Posting failed.");
        $('#response').html(data);
        console.log("Posting failed.");

      })
      .fail(function() {
        // if posting your form failed
        alert("Posting failed.");
        $('#response').html("hello");
        console.log("Posting failed.");

      });
      // to restrain from refreshing the whole page, it
      return false;
    });
  });

// form.addEventListener("submit", e => {
//     e.preventDefault();

//     let formsErrors = false;

//     for (const el of [inputEmail, inputPassword1, inputPassword2]) {
//         markFieldAsError(el, false);
//         removeFieldError(el);
//     }

//     if (!testFormat(inputEmail, mailformat)) {
//         markFieldAsError(inputEmail, true);
//         createFieldError(inputEmail, "Wpisany email jest niepoprawny");
//         formsErrors = true;
//     }

//     if (!testFormat(inputPassword1, passwordformat)) {
//         markFieldAsError(inputPassword2, true);
//         createFieldError(inputPassword2, "Hasło powinno mieć minimum osiem znaków, co najmniej jedna wielka litera, jedna mała litera, jedna cyfra i jeden znak specjalny");
//         formsErrors = true;
//     }

//     if (inputPassword1.value !== inputPassword2.value) {
//         markFieldAsError(inputPassword1, true);
//         markFieldAsError(inputPassword2, true);
//         createFieldError(inputPassword2, "Hasła są różne!!!");
//         formsErrors = true;
//     }

//     if (!formsErrors) {
//         // e.target.submit();
//         alert("hello");
//         let formData = new FormData(form);
        
//         $.ajax({
//             type: "POST",
//             url: 'rejestracja.php',
//             data : formData,
//             success: function () {
//               alert('form was submitted');
//             }
//           });
//     }

// });

// const params = new URLSearchParams(window.location.search);
// const user = params.get("user");
// params.delete("user");
// console.log(user);