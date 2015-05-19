<?php

namespace Controller;

/**
 * Interface for all Controllers
 *
 * @category  Controller
 * @package   Slim
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   MIT (http://opensource.org/licenses/MIT)
 * @link      N/A
 */
interface Controller_Interface
{
    /**
     * Dispatch a request to templating engine, detailing the template name and data.
     *
     * @param string $templateName [description]
     * @param array $templateData [description]
     * @return void
     */
    public function dispatch($templateName, $templateData = array());
}