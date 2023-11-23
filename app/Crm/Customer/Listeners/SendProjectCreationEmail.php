<?php

namespace Crm\Customer\Listeners;

use Crm\Customer\services\CustomerService;
use Crm\Project\Events\ProjectCreation;

class SendProjectCreationEmail
{
    private CustomerService $customerService;
    /**
     * Create the event listener.
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Handle the event.
     */
    public function handle(ProjectCreation $event): void
    {
        $project = $event->getProject();
        $customer = $this->customerService->show($project->customer_id);
    }
}
