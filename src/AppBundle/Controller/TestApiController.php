<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TestApiController extends Controller
{
    /**
     * @Route("/test/advert/show/{advertId}", name="showAdvert")
     * @param Request $request
     * @param $advertId
     */
    public function indexAction(Request $request, $advertId)
    {
        dump('haha');
        die;
    }
}
