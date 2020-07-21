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
        $menus = Menu::all();

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
    }

    /**
     * Obtain today's menus from the DB.
     */
    private function load_menus(): array
    {
        // $today = <TODAY...>;
        // $today_menus = Menu::where(<QUERY...>);
        // $permanent_menus = $today_menus->where(<QUERY...>)->all();
        // $a_set = $today_menus->where(<QUERY...>)->all();
        // $b_set = $today_menus->where(<QUERY...>)->all();
        // return [
        //   'a_set' => $a_set,
        //   'b_set' => $b_set,
        //   'permanent' => $parmanent,
        // ];
    }
}
