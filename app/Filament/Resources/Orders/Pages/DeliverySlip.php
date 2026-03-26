<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Resources\Pages\Page;
use App\Models\Order;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class DeliverySlip extends Page
{
    use InteractsWithRecord;

    protected static string $resource = OrderResource::class;

    protected string $view = 'filament.resources.orders.pages.delivery-slip';

    public function mount($record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->record->load(['customer', 'items.product', 'address']);
    }
}
