(($) => {
    "use strict";

    // define the form on this page as thisForm
    let thisForm = document.querySelector('#conversion_form');
    var loc = window.location.pathname,
            // define the current working directory as cwd
            cwd = loc.substring(0, loc.lastIndexOf('/')),
            // create default form variables in the global scope
            theToValue = $('#to_value_input'),
            theFromValue = $('#from_value_input'),
            theToSelect = $('#to_unit'),
            theFromSelect = $('#from_unit');


    // button as a custom-select list -- shows selected text
    $('.dropdown-menu a').click(function (e) {
        var selText = $(this).text();
        $(this).parents('#btn-group').find('.custom-select').html(selText);
    });

    // selects all text in the input box on focus
    $("input[type='number']").on('focus', function () {
        $(this).select();
    });

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

    // jQuery plugin to grab query string params
    $.QueryString = (function (paramsArray) {
        let params = {};
        for (let i = 0; i < paramsArray.length; ++i)
        {
            let param = paramsArray[i]
                    .split('=', 2);
            if (param.length !== 2)
                continue;
            params[param[0]] = decodeURIComponent(param[1].replace(/\+/g, " "));
        }
        return params;
    })(window.location.search.substr(1).split('&'));

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

    /**
     * Submits the form using FormData when called
     * 
     * @param {input|submit} event
     * @returns {int|float}
     */
    function ajax_submit(event) {
        var t = $(this);
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



    /**
     * Selects desired default options from select drop downs
     * 
     * The first param, opt1, should be the value of the select option from the
     * from_unit select. Given that you want 'feet' to be selected, this option
     * should be 'feet' or whatever the value of the option to be displayed is.
     * 
     * The second param, opt1_value, is the value that should be assigned to the
     * to_value_input. If, for instance, p=temperature and the desired view by 
     * default is to show the user 95 degrees F = 35 degrees celsius, then use:
     * 
     * <code>select('fahrenheit', 95, 'celsius');</code>
     * 
     * This will select 'fahrenheit', assign the int 95 to the input box, 
     * select 'celsius' from the to_unit select box and submit the form.
     * 
     * The final param is opt2. If the desired default value that originally 
     * populates is fine, then this param need not be used.
     * @param {string} opt1
     * @param {float|int} opt1_value
     * @param {string} opt2
     * @returns {void}
     */
    function select(opt1, opt1_value, opt2 = '') {
        // select a default option
        $('#from_unit option[value=' + opt1 + ']').prop('selected', true);
        $('#from_value_input').val(opt1_value);
        // select an optional second option for the to_unit
        switch (opt2) {
            case '':
                break;
            default:
                $('#to_unit option[value=' + opt2 + ']').prop('selected', true);
        }
        // submit the form 
        $('#submit').trigger('click');
    }
    // define the page variable
    var page = $.QueryString['p'];
    // default the value for from_value
    $('#from_value_input').val(1);
    switch (page) {
        case undefined:
            page = 'length';
            select('feet', 1);
            break;
        case 'length':
            select('feet', 1);
            break;
        case 'area':
            select('square_feet', 1);
            break;
        case 'volume':
            select('us_cups', 1, 'metric_cups');
            break;
        case 'mass':
            select('pounds', 1, 'ounces');
        case 'speed':
            select('miles_per_hour', 1, 'nautical_miles_per_hour');
            break;
        case 'temperature':
            select('fahrenheit', 95, 'celsius');
            break;
        case 'digital':
            select('gigabytes', 1, 'megabytes');
            break;
        default:
            // PHP defaults the page to length. 
            select('feet', 1);

    }

})(jQuery); // End of use strict
