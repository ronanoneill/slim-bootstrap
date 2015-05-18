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

require '../vendor/autoload.php';

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