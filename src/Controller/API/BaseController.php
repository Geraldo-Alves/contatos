<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    public function sendResponse($data){
        $response = new Response();
        $response->setStatusCode(200);
        $response->setContent(
            json_encode(['data' => $data])
        );
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
