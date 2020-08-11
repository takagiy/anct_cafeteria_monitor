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
        $menus = $this->load_menus();

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
        $params = $request->getParsedBody();
        //$menu_id = filter_var($params['menu_id'], FILTER_VALIDATE_INT);
        $menu_id = intval($params['menu_id']);
        $is_sold = filter_var($params['is_sold'], FILTER_VALIDATE_BOOLEAN);

        $this->save_stock($menu_id, $is_sold);

        $response->getBody()->write(json_encode([
            'result' => 'OK',
            'is_sold' => $is_sold,
        ]));

        return $response->withHeader('Content-Type', 'application/json');
    }

    private function save_stock(int $id, bool $is_sold): void
    {
        $menu = Menu::findOrFail($id);
        $menu->sold = $is_sold;
        $menu->save();
    }

    /**
     * Obtain today's menus from the DB.
     */
    private function load_menus(): array
    {
        $today = date('Y-m-d');
        $permanent_menus = Menu::where('date', '=', $today)->where('type', '=', 'PERMANENT_MENU')->get()->toArray();
        $a_set = Menu::where('date', '=', $today)->where('type', '=', 'A_SET')->first();
        $b_set = Menu::where('date', '=', $today)->where('type', '=', 'B_SET')->first();

        return [
            'a_set' => $a_set,
            'b_set' => $b_set,
            'permanent' => $permanent_menus,
        ];
    }
}
