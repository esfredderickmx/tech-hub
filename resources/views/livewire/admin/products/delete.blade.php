<?php

use App\Models\Product;
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component {
  use Toast;

  public Product $product;

  public bool $is_open = false;

  public function destroyProduct(): void {
    if (Storage::disk('public')->exists($this->product->image)) {
      Storage::disk('public')->delete($this->product->image);
    }

    $this->product->delete();

    $this->info('Proveedor eliminado correctamente.', icon: 'tabler.info-circle');
    $this->is_open = false;

    $this->js('$wire.$parent.$refresh()');
  }
}; ?>

<div @open-delete-{{ $product->id }}.window="$wire.is_open = true">
  <x-modal wire:model="is_open" title="Eliminar producto">
    <div class="font-medium text-lg text-left">¿Está seguro de que desea eliminar el producto {{ $product->name }}</div>

    <x-slot:actions>
      <x-button label="Eliminar" icon="tabler.trash" spinner="destroyProduct" wire:click="destroyProduct()" class="btn-error"/>
      <x-button label="Cancelar" @click="$wire.is_open = false"/>
    </x-slot:actions>
  </x-modal>
</div>
