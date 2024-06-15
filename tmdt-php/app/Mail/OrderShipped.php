<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    public $customer;
    public $carts;
   /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $carts)
    {
        $this->customer = $customer;
        $this->carts = $carts;
    }
        /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.success')
                    ->subject('Xác nhận đơn hàng của bạn');
    }
    
    
}