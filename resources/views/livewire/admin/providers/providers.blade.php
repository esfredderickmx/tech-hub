<?php

use App\Models\Provider;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
  use WithPagination;

  public array $headers = [
    ['key' => 'name', 'label' => 'Nombre'],
    ['key' => 'description', 'label' => 'Dirección', 'sortable' => false],
    ['key' => 'email', 'label' => 'Correo electrónico', 'sortable' => false],
    ['key' => 'phone_number', 'label' => 'Teléfono', 'sortable' => false],
    ['key' => 'type', 'label' => 'Tipo', 'sortable' => false],
  ];
  public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

  public function with(): array {
    return [
      'providers' => Provider::orderBy(...array_values($this->sortBy))->paginate(8),
    ];
  }
}; ?>

<div>
  <x-card shadow>
    <x-button label="Agregar proveedor" icon="tabler.table-plus" class="btn-primary btn-block mb-4" @click="$dispatch('open-create')"/>

    <x-table :headers="$headers" :rows="$providers" :sort-by="$sortBy" striped with-pagination>
      @scope('cell_type', $provider)
      <x-badge :value="$provider->type->getLabel()" :class="$provider->type->getColor()"/>
      @endscope

      @scope('actions', $provider)
      <div class="flex gap-2">
        <x-button icon="tabler.pencil" class="btn-success btn-sm" @click="$dispatch('open-edit-{{ $provider->id }}')"/>
        <x-button icon="tabler.trash" class="btn-error btn-sm" @click="$dispatch('open-delete-{{ $provider->id }}')"/>
      </div>

      <livewire:admin.providers.edit :$provider :key="'edit-provider-'.uniqid()"/>
      <livewire:admin.providers.delete :$provider :key="'delete-provider-'.uniqid()"/>
      @endscope
    </x-table>
  </x-card>

  <livewire:admin.providers.create/>
</div>
