<?php

namespace App\Controllers;

use App\Controllers\Controller;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class WeeklyController extends Controller
{
    /**
     * Render the weekly page
     *
     * @param Request $request
     * @param Response $response
     * @param [type] $args
     * @return void
     */
    public function index(Request $request, Response $response, $args)
    {
        return $this->c->get('view')->render($response, 'weekly/index.twig', [
            'appName' => $this->c->get('settings')['app']['name'],
        ]);
    }
}
