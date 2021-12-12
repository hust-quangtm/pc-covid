function passCountry ()
{
    var pass_country_check = document.getElementById('customRadioInline2').checked;
    var pass_country_none = document.getElementById('customRadioInline1').checked;

    if(pass_country_check) {
        $('.country-note').show();
    }

    if(pass_country_none) {
        $('.country-note').hide();
    }
}

function hasSignal ()
{
    var signal_check = document.getElementById('customRadioInline4').checked;
    var signal_none = document.getElementById('customRadioInline3').checked;

    if(signal_check) {
        $('.signal-note').show();
    }

    if(signal_none) {
        $('.signal-note').hide();
    }
}
