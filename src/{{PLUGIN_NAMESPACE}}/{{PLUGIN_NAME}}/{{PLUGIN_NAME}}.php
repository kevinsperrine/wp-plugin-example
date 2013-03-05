<?php

/**
* {{PLUGIN_NAMESPACE}}_{{PLUGIN_NAME}}_{{PLUGIN_NAME}}
*
* @uses
*
* @category {{PLUGIN_NAME}}
* @package  Package
* @author   Kevin S. Perrine <kperrine@gmail.com>
* @license  MIT http://opensource.org/licenses/MIT
* @link     http://kevinsperrine.com
*/
class {{PLUGIN_NAMESPACE}}_{{PLUGIN_NAME}}_{{PLUGIN_NAME}}
{
    protected $wp;

    /**
     * __construct
     *
     * @param $facade \C3_Facade_WordPress Allows inserting a different facade object for testing.
     *
     * @access public
     *
     * @return void
     */
    public function __construct()
    {
        $this->setFacade();
    }

    /**
     * setFacade
     *
     * @param $facade \C3_Facade_WordPress Allows inserting a different facade object for testing.
     *
     * @access public
     *
     * @return void
     */
    public function setFacade(C3_Support_Facade_WordPress $facade = null)
    {
        $this->wp = ($facade) ? $facade : new C3_Support_Facade_WordPress();
    }


    /**
     * initialize should take care of registering all hooks and actions. These
     * calls should be made through the WordPress Facade and not directly to
     * WordPress.
     *
     * @access public
     *
     * @return void
     */
    public function initialize()
    {
        $this->wp->add_action('wp_enqueue_scripts', array($this, 'enqueuePublicScripts'));
    }

    /**
     * enqueuePublicScripts
     *
     * @access public
     *
     * @return mixed Value.
     */
    public function enqueuePublicScripts()
    {
        if (! $this->wp->wp_script_is('jquery', 'enqueue')) {
            wp_enqueue_script(
                'jquery',
                "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js",
                false,
                '1.8.3',
                true
            );
        }
    }
}
