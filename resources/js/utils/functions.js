$.fn.tel = function () {
    $.each($(this), (index, element) => {
        $(element).attr("href", 'tel:' + $(element).text().replace(/\s/g, ''));
    });
};
$.fn.mailto = function () {
    $.each($(this), (index, element) => {
        $(element).attr("href", 'mailto:' + $(element).text().replace(/\s/g, ''));
    });
};
$.fn.alt = function () {
    $.each($(this), (index, element) => {
        var src = $(element).attr('src');
        var alt = $(element).attr('alt');
        if (src != '' && alt == '') {
            var alt = src.split('/').pop()
                .replace(/\.[^.]*$/, '')
                .replace(/[_-]/g, ' ');

            $(element).attr('alt', alt);
        }
    });
};
$.fn.placeholder = function () {
    $.each($(this), (index, element) => {
        var $input = $(element).find(':input');
        var $label = $(element).find('label');
        $input.attr('placeholder', $label.text());
    });
};

$.fn.logo = function() {
    if ($('body').is('[data-logo]') ) {
        $.each($(this), (index, element) => {
            $(element).attr({
                'src': $('body').attr('data-logo')
            });
        });
    }
};