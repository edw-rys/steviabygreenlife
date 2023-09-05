<?php

namespace App\Mail\Shop;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyOrderMail extends Mailable
{
    use Queueable, SerializesModels;
    private $cart;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cart)
    {
        $this->cart = $cart;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.shop.confirm-buy')
            ->with('cart',$this->cart);
    }
}
