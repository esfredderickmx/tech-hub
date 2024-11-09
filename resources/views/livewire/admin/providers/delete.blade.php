<?php

use App\Models\Provider;
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component {
  use Toast;

  public Provider $provider;

  public bool $is_open = false;

  public function destroyProvider(): void {
    $this->provider->delete();

    $this->info('Proveedor eliminado correctamente.', icon: 'tabler.info-circle');
    $this->is_open = false;

    $this->js('$wire.$parent.$refresh()');
  }
}; ?>

<div @open-delete-{{ $provider->id }}.window="$wire.is_open = true">
  <x-modal wire:model="is_open" title="Eliminar proveedor">
    <div class="font-medium text-lg text-left">¿Está seguro de que desea eliminar al proveedor {{ $provider->name }}</div>

    <x-slot:actions>
      <x-button label="Eliminar" icon="tabler.trash" spinner="destroyProvider" wire:click="destroyProvider()" class="btn-error"/>
      <x-button label="Cancelar" @click="$wire.is_open = false"/>
    </x-slot:actions>
  </x-modal>
</div>
