<?php

namespace App\Controllers;

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
        return $this->c->get('view')->render($response, 'weekly/index.twig', [
            'appName' => $this->c->get('settings')['app']['name'],
        ]);
    }
}
