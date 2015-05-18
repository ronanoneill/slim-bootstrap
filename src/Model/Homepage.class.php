<?php

namespace Model;

/**
 * Base class for all models
 *
 * @category  Model
 * @package   Slim
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   MIT (http://opensource.org/licenses/MIT)
 * @link      N/A
 */
class Homepage extends Model_Abstract
{
    /**
     * Define the required view data for the Homepage
     *
     * @return array Required data for view
     */
    public function data() {
        return array('data_key' => 'data_value');
    }
}