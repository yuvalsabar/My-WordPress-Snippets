function add_to_favorites() {
    $('.btn-favorites').click(function(e) {
        e.preventDefault();
        var $btn      = $(this);
        var post_type     = $btn.data('postType');
        var post_id       = $btn.data('postId').toString();
        var old_val       = Cookies.get( 'favs_' + post_type ) ? Cookies.get( 'favs_' + post_type ) : '';

        $btn.toggleClass('is-favorite');
        
        if ( ! old_val ) {
            Cookies.set( 'favs_' + post_type, post_id );
        } else {
            var favs_arr = old_val.split("|");

            // If clicked post id is not in favs
            if ( favs_arr.indexOf( post_id ) == -1 ) {
                var new_val = old_val ? old_val + '|' + post_id : post_id;
                Cookies.set( 'favs_' + post_type, new_val );  
            } 
        
            // If clicked post id is in favs
            else {
                var index = favs_arr.indexOf( post_id );
                favs_arr.splice(index, 1);
                Cookies.set( 'favs_' + post_type, favs_arr.join('|') );  
            }
        }
    });
}