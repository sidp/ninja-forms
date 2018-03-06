<?php if ( ! defined( 'ABSPATH' ) ) exit;

class NF_AJAX_REST_Batch_Process extends NF_AJAX_REST_Controller
{
    protected $action = 'nf_batch_process';
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * POST /forms/<id>/
     * @param array $request_data [ int $clone_id ]
     * @return array $data [ int $new_form_id ]
     */
    public function post( $request_data )
    {
        $data = array();
        
        // If we don't have a nonce...
        // OR if the nonce is invalid...
        if ( ! isset( $request_data[ 'security' ] ) || ! wp_verify_nonce( $request_data[ 'security' ] ) ) {
            // Kick the request out now.
            $data[ 'error' ] = __( 'Request forbidden.', 'ninja-forms' )
        }
        // If we have a batch type...
        if ( isset( $request_data[ 'batch_type' ]) ){
            $batch_type = $request_data[ 'batch_type' ];
            // Route the request to the proper controller.
            switch ( $batch_type ) {
                case 'chunked_publish':
                    break;
                case 'delete_submissions':
                    break;
                default:
                    $data[ 'error' ] = __( 'Invalid request.', 'ninja-forms' );
                    break;
            }
        } // Otherwise... (We don't have a batch type.)
        else {
            // Kick the request out.
            $data[ 'error' ] = __( 'Invalid request.', 'ninja-forms' );
        }
        return $data;
    }
}
