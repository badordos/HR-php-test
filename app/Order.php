<?php

namespace App;

use App\Interfaces\IOrder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model implements IOrder
{
    use Notifiable;

    public function getId()
    {
        return $this->id;
    }

    public function getStatus()
    {
        return self::STATUSES[$this->status];
    }

    public function getClientEmail()
    {
        return $this->client_email;
    }

    public function getPartnerId()
    {
        return $this->partner_id;
    }

    public function setClientEmail($email)
    {
        $this->client_email = $email;
    }

    public function setPartnerId($id)
    {
        $this->partner_id = $id;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getDeliveryTime()
    {
        return Carbon::parse($this->delivery_dt)->format('h:i d.m.Y');
    }

    /**
     * Стоимость заказа
     * @return float|int
     */
    public function getSum()
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->pivot->price * $product->pivot->quantity;
        }
        return $total;
    }

    /**
     * Возвращает все продукты заказа в виде асс.массива
     * @return array
     */
    public function getProductsToArray(){
        $items = [];
        foreach($this->products as $product){
            $items[$product->getId()]['name'] = $product->getName();
            $items[$product->getId()]['quantity'] = $product->pivot->quantity;
        }

        return $items;
    }

    /**
     * Возвращает массив всех email вендоров заказа
     * @return array
     */
    public function getVendorsEmailToArray(){

        $emails = [];
        foreach($this->products as $product){
            $vendor = $product->vendor;
            $emails[$vendor->getId()] = $vendor->getEmail();
        }
        return $emails;
    }

    //RELATIONS

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id')
            ->withPivot(['quantity', 'price'])->withTimestamps();
    }

}
