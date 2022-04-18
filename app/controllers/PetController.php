<?php
namespace App\Controllers;
use App\Models\Pets;
use Slim\Http\Request;
use Slim\Http\Response;

use Psr\Http\Message\ResponseInterface;

class PetController
{
    public function index()
    {
        $pets = Pets::all();
        return (new Response)->withJson(compact('pets'));
    }

   public function add(Request $request, Response $response): ResponseInterface
   {
        $params = $request->getParams();

        try {

            Pets::create($params);

            return $response->withJson(['success' => true]);

        } catch (\Exception $e) {
            return $response->withJson(['error' => true]);
        }
   }
}