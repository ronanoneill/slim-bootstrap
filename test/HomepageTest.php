<?php
/**
 * Tests for the Homepage Controller / Model
 *
 * @category  Test
 * @package   Slim
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   MIT (http://opensource.org/licenses/MIT)
 * @link      N/A
 */
class HomepageTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test Homepage data()
     *
     * @return void
     */
    public function testHomepage()
    {
        // Define the data
        $homepageModel = new \Model\Homepage();
        $testData = $homepageModel->data();
        // Perform assertions
        $this->assertEquals(1, count($testData));
        $this->assertEquals('data_value', $testData['data_key']);
    }
}