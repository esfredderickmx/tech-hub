<?php

use App\Models\Product;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;

new class extends Component {
  use WithFileUploads;
  use Toast;

  public Product $product;

  public bool $is_open = false;

  public string|null $name = null;
  public string|null $description = null;
  public float|null $price = null;
  public int|null $stock = null;
  public $image = null;

  public function rules(): array {
    return [
      'name' => 'required|string|max:100',
      'description' => 'required|string',
      'price' => 'required|numeric|max_digits:10',
      'stock' => 'required|integer',
      'image' => 'nullable|image|max:1024',
    ];
  }

  public function mount(): void {
    $this->fill($this->product);

    $this->image = null;
  }

  public function updateProduct(): void {
    $this->validate();

    if ($this->image) {
      if (Storage::disk('public')->exists($this->product->image)) {
        Storage::disk('public')->delete($this->product->image);
      }

      $this->image = "/{$this->image->store('products', 'public')}";

      $this->product->update($this->all());
    } else {
      $this->product->update($this->except('image'));
    }

    $this->success('Producto actualizado correctamente.', icon: 'tabler.circle-check');
    $this->closeModal();

    $this->js('$wire.$parent.$refresh()');
  }

  public function closeModal(): void {
    $this->mount();

    $this->reset('is_open');
    $this->resetErrorBag();
  }
}; ?>

<div @open-edit-{{ $product->id }}.window="$wire.is_open = true">
  <x-drawer id="edit-drawer-{{ $product->id }}" title="Editar producto" with-close-button wire:model="is_open" class="w-11/12 md:w-2/3 lg:w-1/2 xl:w-1/3">
    <x-form wire:submit="updateProduct()()">
      <x-input label="Nombre" placeholder="Nombre" icon="tabler.letter-case-upper" wire:model="name"/>
      <x-input label="Descripción" placeholder="Descripción" icon="tabler.letter-case" wire:model="description"/>
      <x-input label="Precio" placeholder="Precio" prefix="MXN" icon="tabler.coin" money wire:model="price"/>
      <x-input label="Inventario" placeholder="Inventario" icon="tabler.stack-2" wire:model="stock"/>
      <x-file label="Imagen" accept="image/png, image/jpeg" wire:model="image">
        <img src="{{ $image ?? '/png/no-product-image.png' }}" class="h-40 rounded-lg" alt="Imagen del producto"/>
      </x-file>

      <x-slot:actions>
        <x-button label="Guardar" type="submit" icon="tabler.device-floppy" spinner="updateProduct" class="btn-success"/>
        <x-button label="Cancelar" wire:click="closeModal()"/>
      </x-slot:actions>
    </x-form>
  </x-drawer>
</div>
