// Dependencies: https://github.com/js-cookie/js-cookie

function gdpr_init() {
    $('.btn-gdpr').click(function(e) {
        e.preventDefault();
        
        $('.gdpr-cookies').slideToggle();

        Cookies.set('gdpr', 1, { expires: 7 });
    });
}