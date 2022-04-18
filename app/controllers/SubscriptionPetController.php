<?php
namespace App\Controllers;
use App\Models\SubscriptionPet;
use Slim\Http\Request;
use Slim\Http\Response;

use Psr\Http\Message\ResponseInterface;

class SubscriptionPetController
{
    public function index()
    {
        $subscriptions_pet = SubscriptionPet::all();
        return (new Response)->withJson(compact('subscriptions_pet'));
    }

    public function add(Request $request, Response $response): ResponseInterface
    {
        $params = $request->getParams();

        try {

            SubscriptionPet::create($params);

            return $response->withJson(['success' => true]);

        } catch (\Exception $e) {
            return $response->withJson(['error' => true]);
        }
    }

    public function delete(Request $request, Response $response)
    {
        $params = $request->getParams();

        try {

            SubscriptionPet::deleteFromPet($params);

            return $response->withJson(['success' => true]);

        } catch (\Exception $e) {
            return $response->withJson(['error' => true]);
        }
    }
}