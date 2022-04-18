<?php
namespace App\Controllers;
use App\Models\Subscriptions;
use Slim\Http\Request;
use Slim\Http\Response;

use Psr\Http\Message\ResponseInterface;

class SubscriptionController
{
    public function index()
    {
        $subscriptions = Subscriptions::all();
        return (new Response)->withJson(compact('subscriptions'));
    }

    public function searchByCustomer(Request $request){
        $customer_id = $request->getParam('customer_id');
        
        $subscriptions = Subscriptions::getByCustomer($customer_id);

        return (new Response)->withJson($subscriptions);
    }

    public function updateNextOrder(Request $request, Response $response){
        $params = $request->getParams();

        try {
            $update = Subscriptions::find($params['subscription_id']);
            $update->next_order_date = $params['next_order_date'];
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

            Subscriptions::create($params);

            return $response->withJson(['success' => true]);

        } catch (\Exception $e) {
            return $response->withJson(['error' => true]);
        }
    }
}