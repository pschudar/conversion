(($) => {
    "use strict";

    // button as a custom-select list -- shows selected text
    $(".dropdown-menu a").click(function (e) {
        var selText = $(this).text();
        $(this).parents('#btn-group').find('.custom-select').html(selText);
    });

    /**
     * Determines whether to show the spinner
     * 
     * Accepts one parameter. Valid options are 'yes', 'y', 'no', or 'n'.
     * This allows the function to read like a sentence making it easier to use.
     * <code>displaySpinner('n');</code> is a clear indication that it should not show.
     * @param {string} opt
     * @returns {undefined}
     */
    function displaySpinner(opt) {
        switch (opt) {
            case 'yes':
            case 'y':
                var option = 'block';
                break;
            case 'no':
            case 'n':
                var option = 'none';
                break;
            default:
                var option = 'none';
                break;
        }
        var conversionSpinner = document.querySelector('#conversion-spinner');
        conversionSpinner.style.display = option;
    }

    // Hide the spinner by default
    displaySpinner('no');
    
    // define thisForm
    let thisForm = document.querySelector('#conversion_form');
    
    // create form variables in the global scope
    var theToValue;
    var theFromValue;
    var theToSelect;
    var theFromSelect;

    // add event listener to input box
    $('#from_value_input').on('input', function () {
        // define form variables based on this input
        theToValue = $('#to_value_input');
        theFromValue = $('#from_value_input');
        theToSelect = $('#to_unit');
        theFromSelect = $('#from_unit');
    });

    // add event listener to input box
    $('#to_value_input').on('input', function () {
        // define form variables based on this input
        theToValue = $('#from_value_input');
        theFromValue = $('#to_value_input');
        theToSelect = $('#from_unit');
        theFromSelect = $('#to_unit');
    });
    
    /**
     * Submits the form using FormData when called
     * 
     * @param {input|submit} event
     * @returns {int|float}
     */
    function ajax_submit(event) {
        var t = $(this),
                loc = window.location.pathname,
                cwd = loc.substring(0, loc.lastIndexOf('/'));
        let fd = new FormData(thisForm);
        // set the formData to the correct values
        fd.set('to_value', theToValue.val());
        fd.set('from_value', theFromValue.val());
        fd.set('to_unit', theToSelect.val());
        fd.set('from_unit', theFromSelect.val());
        // prevent the from from submitting
        event.preventDefault();
        // define the url for Ajax form submission
        var url = t.attr('action'),
                zero = cwd + '/includes/shared/zero.txt';

        // grabs zero.txt when input is completely removed or deleted
        if (!theFromValue.val()) {
            var req = $.get({
                url: zero
            });
        }
        if (theFromValue.val()) {
            // Show the spinner
            displaySpinner('yes');
            // define the post request 
            var req = $.post({
                url: url,
                data: fd,
                processData: false,
                contentType: false
            });
        }
        // upon completion...
        req.done(function () {
            // parse the responseText
            var obj = JSON.parse(req.responseText);
            if (obj.typeError === true) {
                // show the toast if a typeError was encountered
                $('#typeError').toast('show');
            }
            // write the calculation to the browser
            $(theToValue).val(obj.to_value);
            // Hide the spinner
            displaySpinner('no');
        });
    }
    // process the form in real time
    $('#conversion_form').on('input', ajax_submit);
    // process the form on submit
    $('#conversion_form').submit(ajax_submit);

})(jQuery); // End of use strict
