$(document).ready(function() {

    const firebaseConfig = {
        apiKey: "AIzaSyBLJMfAA1z11act31ha-rX4JjOyC3o4_fU",
        authDomain: "otpapp-3959b.firebaseapp.com",
        databaseURL: "https://otpapp-3959b.firebaseio.com",
        projectId: "otpapp-3959b",
        storageBucket: "otpapp-3959b.appspot.com",
        messagingSenderId: "913289585739",
        appId: "1:913289585739:web:eb97d308926763356719ce",
        measurementId: "G-NM63D5T3K4"
      };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
        'size': 'invisible',
        'callback': function (response) {
            // reCAPTCHA solved, allow signInWithPhoneNumber.
            console.log('recaptcha resolved');
        }
    });
    onSignInSubmit();
    $("#cancelModal").on("click", function() {
        $("#confirmMobile").addClass("hidden");
    })
});



function onSignInSubmit() {
    var otpVerified = false;
    $('#verifPhNum').on('click', function() {
        let phoneNo = '';
        var code = $('#codeToVerify').val();
        console.log(code);
        $(this).attr('disabled', 'disabled');
        $(this).text('Processing..');
        confirmationResult.confirm(code).then(function (result) {
                    // alert('Succecss');
            var user = result.user;
            otpVerified = true;
            $('#registerForm').submit();
        }.bind($(this))).catch(function (error) {
            // User couldn't sign in (bad verification code?)
            $(this).removeAttr('disabled');
            $(this).text('Invalid Code');
            setTimeout(() => {
                $(this).text('Verify Phone No');
            }, 2000);
        }.bind($(this)));
    
    });
    
    
    $('#registerForm').on('submit', function (e) {
        if (!otpVerified) {

            e.preventDefault();
            var phoneNo = '+88'+$('#phone').val();
            console.log(phoneNo);
            // getCode(phoneNo);
            var appVerifier = window.recaptchaVerifier;
            firebase.auth().signInWithPhoneNumber(phoneNo, appVerifier)
            .then(function (confirmationResult) {
        
                window.confirmationResult = confirmationResult;
                coderesult=confirmationResult;
                // console.log(coderesult);
                $("#confirmMobile").removeClass("hidden");
            }).catch(function (error) {
                console.log(error.message);
        
            });
        }
    });
}
