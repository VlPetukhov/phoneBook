/**
 * Ajax Routine
 */
(function($){
    var container = $('#search-container'),
        numberInput = $('#number-input'),
        nameInput = $('#name-input'),
        addressInput = $('#address-input');

    $('.body-content').on('click', 'button.ajax-button', function(){
        var value ='',
            data = {},
            $this = $(this);


        if ( 'number' === $this.data('type') ) {
            value = numberInput.val();
            addressInput.val('');
            nameInput.val('');
            data = {'PhoneNumber[number]' : value };
        }

        if ( 'surname' === $this.data('type') ) {
            value = nameInput.val();
            addressInput.val('');
            numberInput.val('');
            data = {'PhoneNumber[fullname]' : value };
        }

        if ( 'address' === $this.data('type') ) {
            value = addressInput.val();
            numberInput.val('');
            nameInput.val('');
            data = {'PhoneNumber[address]' : value };
        }

        $.get(
            $this.data('baseurl'),
            data,
            function( response ){
                container.html(response);
            }
        );
    });

})(jQuery);