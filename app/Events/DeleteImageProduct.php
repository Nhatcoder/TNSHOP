<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Log;


class DeleteImageProduct implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    /**
     * Create a new event instance.
     */
    public $image;
    public function __construct(ProductImage $image)
    {
        $this->image = $image;
    }


    public function broadcastOn()
    {
        Log::debug("Đã xóa: " . $this->image->id);
        return new Channel("delete-image-product");
    }
}
