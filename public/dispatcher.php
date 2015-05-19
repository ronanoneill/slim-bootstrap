<?php
/**
 * Public Dispatcher
 *
 * @category  Dispatcher
 * @package   Slim
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   MIT (http://opensource.org/licenses/MIT)
 * @link      N/A
 */

// Include Composer's autoload https://getcomposer.org/doc/01-basic-usage.md#autoloading
require '../vendor/autoload.php';

// We're using UTF-8 strings until the end of the script
mb_internal_encoding('UTF-8');

// We'll be outputting UTF-8 to the browser
mb_http_output('UTF-8');

// Create instance of Slim
$app = new \Slim\Slim(
	array(
		'debug' => true
		, 'templates.path' => '../src/Templates'
		, 'view' => new \Slim\Views\Twig()
	)
);

// @TODO: Configure Twig options / extensions

/*
 * Application Routes
 */

// Homepage
$app->get('/', function() use ($app) {
	$homepage = new \Controller\Homepage(
		$app
		, new \Model\Homepage()
	);
	$homepage->index();
})->name('homepage');

// Run the application
$app->run();