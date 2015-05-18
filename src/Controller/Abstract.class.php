<?php

namespace Controller;

/**
 * Base class for all Controllers
 *
 * @category  Controller
 * @package   Slim
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   MIT (http://opensource.org/licenses/MIT)
 * @link      N/A
 */
abstract class Controller_Abstract implements Controller_Interface
{
    /**
     * The Slim\Slim object for the current request
     *
     * @var Object
     */
    protected $app;

    /**
     * Base Controller Constructor
     *
     * @param object $app Instance of Slim\Slim
     * @return void
     */
    public function __construct(\Slim\Slim $app)
    {
        $this->app = $app;
    }

    /**
     * Dispatch a request to templating engine, detailing the template name and data.
     *
     * @param string $templateName [description]
     * @param array $templateData [description]
     * @return void
     */
    public function dispatch($templateName, $templateData = array()) {
        // Ensure we've a template name
        if (!empty($templateName))
        {
            $this->app->render(
                $templateName
                , $templateData
            );
        }
    }
}