<?php
namespace App\Controllers;
use App\Models\Customers;
use Slim\Http\Request;
use Slim\Http\Response;

use Psr\Http\Message\ResponseInterface;

class CustomerController
{
    public function index()
    {
        $customers = Customers::all();
        return (new Response)->withJson(['customers' => $customers]);
    }

    public function updateName(Request $request, Response $response)
    {

        $params = $request->getParams();

        try {
            $update = Customers::find($params['customer_id']);
            $update->name = $params['name'];
            $update->save();
 
            return $response->withJson(['success' => true]);
 
        } catch (\Exception $e) {
            return $response->withJson(['error' => true]);
        }

    }

   public function add(Request $request, Response $response): ResponseInterface
   {
        $params = $request->getParams();

        try {

           Customers::create($params);

           return $response->withJson(['success' => true]);

        } catch (\Exception $e) {
            return $response->withJson(['error' => true]);
        }
   }
}