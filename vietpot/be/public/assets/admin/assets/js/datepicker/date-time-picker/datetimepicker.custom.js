(function($) {
    "use strict";

//Minimum Setup
    $(function () {
        $('#dt-minimum').datetimepicker();
    });

//Using Locales
    $(function () {
        $('#dt-local').datetimepicker({
            locale: 'ru'
        });
    });
// Time only
    $(function () {
        $('#dt-time').datetimepicker({
            format: 'LT'
        });
    });
//Date only
    $(function () {
        $('#dt-date').datetimepicker({
            format: 'L'
        });
    });
//No Icon
    $(function () {
        $('#dt-noicon').datetimepicker();
    });
//Enabled/Disabled Dates
    $(function () {
        $('#dt-enab-disab-date').datetimepicker({format:'DD/MM/YYYY HH:mm:ss'});
    });
//view mode
    $(function () {
        $('#dt-view').datetimepicker({
            viewMode: 'years'
        });
    });
//Disabled Days of the Week
    $(function () {
        $('#dt-disab-days').datetimepicker({
            daysOfWeekDisabled: [0, 6]
        });
    });

})(jQuery);