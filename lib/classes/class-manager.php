<?php
/**
 * Manager class
 *
 * @namespace UsabilityDynamics
 * @author peshkov@UD
 */
namespace UsabilityDynamics\CPS {

  if( !class_exists( 'UsabilityDynamics\CPS\Manager' ) ) {

    /**
     * Manager
     *
     * @class Manager
     * @author: peshkov@UD
     */
    class Manager {

      /**
       * The list of custom post statuses.
       *
       * @type array
       * @author peshkov@UD
       */
      private static $statuses = array();

      /**
       * Adds custom post status to general list
       *
       * @return bool
       * @author peshkov@UD
       */
      static public function set( $args ) {

        if( function_exists( 'did_action' ) && did_action( 'init' ) && current_filter() !== 'init' ) {
          _doing_it_wrong( __FUNCTION__, __( 'method must be called before or during \'init\' action.' ), '1.0' );
          return false;
        }

        //** Initialize our structure at last moment. */
        if( !has_action( 'init', array( __CLASS__, 'init' ) ) ) {
          add_action( 'init', array( __CLASS__, 'init' ), 999 );
        }

        $args = self::normalize_args( $args );
        // Looks like some required arguments are missed.
        if( !$args ) {
          return false;
        }

        array_push ( self::$statuses, $args );

        return true;
      }

      /**
       * Register our custom post statuses.
       * Note: must not be called directly.
       *
       * @author peshkov@UD
       */
      static public function init() {

        if( current_filter() !== 'init' ) {
          _doing_it_wrong( __FUNCTION__, __( 'method must be called during \'init\' action.' ), '1.0' );
        }

        foreach( self::$statuses as $args ) {
          new Post_Status( $args );
        }
      }

      /**
       * Prepare arguments.
       *
       * @author peshkov@UD
       */
      static protected function normalize_args( $args ) {

        $args = wp_parse_args( $args, array(
          'id' => false,
          'label' => '',
          'post_types' => array(),
        ) );

        if( empty( $args[ 'id' ] ) || empty( $args[ 'post_types' ] ) ) {
          return false;
        }

        if( is_string( $args[ 'post_types' ] ) ) {
          $args[ 'post_types' ] = array( $args[ 'post_types' ] );
        }

        if( empty( $args['label'] ) ) {
          $args['label'] = $args['key'];
        }

        if( empty( $args['label_count'] ) ) {
          $args['label_count'] = _n_noop($args['label'] . ' <span class="count">(%s)</span>', $args['label'] . ' <span class="count">(%s)</span>');
        }

        return $args;
      }

    }
  
  }
  
}