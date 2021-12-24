import Axios from "axios";

$(document).ready(function() {
    
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
            console.log(confirmationResult.verificationId);
            otpVerified = true;
            $('#registerForm').append('<input type="hidden" name="verificationId" value="'+confirmationResult.verificationId+'" >');
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
            var smsUrl = "https://smpp.ajuratech.com:7790/sendtext?apikey=API_KEY&secretkey=SECRET_KEY &callerID=SENDER_ID&toUser=MOBILE_NUMBER&messageContent="
            axios.get()
            .then(function (response) {
        
                
                console.log(coderesult);
                $("#confirmMobile").removeClass("hidden");
            }).catch(function (error) {
                console.log(error.message);
        
            });
        }
    });
}
