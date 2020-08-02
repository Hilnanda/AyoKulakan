// Initialize firebase APP
firebase.initializeApp(firebaseConfig);

firebase.auth().languageCode = 'id';
// To apply the default browser preference instead of explicitly setting it.
// firebase.auth().useDeviceLanguage();

// Create a Recaptcha verifier instance globally
// Calls submitPhoneNumberAuth() when the captcha is verified
// window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
//     size: "normal",
//     callback: function (response) {
//         submitPhoneNumberAuth();
//     }
// });

window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
    'size': 'invisible',
    'callback': function (response) {
        // reCAPTCHA solved, allow signInWithPhoneNumber.
        submitPhoneNumberAuth();
    }
});

// This function runs when the 'sign-in-button' is clicked
// Takes the value from the 'phoneNumber' input and sends SMS to that phone number
function submitPhoneNumberAuth() {
    var phoneNumber = $("#phoneNumber").val();
    var dataString = 'phone=' + phoneNumber;
    var appVerifier = window.recaptchaVerifier;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "/login/checkNumber",
        data: dataString,
        success: function (response) {
            if (response.error) {
                alert(response.error)
            } else {
                firebase.auth().signInWithPhoneNumber(response, appVerifier)
                    .then(function (confirmationResult) {
                        window.confirmationResult = confirmationResult;
                        $("#otp").show().focusin();
                        $("#signIn").hide();
                    })
                    .catch(function (error) {
                        grecaptcha.reset(window.recaptchaWidgetId);
                    });
            }
        },
        error: function (error) {
            console.log('Error signInWithPhoneNumber Ajax : ', error)
        }
    });
}

// This function runs when the 'confirm-code' button is clicked
// Takes the value from the 'code' input and submits the code to verify the phone number
// Return a user object if the authentication was successful, and auth is complete
function submitPhoneNumberAuthCode() {
    var code = $("#code").val();
    confirmationResult
        .confirm(code)
        .then(function (result) {
            var user = result.user;
            var dataString = 'phone=' + user.phoneNumber;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/login/phone",
                data: dataString,
                success: function (response) {
                    window.location = '/';
                }
            });
        })
        .catch(function (error) {
            console.log(error.message);
        });
}

function submitLogoutButton() {
    firebase.auth().signOut().then(function () {
        // Sign-out successful.
        console.log('Berhasil Logout')
    }).catch(function (error) {
        // An error happened.
    });
}