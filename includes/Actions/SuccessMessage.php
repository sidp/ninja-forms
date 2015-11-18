<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Action_SuccessMessage
 */
final class NF_Actions_SuccessMessage extends NF_Abstracts_Action
{
    /**
    * @var string
    */
    protected $_name  = 'successmessage';

    /**
    * @var array
    */
    protected $_tags = array();

    /**
    * @var string
    */
    protected $_timing = 'normal';

    /**
    * @var int
    */
    protected $_priority = '10';

    /**
    * Constructor
    */
    public function __construct()
    {
        parent::__construct();

        $settings = Ninja_Forms::config( 'ActionSuccessMessageSettings' );

        $this->_settings = array_merge( $this->_settings, $settings );

        add_action( 'nf_before_import_form', array( $this, 'import_form_action_success_message' ), 11 );
    }

    /*
    * PUBLIC METHODS
    */

    public function save()
    {

    }

    public function process( $action_settings, $form_id, $data )
    {
        $data['success_message'] = $action_settings[ 'message' ];

        return $data;
    }

    public function import_form_action_success_message( $import )
    {
        if( ! isset( $import[ 'actions' ] ) ) return $import;

        foreach( $import[ 'actions' ] as &$action ){

            if( 'success_message' == $action[ 'type' ] ){

                $action[ 'type' ] = 'successmessage';
            }
        }

        return $import;
    }
}