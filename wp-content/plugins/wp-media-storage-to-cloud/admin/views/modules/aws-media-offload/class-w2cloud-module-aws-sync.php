<?php
class w2cloud_aws_sync extends w2cloud_Abstract_Modules {

    public function __construct() {
        $this->id         = 'awsSync';
        $this->template   = dirname( __FILE__ ) . '/template.php';
        add_filter( 'admin_footer', array( $this, 'load_template' ) );
    }
}
