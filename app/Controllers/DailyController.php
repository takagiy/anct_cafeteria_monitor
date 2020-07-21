<?php

namespace App\Controllers;

use App\Models\Menu;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DailyController extends Controller
{
    /**
     * Render the daily page.
     *
     * @param [type] $args
     */
    public function index(Request $request, Response $response, $args)
    {
        $params = $request->getQueryParams();
        $menus = Menu::all(); //$this->c->get('db')->table('menus')->get();

        return $this->c->get('view')->render($response, 'daily/index.twig', [
            'name' => $params['name'] ?? 'World',
            'menus' => $menus,
        ]);
    }

    public function get_menus(Request $request, Response $response, $args)
    {
    }

    /**
     * Change the sold state of dish.
     *
     * @param [type] $args
     */
    public function set_stock(Request $request, Response $response, $args)
    {
    }
}
