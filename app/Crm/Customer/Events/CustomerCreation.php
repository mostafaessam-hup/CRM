<?php

namespace Crm\Customer\Events;

use Crm\Customer\Models\Customer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomerCreation
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    private Customer $customer; 

    /**
     * Create a new event instance.
     */
    public function __construct(Customer $customer)
    {
        $this->customer=$customer;
    }

    public function getCustomer ():Customer
    {
        return $this->customer;
    }

    public function setCustomer (Customer $customer):void   
    {
        $this->customer=$customer;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
