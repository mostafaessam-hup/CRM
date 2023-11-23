<?php

namespace Crm\Project\Events;

use Crm\Customer\Models\Customer;
use Crm\Project\Models\Project;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProjectCreation
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    private Project $project; 

    /**
     * Create a new event instance.
     */
    public function __construct(Project $project)
    {
        $this->setProject($project);
    }

    public function getProject ():Project
    {
        return $this->project;
    }

    public function setProject (project $project):void   
    {
        $this->project=$project;
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
