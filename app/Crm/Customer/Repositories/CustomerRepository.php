<?php

namespace Crm\Customer\Repositories;

use Crm\Customer\Models\Customer;
use Crm\Base\Repositories\Repository;

class  CustomerRepository extends Repository
{

    public function __Construct(Customer $customer)
    {
        $this->setModel($customer);
    }

    public function customerAnalytics (): array 
    {
        return [];
    }
}
