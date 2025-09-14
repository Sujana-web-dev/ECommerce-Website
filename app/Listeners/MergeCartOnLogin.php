<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Services\CartService;

class MergeCartOnLogin
{
    protected $cartService;

    /**
     * Create the event listener.
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        // Merge session cart to user's database cart
        $this->cartService->mergeSessionToUser($event->user);
    }
}
