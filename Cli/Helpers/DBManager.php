<?php

namespace Cli\Helpers;

use App\Models\Menu;
use Carbon\Carbon;

class DBManager
{
    public function updateDate()
    {
        $oldest = Carbon::parse(Menu::min('date'));
        $delta = Carbon::now()->startOfWeek()->diffInDays($oldest, false);

        $menus = Menu::all();
        foreach ($menus as $menu) {
            $menu->date = Carbon::parse($menu->date)->addDays($delta)->format('y-m-d');
            $menu->save();
        }
    }

    public function resetStocks()
    {
        Menu::query()->update(['sold' => false]);
    }
}
