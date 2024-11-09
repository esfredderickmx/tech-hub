<?php

use App\Models\Product;
use App\Models\Provider;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;

new class extends Component {
  use WithFileUploads;
  use Toast;

  public bool $is_open = false;

  public string|null $name = null;
  public string|null $description = null;
  public float|null $price = null;
  public int|null $stock = null;
  public $image = null;
  public int|null $provider = null;

  public function rules(): array {
    return [
      'name' => 'required|string|max:100',
      'description' => 'required|string',
      'price' => 'required|numeric|max_digits:10',
      'stock' => 'required|integer',
      'image' => 'required|image|max:1024',
      'provider' => 'required|int|exists:providers,id',
    ];
  }

  public function storeProduct(): void {
    $this->validate();

    if ($this->image) {
      $this->image = "/{$this->image->store('products', 'public')}";
    }

    $provider = Provider::find($this->provider);
    $provider->products()->create($this->all());

    $this->success('Producto registrado correctamente.', icon: 'tabler.circle-check');
    $this->closeModal();

    $this->js('$wire.$parent.$refresh()');
  }

  public function closeModal(): void {
    $this->reset();
    $this->resetErrorBag();
  }
}; ?>

<div @open-create.window="$wire.is_open = true">
  <x-drawer id="create-drawer" title="Agregar producto" with-close-button wire:model="is_open" class="w-11/12 md:w-2/3 lg:w-1/2 xl:w-1/3">
    <x-form wire:submit="storeProduct()">
      <x-input label="Nombre" placeholder="Nombre" icon="tabler.letter-case-upper" wire:model="name"/>
      <x-input label="Descripción" placeholder="Descripción" icon="tabler.letter-case" wire:model="description"/>
      <x-input label="Precio" placeholder="Precio" prefix="MXN" icon="tabler.coin" money wire:model="price"/>
      <x-input label="Inventario" placeholder="Inventario" icon="tabler.stack-2" wire:model="stock"/>
      <x-file label="Imagen" accept="image/png, image/jpeg" wire:model="image">
        <img src="{{ $image ?? '/png/no-product-image.png' }}" class="h-40 rounded-lg" alt="Imagen del producto"/>
      </x-file>
      <x-select label="Proveedor" placeholder="Proveedor" icon="tabler.tie" :options="Provider::all()" wire:model="provider"/>

      <x-slot:actions>
        <x-button label="Agregar" type="submit" icon="tabler.pencil-plus" spinner="storeProduct" class="btn-primary"/>
        <x-button label="Cancelar" wire:click="closeModal()"/>
      </x-slot:actions>
    </x-form>
  </x-drawer>
</div>
