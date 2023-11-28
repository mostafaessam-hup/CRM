<?php

namespace Crm\Customer\services;

use Crm\Customer\services\Export\ExportInterface;
use Crm\Customer\Repositories\CustomerRepository;

class CustomerExportService
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function export( ExportInterface $exporter)
    {
        $customers = $this->customerRepository->all();
        $exporter->export($customers->toArray());
    }
}
