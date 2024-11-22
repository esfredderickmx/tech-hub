<?php

use App\Models\Product;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
  use WithPagination;

  public array $headers = [
    ['key' => 'name', 'label' => 'Nombre'],
    ['key' => 'description', 'label' => 'Descripción', 'sortable' => false],
    ['key' => 'price', 'label' => 'Precio', 'sortable' => false],
    ['key' => 'stock', 'label' => 'Inventario'],
    ['key' => 'image', 'label' => 'Imagen', 'sortable' => false],
  ];
  public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

  public function with(): array {
    return [
      'products' => Product::orderBy(...array_values($this->sortBy))->paginate(8),
    ];
  }
}; ?>

<div>
  <x-card shadow>
    <x-button label="Agregar producto" icon="tabler.table-plus" class="btn-primary btn-block mb-4" @click="$dispatch('open-create')"/>

    <x-table :headers="$headers" :rows="$products" :sort-by="$sortBy" striped with-pagination>
      @scope('cell_image', $product)
      <img src="/storage/{{ $product->image }}" class="h-24 rounded-lg" alt="Imagen del producto"/>
      @endscope
      @scope('cell_price', $product)
      <span>{{ Number::currency($product->price) }}</span>
      @endscope

      @scope('actions', $product)
      <div class="flex gap-2">
        <x-button icon="tabler.pencil" class="btn-success btn-sm" @click="$dispatch('open-edit-{{ $product->id }}')"/>
        <x-button icon="tabler.trash" class="btn-error btn-sm" @click="$dispatch('open-delete-{{ $product->id }}')"/>
      </div>

      <livewire:admin.products.edit :$product :key="'edit-product-'.uniqid()"/>
      <livewire:admin.products.delete :$product :key="'delete-product-'.uniqid()"/>
      @endscope
    </x-table>
  </x-card>

  <livewire:admin.products.create/>
</div>
