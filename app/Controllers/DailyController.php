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
        //$menus = Menu::all();
        $menus = $this->load_menus();
        echo '<!--';
        var_dump($menus);
        echo '-->';

        return $this->c->get('view')->render($response, 'daily/index.twig', [
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
    $params = $request->getQueryParams();
    $menu_id = $params['menu_id'] ?? 'none';
    $is_sold = $params['is_sold'] ?? 'none';

    }

    /**
     * Obtain today's menus from the DB.
     */
    private function load_menus(): array
    {
        $today = '2020-07-07'; //date('Y-m-d');
        $permanent_menus = Menu::where('type', '=', 'PERMANENT_MENU')->get()->toArray();
        $a_set = Menu::where('date', '=', $today)->where('type', '=', 'A_SET')->first();
        $b_set = Menu::where('date', '=', $today)->where('type', '=', 'B_SET')->first();

        return [
            'a_set' => $a_set,
            'b_set' => $b_set,
            'permanent' => $permanent_menus,
        ];
    }
}
