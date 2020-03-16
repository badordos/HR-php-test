<?php

namespace App\Notifications;

use App\Events\OrderStatusIsConfirmed;
use App\Factories\RepositoryFactory;
use App\Interfaces\IOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderStatusConfirmedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;

    public $ordersRepo;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(IOrder $order)
    {
        $this->ordersRepo = RepositoryFactory::makeOrdersRepo();
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Заказ №' . $this->order->getId() . ' завершен');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'Заказ ' . $this->order->getId() . ' завершен.',
            'partner' => $this->order->partner->getEmail(),
            'vendors' => $this->order->getVendorsEmailToArray(),
            'items' => $this->order->getProductsToArray(),
            'sum' => $this->order->getSum(),
        ];
    }
}
