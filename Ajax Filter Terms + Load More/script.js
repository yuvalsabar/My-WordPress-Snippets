function ajax_filter_terms() {
    $('.btn-filter').click(function(e) {
        e.preventDefault();
        var data  = $(this).data();
        var key   = Object.keys(data)[0];
        var value = $(this).data(key); 

        $('.row-posts').addClass('loading');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: site_object.ajaxurl,
            data: {
                action: 'ajax_filter_terms',
                taxonomy: key,
                term_id: value
            },
            
            success: function(results) {
                $('.row-posts').removeClass('loading');
                $('.row-posts').html('');
                $('.row-posts').html(results.html);
                $('.load-more-container').html('');
                $('.load-more-container').html(results.load_more_html);
            }
        });
    });
}

function ajax_load_more() {
    $('body').on('click', '.btn-load-more', function(e) {
        btn    = $(this);
        append = $(this).data('append');
        query  = $(this).data('query');
        offset = $(this).data('offset');

        e.preventDefault();
        if ( ! $('.loader-wrap .loader').length ) {
            $('.loader-wrap').append('<div class="loader"></div>');
        }

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: site_object.ajaxurl,
            data: {
                'action': 'ajax_load_more',
                'args': query,
                'offset': offset
            },

            success: function(results) {
                $(append).append(results.html);
                AOS.init();
                $('.loader-wrap .loader').remove();
                if ( ! results.more ) {
                    $('.btn-load-more').remove();
                }
            }
        });

        offset = $(this).data('offset') + query.posts_per_page;
        btn.attr('data-offset', offset);
        btn.data('offset', offset);
    });
    
    // Prevent ajax from firing multiple times
    $(window).scroll( _.throttle(load_more_on_scroll, 500) );
}

function load_more_on_scroll() {
    if ( $(window).scrollTop() + $(window).height() > $(document).height() - 300 ) {
        $('.btn-load-more').trigger('click');
    }
}
