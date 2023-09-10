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
    private $titleMail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cart, $titleMail = null)
    {
        $this->titleMail = 'Nueva compra realizada en Stevia';
        if($titleMail != null){
            $this->titleMail = $titleMail;
        }
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
            ->subject($this->titleMail. ', pedido#'.$this->cart->numero_pedido)
            ->with('cart',$this->cart);
    }
}
