<?php

use App\Models\Customer;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new
#[Title('Clientes')]
class extends Component {
  use WithPagination;

  public array $headers = [
    ['key' => 'first_name', 'label' => 'Nombre(s)'],
    ['key' => 'last_name', 'label' => 'Apellido(s)'],
    ['key' => 'phone_number', 'label' => 'Teléfono', 'sortable' => false],
  ];
  public array $sortBy = ['column' => 'first_name', 'direction' => 'asc'];

  public function with(): array {
    return [
      'customers' => Customer::orderBy(...array_values($this->sortBy))->paginate(8),
    ];
  }
}; ?>

<div>
  <x-card shadow>
    <x-button label="Agregar cliente" icon="tabler.table-plus" class="btn-primary btn-block mb-4" @click="$dispatch('open-create')"/>

    <x-table :headers="$headers" :rows="$customers" :sort-by="$sortBy" striped with-pagination>
      @scope('actions', $customer)
      <div class="flex gap-2">
        <x-button icon="tabler.pencil" class="btn-success btn-sm" @click="$dispatch('open-edit-{{ $customer->id }}')"/>
        <x-button icon="tabler.trash" class="btn-error btn-sm" @click="$dispatch('open-delete-{{ $customer->id }}')"/>
      </div>

      <livewire:admin.customers.edit :$customer :key="'edit-customer-'.uniqid()"/>
      <livewire:admin.customers.delete :$customer :key="'delete-customer-'.uniqid()"/>
      @endscope
    </x-table>
  </x-card>

  <livewire:admin.customers.create/>
</div>
