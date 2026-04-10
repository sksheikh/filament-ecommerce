<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Models\Order;
use App\Enums\OrderStatus;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use App\Filament\Resources\Orders\OrderResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class OrderDetail extends Page
{
    use InteractsWithRecord;

    protected static string $resource = OrderResource::class;

    protected string $view = 'filament.resources.orders.pages.view-order';

    public function mount($record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->record->load(['customer', 'items.product', 'address']);
    }

    public function getHeading(): string
    {
        return "Order Details: " . $this->record->order_number;
    }

    protected function getHeaderActions(): array
    {
        $order = $this->record;
        
        $actions = [
            EditAction::make(),
        ];

        // Add dynamic status transition actions
        $allowedTransitions = OrderStatus::getTransitions()[$order->status->value] ?? [];
        
        foreach ($allowedTransitions as $nextStatusValue) {
            $status = OrderStatus::from($nextStatusValue);
            
            $actions[] = Action::make('moveTo' . ucfirst($nextStatusValue))
                ->label('Mark as ' . $status->getLabel())
                ->color($status->getColor())
                ->icon($status->getIcon())
                ->requiresConfirmation()
                ->action(function () use ($nextStatusValue, $status) {
                    $this->record->update([
                        'status' => $nextStatusValue
                    ]);

                    Notification::make()
                        ->title('Order status updated')
                        ->body("The order is now marked as **{$status->getLabel()}**.")
                        ->success()
                        ->send();
                        
                    $this->record->refresh();
                });
        }

        return $actions;
    }
}
