jQuery( function( $ ) {

    /**
     * Ajax call for submitting a form
     */
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

                error: function () {}
            });
        }
    });

    /**
     * Validation of the forms fields
     *
     * @returns {boolean}
     */
    function validateContact() {

        var valid = true;
        $( ".demoInputBox" ).css( 'background-color', '' );
        $( ".info" ).html( '' );

        if( !$( "#ScfFirstName" ).val() ) {
            $( "#firstName-info" ).html( "This field is required." );
            $( "#ScfFirstName" ).css( 'background-color', '#FFFFDF' );
            valid = false;
        }

        if( !$( "#ScfLastName" ).val() ) {
            $( "#lastName-info" ).html( "This field is required." );
            $( "#ScfLastName" ).css( 'background-color', '#FFFFDF' );
            valid = false;
        }

        if( !$( "#ScfEmail" ).val() ) {
            $( "#email-info" ).html( "You need to enter valid E-mail address." );
            $( "#ScfEmail" ).css( 'background-color', '#FFFFDF' );
            valid = false;
        }

        if( !$( "#ScfSubject" ).val() ) {
            $( "#subject-info" ).html( "This field is required." );
            $( "#ScfSubject" ).css( 'background-color', '#FFFFDF' );
            valid = false;
        }

        if( !$( "#ScfMessage" ).val() ) {
            $( "#message-info" ).html( "This field is required." );
            $( "#ScfMessage" ).css( 'background-color', '#FFFFDF' );
            valid = false;
        }

        return valid;
    }

    /**
     * Accordian of the front-end form
     */
    $( '.toggle' ).click( function( e ) {

        e.preventDefault();

        var $this = $( this );

        if ( $this.next().hasClass( 'show' ) ) {
            $this.next().removeClass( 'show' );
            $this.next().slideUp( 350 );
        } else {
            $this.parent().parent().find( 'li .inner' ).removeClass( 'show' );
            $this.parent().parent().find( 'li .inner' ).slideUp( 350 );
            $this.next().toggleClass( 'show' );
            $this.next().slideToggle( 350 );
        }
    });

});
