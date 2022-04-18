<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class SubscriptionPet extends Model{
        protected $table = 'subscription_pet';

        protected $fillable = [
            'id',
            'subscription_id',
            'pet_id'
        ];

        public static function deleteFromPet($params){
            SubscriptionPet::where([
                ['subscription_id', $params['subscription_id']],
                ['pet_id', $params['pet_id']]
            ])
            ->delete();

            return 'ok';
        }

    }
?>