<?php

/**
 * Abstract components class
 *
 * @since 2.1
 */
abstract class w2cloud_Abstract_Modules {

    /**
     * The integration id
     *
     * @var boolean
     */
    public $id;

    /**
     * If the integration is enabled
     *
     * @var boolean
     */
    public $enabled;


    /**
     * The settings fields for this integrations
     *
     * @var array
     */
    protected $template = null;


    /**
     * Check if it's a pro field
     *
     * @return boolean
     */
    public function is_pro() {
        return false;
    }


    /**
     * Check if it's the forms page
     *
     * @return boolean
     */
    public function is_w2cloud_page() {
        if ( get_current_screen()->base != 'toplevel_page_wp-cloud' ) {
            return false;
        }

        return true;
    }

    /**
     * Load the individual template file if exists
     *
     * @return void
     */
    public function load_template() {
        if ( ! $this->is_w2cloud_page() ) {
            return;
        }

        if ( ! $this->template ) {
            return;
        }

        echo '<script type="text/x-template" id="w2cloud-module-' . $this->id . '">';
        include $this->template;
        echo '</script>';
    }



    /**
     * Get file prefix
     *
     * @return string
     */
    public function get_prefix() {
        $prefix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
        return $prefix;
    }
}
