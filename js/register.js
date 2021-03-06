$( function() {

    $( document ).on( 'change', '#registerForm input[name=email]', function() {
        $.post( '/register/checkEmail', {
            email: $( this ).val(),
        }, function( data ) {
            if ( $.trim( data ) === 'exists' ) {
                $( '.emailError' ).remove();
                $( 'input[name=email]' ).parent().addClass( 'has-error' ).append( '' +
                    '<p class="red bold emailError"> This email address is already in use </p>'
                );
                $( '#registerForm button[type=submit]' ).attr( 'disabled', 'disabled' );
            } else {
                $( 'input[name=email]' ).parent().removeClass( 'has-error' );
                $( '.emailError' ).remove();
                $( '#registerForm button[type=submit]' ).removeAttr( 'disabled' );
            }
        } );
    } );

    $( document ).on( 'change', '#registerForm input[name=username]', function() {
        $.post( '/register/checkUsername', {
            username: $( this ).val(),
        }, function( data ) {
            if ( $.trim( data ) === 'exists' ) {
                $( '.usernameError' ).remove();
                $( 'input[name=username]' ).parent().addClass( 'has-error' ).append( '' +
                    '<p class="red bold usernameError"> This username is already in use </p>'
                );
                $( '#registerForm button[type=submit]' ).attr( 'disabled', 'disabled' );
            } else {
                $( 'input[name=username]' ).parent().removeClass( 'has-error' );
                $( '.usernameError' ).remove();
                $( '#registerForm button[type=submit]' ).removeAttr( 'disabled' );
            }
        } );
    } );

} );