<?php
/**
 * Ajax Format <tr>
 */
add_action( 'wp_ajax_nopriv_ajax_format_tr', 'ajax_format_tr' );
add_action( 'wp_ajax_ajax_format_tr', 'ajax_format_tr' );

function ajax_format_tr() {
    $post_id  = intval( $_POST['data']['post_id'] );
    $template = sanitize_text_field( $_POST['data']['template'] );

    if ( $template == 'tenders' ) : 

        $file = get_field( 'file', $post_id );

        ob_start();?>

        <div class="hidden-content">
            <div class="entry-content">
                <?php the_field( 'content', $post_id );?>
            </div>

            <?php if ( $file ) : ?>
                
                <a href="<?php echo $file['url'];?>" class="btn btn-blue" target="_blank">
                    <?php echo $file['title'];?>
                    <span class="icomoon icomoon-pdf" aria-hidden="true"></span>
                </a>

            <?php endif;?>
        </div>
    
    <?php endif;

    $result = ob_get_clean();

    wp_send_json( $result );
}