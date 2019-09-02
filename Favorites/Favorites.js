// Dependencies: js-cookie  - https://github.com/js-cookie/js-cookie

function favorite_posts_init() {
      favorites = Cookies.getJSON('favorite_posts');
      
      if ( favorites ) {
          obj = favorites;
      } else {
          obj = {};
      }
  
      $('.btn-favorites').click(function(e) {
          e.preventDefault();
          $(this).toggleClass('is-favorite');
          var postid =  $(this).data('postid');
      
          if ( $.isEmptyObject( obj ) ) {
              var tmp = {};
              tmp["p" + postid] = postid;
              $.extend(obj, tmp);
          } else {
              if ( obj['p' + postid] ) {
                  delete obj['p' + postid];
              } else {
                  obj['p' + postid] = postid;
              }
          }
  
          Cookies.set( 'favorite_posts', obj, { expires: 120 } );
      });
  }