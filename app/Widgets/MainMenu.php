<?php

namespace App\Widgets;


use App\Models\Pages;
use Arrilot\Widgets\AbstractWidget;

class MainMenu extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $pages = Pages::all();



        return view('widgets.main_menu', [
            'config' => $this->config,
            'pages' => $pages
        ]);
    }
}
