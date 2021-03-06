<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		JLP
 * @copyright           2010-2015, James L. Parry
 * ------------------------------------------------------------------------
 */
class Application extends CI_Controller {

    protected $data = array();      // parameters for view components
    protected $id;                  // identifier for our content

    /**
     * Constructor.
     * Establish view parameters & load common helpers
     */

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->data['title'] = '?';
        $this->errors = array();
        $this->data['pageTitle'] = '??';
    }

    /**
     * Render this page
     */
    function render() {
//        $this->data['menubar'] = $this->parser->parse('_menubar', $this->config->item('menu_choices'),true);
        
       // $this->data['panel1'] = $this->parser->parse($this->data['panel1'], $this->data, true);
        //$this->data['panel2'] = $this->parser->parse($this->data['playercontent'], $this->data, true);

        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
        $this->data['menucontent'] = $this->parser->parse($this->data['menubody'], $this->data, true);

        // finally, build the browser page!
        $this->data['data'] = &$this->data;
        $this->parser->parse('_template', $this->data);
    }

}
