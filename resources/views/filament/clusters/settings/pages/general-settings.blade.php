<x-filament-panels::page>
    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        <x-filament-actions::actions :actions="$this->getHeaderActions()" class="mt-6 filament-page-actions" />
    </x-filament-panels::form>
</x-filament-panels::page>
