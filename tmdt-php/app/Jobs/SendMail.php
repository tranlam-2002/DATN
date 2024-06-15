<?php

namespace App\Jobs;

use App\Mail\ContactMail;
use App\Mail\OrderShipped;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;


class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email;
    protected $customer;
    protected $carts;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($customer, $carts)
    {
        $this->customer = $customer;
        $this->carts = $carts;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      // Gửi email thông tin đơn hàng cho khách hàng
        Mail::to($this->customer->email)->send(new OrderShipped($this->customer, $this->carts));
    }
}