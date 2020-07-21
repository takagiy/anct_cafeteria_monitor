<?php

namespace App\Controllers;

use App\Controllers\Controller;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};
use App\Models\Menu;

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
	$menus = Menu::all();//$this->c->get('db')->table('menus')->get();
	return $this->c->get('view')->render($response, 'daily/index.twig', [
		'name' => $params['name'] ?? 'World',
		'menus' => $menus,
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
    }
}

