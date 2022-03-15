$(document).ready(function () {

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    setProgressBar(current);

    $(".next").click(function () {

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({ 'opacity': opacity });
            },
            duration: 500
        });
        setProgressBar(++current);
    });

    $(".previous").click(function () {

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({ 'opacity': opacity });
            },
            duration: 500
        });
        setProgressBar(--current);
    });

    function setProgressBar(curStep) {
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
            .css("width", percent + "%")
    }

    $(".submit").click(function () {
        return false;
    })

});
// ****************************** custom js part starts *********************************************** //

    $('#class').on("select2:selecting", function (e) {
        if(e.params.args.data.id == 0) {
            $('#class_selection').css('display','block')
            $('#class').removeProp('name')
            $('#selected_class').prop('name','class')
        } else {
            $('#class_selection').css('display','none')
            $('#selected_class').removeProp('name')
            $('#class').prop('name','class')
        }
    })


    $('.select2').select2()
    if($('#name').val() !== '') {
        $('#name_next_btn').prop("disabled", false);
    }

    if($('#phone').val() !== '') {
        $('#phone_next_btn').prop("disabled", false);
    }

    if($('#email').val() !== '') {
        $('#email_next_btn').prop("disabled", false);
    }

    $('#name').on('change keyup', function () {
        if($('#name').val() == '') {
            $('#name_error').html('Please Enter your name')
            $('#name_next_btn').prop("disabled", true);
        } else {
            $('#name_error').html('')
            $('#name_next_btn').prop("disabled", false);
        }
    })

    $('#phone').on('change keyup', function () {
        let phone = $('#phone').val()
        if(phone === '') {
            $('#phone_error').html('Please Enter a valid phone number')
            $('#phone_next_btn').prop("disabled", true);
        } else if(phone.length !== 11) {
            $('#phone_error').html('Phone number must be 11 digits')
            $('#phone_next_btn').prop("disabled", true);
        } else {
            $('#phone_error').html('')
            $('#phone_next_btn').prop("disabled", false);
        }
    })

    $('#class').on('change', function () {
        if($('#class').val() === '') {
            $('#class_error').html('Please choose your class')
            $('#class_next_btn').prop("disabled", true);
        } else {
            $('#class_error').html('')
            $('#class_next_btn').prop("disabled", false);
        }
    })

    $('#district').on('change', function () {
        if($('#district').val() === '') {
            $('#district_error').html('Please choose your district')
            $('#district_next_btn').prop("disabled", true);
        } else {
            $('#district_error').html('')
            $('#district_next_btn').prop("disabled", false);
        }
    })

    $('#email').on('change keyup', function () {
        let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        let email = $('#email').val()
        if(email === '') {
            $('#email_error').html('Please Enter a valid email')
            $('#email_next_btn').prop("disabled", true);
        } else if(!email.match(regexEmail)) {
            $('#email_error').html("Email must contain '@' and '.'")
            $('#email_next_btn').prop("disabled", true);
        } else {
            $('#email_error').html('')
            $('#email_next_btn').prop("disabled", false);
        }
    })

    $('#password,#password_confirmation').on('change keyup', function () {
        let password = $('#password').val()
        let confirmPassword = $('#password_confirmation').val()
        if(password === '' || confirmPassword === '') {
            $('#password_error').html('Please Enter your password')
            $('#password_next_btn').prop("disabled", true);
        } else if (password !== confirmPassword) {
            $('#password_error').html("Confirm Password doesn't match")
            $('#password_next_btn').prop("disabled", true);
        } else if(password.length <= 7) {
            $('#password_error').html("Password must be atleast 8 character")
            $('#password_next_btn').prop("disabled", true);
        } else {
            $('#password_error').html('')
            $('#password_next_btn').prop("disabled", false);
        }
    })

    $('#password_next_btn').click(function () {
        $('#msform').submit()
    })

// **************************** custom js part ends ************************ //
