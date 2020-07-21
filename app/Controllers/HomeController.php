<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends Controller
{
    /**
     * Render the home page.
     *
     * @param [type] $args
     */
    public function index(Request $request, Response $response, $args)
    {
        return $this->c->get('view')->render($response, 'home/index.twig', [
            'appName' => $this->c->get('settings')['app']['name'],
        ]);
    }
}
