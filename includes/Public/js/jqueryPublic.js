jQuery( function( $ ) {
    $( "#ScfSubmit" ).click( function () {

        $body = $("body");

        $( document ).on({
            ajaxStart: function () {
                $body.addClass( "loading" );
            },
            ajaxStop: function () {
                $body.removeClass( "loading" );
            }
        });

        var valid;
        valid = validateContact();
        if(valid) {

            $.ajax({
                url: "",
                cache: false,
                contentType: false,
                processData: false,
                type: "POST",
                data: 'ScfForm' + $("#ScfForm").val() +
                    '&ScfFirstName=' + $("#ScfFirstName").val() +
                    '&ScfLastName=' + $("#ScfLastName").val() +
                    '&ScfEmail=' + $("#ScfEmail").val() +
                    '&ScfSubject=' + $("#ScfSubject").val() +
                    '&ScfMessage=' + $("#ScfMessage").val() +
                    '&ScfSubmit=' + $("#ScfSubmit").val(),

                success: function (data) {
                    $("#showMessage").html('<br><div class="scf-success" role="alert">Thank you for sending us your feedback.</div><div class="loading"></div>');

                    setTimeout(function () {
                        $(".scf-success").fadeOut("slow");
                    }, 2000);
                },

                error: function () {
                }

            });
        }
    });

    function validateContact() {
        var valid = true;
        $(".demoInputBox").css('background-color','');
        $(".info").html('');
        if(!$("#ScfFirstName").val()) {
            $("#firstName-info").html("This field is required.");
            $("#ScfFirstName").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!$("#ScfLastName").val()) {
            $("#lastName-info").html("This field is required.");
            $("#ScfLastName").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!$("#ScfEmail").val()) {
            $("#email-info").html("You need to enter valid E-mail address.");
            $("#ScfEmail").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!$("#ScfSubject").val()) {
            $("#subject-info").html("This field is required.");
            $("#ScfSubject").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!$("#ScfMessage").val()) {
            $("#message-info").html("This field is required.");
            $("#ScfMessage").css('background-color','#FFFFDF');
            valid = false;
        }
        return valid;
    }
});
