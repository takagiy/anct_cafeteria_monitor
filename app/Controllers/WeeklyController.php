<?php

namespace App\Controllers;

use App\Models\Menu;
use Carbon\Carbon;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class WeeklyController extends Controller
{
    /**
     * Render the weekly page.
     *
     * @param [type] $args
     */
    public function index(Request $request, Response $response, $args)
    {
        $menus = $this->load_menus();
        echo '<!--';
        var_dump($menus);
        echo '-->';

        return $this->c->get('view')->render($response, 'weekly/index.twig', [
            'menus' => $menus,
        ]);
    }

    /**
     * Obtain the A sets and the B sets served within this week from the DB and then reforming them to a useful format.
     * The result is something like:
     * [
     *   [
     *     'day' => 'monday',
     *     'a_set' => <Menu>,
     *     'b_set' => <Menu>,
     *   ],
     *   [
     *	   'day' => 'tuesday',
     *	   'a_set' => <Menu>,
     *	   'b_set' => <Menu>,
     *   ],
     *   [
     *     'day' => 'wednesday',
     *     'a_set' => <Menu>,
     *     'b_set' => <Menu>,
     *   ],.
     *
     *   ...,
     *
     *   [
     *     'day' => 'friday',
     *     'a_set' => <Menu>,
     *     'b_set' => <Menu>,
     *   ],
     * ]
     */
    private function load_menus(): array
    {
        $menus = $this->load_raw_menus();
        $result = [];
        foreach ($menus as $menu) {
            $day = $menu->date->format('l');
            $result[$day] = $menu;
        }

        return $result;
    }

    /**
     *	Obtain the A sets and the B sets served within this week from the DB.
     */
    private function load_raw_menus(): array
    {
        // return all A sets and B sets served within this week.
        // return Menu::where(<...>)->where(<...>)->all();
        $now = Carbon::now();

        return Menu::whereBetween('date', [$now->startOfWeek(), $now->endOfWeek()])->orderBy('date', 'asc')->get()->toArray();
    }
}
