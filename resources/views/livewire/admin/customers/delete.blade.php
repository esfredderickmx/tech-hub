<?php

use App\Models\Customer;
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component {
  use Toast;

  public Customer $customer;

  public bool $is_open = false;

  public function destroyCustomer(): void {
    $this->customer->delete();

    $this->info('Cliente eliminado correctamente.', icon: 'tabler.info-circle');
    $this->is_open = false;

    $this->js('$wire.$parent.$refresh()');
  }
}; ?>

<div @open-delete-{{ $customer->id }}.window="$wire.is_open = true">
  <x-modal wire:model="is_open" title="Eliminar cliente">
    <div class="font-medium text-lg text-left">¿Está seguro de que desea eliminar al cliente {{ str($customer->first_name)->append(' ', $customer->last_name) }}</div>

    <x-slot:actions>
      <x-button label="Eliminar" icon="tabler.trash" spinner="destroyCustomer" wire:click="destroyCustomer()" class="btn-error"/>
      <x-button label="Cancelar" @click="$wire.is_open = false"/>
    </x-slot:actions>
  </x-modal>
</div>
