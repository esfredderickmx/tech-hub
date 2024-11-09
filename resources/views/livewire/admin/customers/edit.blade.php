<?php

use App\Models\Customer;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component {
  use Toast;

  public Customer $customer;

  public bool $is_open = false;

  public string|null $first_name = null;
  public string|null $last_name = null;
  public string|null $phone_number = null;

  public function rules(): array {
    return [
      'first_name' => 'required|string|max:75',
      'last_name' => 'required|string|max:75',
      'phone_number' => 'nullable|string|numeric|max_digits:10',
    ];
  }

  public function mount(): void {
    $this->fill($this->customer);
  }

  public function updateCustomer(): void {
    $this->validate();

    $this->customer->update($this->all());

    $this->success('Cliente actualizado correctamente.', icon: 'tabler.circle-check');
    $this->closeModal();

    $this->js('$wire.$parent.$refresh()');
  }

  public function closeModal(): void {
    $this->mount();

    $this->reset('is_open');
    $this->resetErrorBag();
  }
}; ?>

<div @open-edit-{{ $customer->id }}.window="$wire.is_open = true">
  <x-drawer id="edit-drawer-{{ $customer->id }}" title="Editar cliente" with-close-button wire:model="is_open" class="w-11/12 md:w-2/3 lg:w-1/2 xl:w-1/3">
    <x-form wire:submit="updateCustomer()">
      <x-input label="Nombre(s)" placeholder="Nombre(s)" icon="tabler.letter-case-upper" wire:model="first_name"/>
      <x-input label="Apellido(s)" placeholder="Apellido(s)" icon="tabler.letter-case" wire:model="last_name"/>
      <x-input label="Número de teléfono" placeholder="Número de teléfono" icon="tabler.phone" maxlength="10" wire:model="phone_number"/>

      <x-slot:actions>
        <x-button label="Guardar" type="submit" icon="tabler.device-floppy" spinner="updateCustomer" class="btn-success"/>
        <x-button label="Cancelar" wire:click="closeModal()"/>
      </x-slot:actions>
    </x-form>
  </x-drawer>
</div>
