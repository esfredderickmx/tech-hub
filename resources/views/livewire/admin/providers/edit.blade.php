<?php

use App\Enums\ProviderType;
use App\Models\Provider;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component {
  use Toast;

  public Provider $provider;

  public bool $is_open = false;

  public string|null $name = null;
  public string|null $address = null;
  public string|null $email = null;
  public string|null $phone_number = null;
  public int|null $type = null;

  public function rules(): array {
    return [
      'name' => 'required|string|max:75',
      'address' => 'nullable|string|max:100',
      'email' => 'nullable|string|email:rfc,dns',
      'phone_number' => 'nullable|string|numeric|max_digits:10',
      'type' => [
        'required',
        'int',
        Rule::enum(ProviderType::class),
      ],
    ];
  }

  public function mount(): void {
    $this->fill($this->provider);
  }

  public function updateProvider(): void {
    $this->validate();

    $this->provider->update($this->all());

    $this->success('Proveedor actualizado correctamente.', icon: 'tabler.circle-check');
    $this->closeModal();

    $this->js('$wire.$parent.$refresh()');
  }

  public function closeModal(): void {
    $this->mount();

    $this->reset('is_open');
    $this->resetErrorBag();
  }
}; ?>

<div @open-edit-{{ $provider->id }}.window="$wire.is_open = true">
  <x-drawer id="edit-drawer-{{ $provider->id }}" title="Editar proveedor" with-close-button wire:model="is_open" class="w-11/12 md:w-2/3 lg:w-1/2 xl:w-1/3">
    <x-form wire:submit="updateProvider()()">
      <x-input label="Nombre" placeholder="Nombre" icon="tabler.letter-case-upper" wire:model="name"/>
      <x-input label="Dirección" placeholder="Dirección" icon="tabler.letter-case" wire:model="address"/>
      <x-input label="Correo electrónico" placeholder="Correo electrónico" icon="tabler.mail" wire:model="email"/>
      <x-input label="Número de teléfono" placeholder="Número de teléfono" icon="tabler.phone" maxlength="10" wire:model="phone_number"/>
      <x-select label="Tipo" placeholder="Tipo" icon="tabler.hierarchy-2" :options="ProviderType::getOptionsFormat()" wire:model="type"/>

      <x-slot:actions>
        <x-button label="Guardar" type="submit" icon="tabler.device-floppy" spinner="updateProvider" class="btn-success"/>
        <x-button label="Cancelar" wire:click="closeModal()"/>
      </x-slot:actions>
    </x-form>
  </x-drawer>
</div>
