<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Subscriptions extends Model{
        protected $table = 'subscriptions';
        
        protected $fillable = [
            'id',
            'customer_id',
            'base_price',
            'total_price',
            'next_order_date'
        ];

        public static function getByCustomer($customer_id){
            $subscriptions_customers = Subscriptions::where('customer_id', $customer_id)->get();

            return $subscriptions_customers;
        }
    }
?>