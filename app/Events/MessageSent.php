<?php

namespace App\Events;

use App\Models\BuyerChat;
use App\Models\FarmerChat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Support\Facades\Auth;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * Create a new event instance.
     */

    private $userSlug;
    
    public function __construct(public $friendSlug, public $friendRole, public $idMessage, public $role)
    {
        $this->userSlug = Auth::guard($this->role)->user()->slug;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("chat.{$this->friendRole}.{$this->friendSlug}"),
        ];
    }
    public function broadcastWith(){
        return [
            'message' => $this->idMessage,
            'sender' => $this->userSlug
        ];
    }
}
