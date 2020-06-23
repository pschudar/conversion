(($) => {
    "use strict";

    // show toast msg
    //$('#typeError').toast('show');

    // button as a custom-select list -- shows selected text
    $(".dropdown-menu a").click(function (e) {
        var selText = $(this).text();
        $(this).parents('.btn-group').find('.custom-select').html(selText);
    });
    /**
     * Determines whether to show the spinner
     * 
     * Accepts one parameter. Valid options are 'yes', 'y', 'no', or 'n'.
     * This allows the function to read like a sentence making it easier to use.
     * <code>DisplaySpinner('n');</code> is a clear indication that it should not show.
     * @param {string} opt
     * @returns {undefined}
     */
    function DisplaySpinner(opt) {
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
        var spinner = document.querySelector("#conversion-spinner");
        spinner.style.display = option;
    }
    // Hide the spinner by default
    DisplaySpinner('no');

    var eventCases = 'input';
    let thisForm = document.querySelector('#conversion_form');


    function ajax_submit(event) {
        var $form = $(this),
                loc = window.location.pathname,
                cwd = loc.substring(0, loc.lastIndexOf('/'));
        let fd = new FormData(thisForm);
        event.preventDefault();
        var url = $form.attr("action"),
                zero = cwd + '/includes/shared/zero.txt',
                from_value_input = $('#from_value_input').val();
        // only POST when there is data
        if (!from_value_input) {
            var req = $.get({
                url: zero
            });
            $('#to_value_input').val(0);
        }
        if (from_value_input) {
            // Show the spinner
            DisplaySpinner('yes');
            var req = $.post({
                url: url,
                data: fd,
                type: "POST",
                processData: false,
                contentType: false
            });
        }
        req.done(function () {
            var obj = JSON.parse(req.responseText);
            if (obj.typeError === true) {
                $('#typeError').toast('show');
            }
            $('#to_value_input').val(obj.to_value);
            // Hide the spinner
            DisplaySpinner('no');
        });
    }

    $('#conversion_form').on(eventCases, ajax_submit);
    $('#conversion_form').submit(ajax_submit);

})(jQuery); // End of use strict