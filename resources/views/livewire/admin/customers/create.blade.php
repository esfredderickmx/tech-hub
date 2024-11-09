<?php

use App\Models\Customer;
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component {
  use Toast;

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

  public function storeCustomer(): void {
    $this->validate();

    Customer::create($this->all());

    $this->success('Cliente registrado correctamente.', icon: 'tabler.circle-check');
    $this->closeModal();

    $this->js('$wire.$parent.$refresh()');
  }

  public function closeModal(): void {
    $this->reset();
    $this->resetErrorBag();
  }
}; ?>

<div @open-create.window="$wire.is_open = true">
  <x-drawer id="create-drawer" title="Agregar cliente" with-close-button wire:model="is_open" class="w-11/12 md:w-2/3 lg:w-1/2 xl:w-1/3">
    <x-form wire:submit="storeCustomer()">
      <x-input label="Nombre(s)" placeholder="Nombre(s)" icon="tabler.letter-case-upper" wire:model="first_name"/>
      <x-input label="Apellido(s)" placeholder="Apellido(s)" icon="tabler.letter-case" wire:model="last_name"/>
      <x-input label="Número de teléfono" placeholder="Número de teléfono" icon="tabler.phone" maxlength="10" wire:model="phone_number"/>

      <x-slot:actions>
        <x-button label="Agregar" type="submit" icon="tabler.pencil-plus" spinner="storeCustomer" class="btn-primary"/>
        <x-button label="Cancelar" wire:click="closeModal()"/>
      </x-slot:actions>
    </x-form>
  </x-drawer>
</div>
