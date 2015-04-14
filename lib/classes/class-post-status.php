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

        add_action("admin_footer-post.php", array($this, "append_to_post_status_dropdown"));
        add_action("admin_footer-edit.php", array($this, "append_to_inline_status_dropdown"));
        add_filter("display_post_states", array($this, "update_post_status"));

      }

      /**
       * Append the custom post type to the post status
       * dropdown on the edit pages of posts.
       * @return null
       */
      public function append_to_post_status_dropdown() {
        global $post;
        $selected = "";
        $misc_label = "";
        $label = esc_html( $this->args[ 'label' ] );
        $submit_label = __( 'Save' );
        if (in_array($post->post_type, $this->post_types)) {
          if ($post->post_status === $this->id) {
            $selected = " selected=\"selected\"";
            $misc_label = "<span id=\"post-status-display\">{$label}</span>";
          }
          echo "
            <script>
            jQuery(document).ready(function ($){
                 $('select#post_status').append('<option value=\"{$this->id}\"{$selected}>{$label}</option>');
                 $('.misc-pub-section label').append('$misc_label');
                 $('#save-post').val('{$submit_label}');
            });
            </script>";
        }
      }

      /**
       * Append the custom post type to the post status
       * dropdown in the quick edit area on the post
       * listing page.
       * @return null
       */
      public function append_to_inline_status_dropdown() {
        global $post;
        // no posts
        if (!$post) return;
        $label = esc_html( $this->args[ 'label' ] );
        if (in_array($post->post_type, $this->post_types)) {
          echo "
            <script>
            jQuery(document).ready(function ($){
              $('.inline-edit-status select').append('<option value=\"{$this->id}\">{$label}</option>');
            });
            </script>";
        }
      }

      /**
       * Update the text on edit.php to be more
       * descriptive of the type of post (text
       * that labels each post)
       * @return null
       */
      public function update_post_status($states) {
        global $post;
        $status = get_query_var("post_status");
        if ($status !== $this->id && $post->post_status === $this->id){
          return array($this->args[ 'label' ]);
        }
        return $states;
      }

    }
  
  }
  
}