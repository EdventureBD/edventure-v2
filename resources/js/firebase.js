$(document).ready(function() {

    const firebaseConfig = {
        apiKey: "AIzaSyCg0U_COBJo8PXRkeOxpjkZAIO5T7YcNSI",
        authDomain: "edventure-63c00.firebaseapp.com",
        projectId: "edventure-63c00",
        storageBucket: "edventure-63c00.appspot.com",
        messagingSenderId: "734546289418",
        appId: "1:734546289418:web:322fb87c8eb1f04858d0f3",
        measurementId: "G-C54WSD0E6H"
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
