<?php
/**
 * Post Status class
 *
 * @namespace UsabilityDynamics
 * @author peshkov@UD
 */
namespace UsabilityDynamics\CPS {

  if( !class_exists( 'UsabilityDynamics\CPS\Post_Status' ) ) {

    /**
     * Post_Status
     *
     * @class Post_Activity
     * @author: peshkov@UD
     */
    class Post_Status {

      /**
       * @var array
       */
      var $args;

      /**
       * @var string
       */
      var $id;

      /**
       * @var array
       */
      var $post_types;

      /**
       * Constructor
       *
       * @author peshkov@UD
       */
      public function __construct( $args ) {

        $this->id = $args['id'];
        $this->post_types = $args['post_types'];
        $this->args = $args;

        /** Register */
        register_post_status( $this->id, $this->args );

        add_action( 'admin_footer-post.php', array( $this, 'post_screen_js' ) );

      }

      /**
       * Modify the DOM on post screens
       *
       */
      public function post_screen_js() {
        global $post;

        if( in_array( $post->post_type, $this->post_types ) ) {
          ?>
          <script>
            jQuery(document).ready(function ($) {
              $('#post_status').append('<option value="<?php echo $this->id; ?>"><?php esc_html_e( $this->args[ 'label' ] ) ?></option>');
            });
          </script>
          <?php
        }

      }



    }
  
  }
  
}