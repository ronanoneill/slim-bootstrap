<?php

namespace Controller;

/**
 * Homepage controller
 *
 * @category  Controller
 * @package   Slim
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   MIT (http://opensource.org/licenses/MIT)
 * @link      N/A
 */
class Homepage extends Controller_Abstract
{
    /**
     * The Model object for the current Controller
     *
     * @var Object
     */
    private $_model;

    /**
     * Homepage Controller Constructor
     *
     * @param object $app Instance of Slim\Slim
     * @return void
     */
    public function __construct(\Slim\Slim $app, \Model\Homepage $model)
    {
        // Construct parent Controller_Abstract
        parent::__construct($app);
        // Define the model
        $this->_model = $model;
    }

    /**
     * Load the Homepage index view
     *
     * @return void
     */
    public function index()
    {
        parent::dispatch(
            'layout.twig.html'
            , $this->_model->data()
        );
    }
}