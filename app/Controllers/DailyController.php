<?php

namespace App\Controllers;

use App\Controllers\Controller;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class DailyController extends Controller
{
    /**
     * Render the daily page
     *
     * @param Request $request
     * @param Response $response
     * @param [type] $args
     * @return void
     */
    public function index(Request $request, Response $response, $args)
    {
	$params = $request->getQueryParams();
	return $this->c->get('view')->render($response, 'daily/index.twig', [
		'name' => $params['name'] ?? 'World',
	]);
    }

    public function get_menus(Request $request, Response $response, $args)
    {
    
    }

    /**
     * Change the sold state of dish
     *
     * @param Request $request
     * @param Response $response
     * @param [type] $args
     * @return void
     */
    public function set_stock(Request $request, Response $response, $args)
    {
    $params = $request->getQueryParams();
    $menu_id = $params['menu_id'] ?? 'none';
    $is_sold = $params['is_sold'] ?? 'none';

    }
}

