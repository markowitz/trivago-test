<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReaderController
{
    /**
     * @Route("/")
     */
    public function home() : Response
    {
        return new Response('testing my first symfony code');
    }
}