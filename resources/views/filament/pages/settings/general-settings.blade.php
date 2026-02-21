<x-filament-panels::page>
    <form wire:submit="save" class="space-y-6">
        {{ $this->form }}

        <div style="margin-top: 2rem;">
            <x-filament::actions
                :actions="$this->getFormActions()"
            />
        </div>
    </form>

    <x-filament-actions::modals />
</x-filament-panels::page>
