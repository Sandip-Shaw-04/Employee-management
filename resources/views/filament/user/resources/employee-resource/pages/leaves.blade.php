<x-filament-panels::page>
    <div>
        <form wire:submit.prevent="submit">
            {{ $this->form }}
            <br>
            <x-filament::button type="submit" style="float: right">
                Submit
            </x-filament::button>
        </form>
       
    </div>
    <div>
        {{ $this->table }}
    </div>
    
</x-filament-panels::page>