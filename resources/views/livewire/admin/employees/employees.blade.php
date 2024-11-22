<?php

use App\Enums\EmployeePosition;
use App\Models\Employee;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
  use WithPagination;

  public array $headers = [
    ['key' => 'first_name', 'label' => 'Nombre(s)'],
    ['key' => 'last_name', 'label' => 'Apellido(s)'],
    ['key' => 'phone_number', 'label' => 'Teléfono', 'sortable' => false],
    ['key' => 'position', 'label' => 'Puesto', 'sortable' => false],
  ];
  public array $sortBy = ['column' => 'first_name', 'direction' => 'asc'];

  public function with(): array {
    return [
      'employees' => Employee::orderBy(...array_values($this->sortBy))->paginate(8),
    ];
  }
}; ?>

<div>
  <x-card shadow>
    <x-button label="Agregar empleado" icon="tabler.table-plus" class="btn-primary btn-block mb-4" @click="$dispatch('open-create')"/>

    <x-table :headers="$headers" :rows="$employees" :sort-by="$sortBy" striped with-pagination>
      @scope('cell_position', $employee)
      <x-badge :value="$employee->position->getLabel()" :class="$employee->position->getColor()"/>
      @endscope

      @scope('actions', $employee)
      <div class="flex gap-2">
        <x-button icon="tabler.pencil" class="btn-success btn-sm" @click="$dispatch('open-edit-{{ $employee->id }}')"/>
        <x-button icon="tabler.trash" class="btn-error btn-sm" @click="$dispatch('open-delete-{{ $employee->id }}')"/>
      </div>

      <livewire:admin.employees.edit :$employee :key="'edit-employee-'.uniqid()"/>
      <livewire:admin.employees.delete :$employee :key="'delete-employee-'.uniqid()"/>
      @endscope
    </x-table>
  </x-card>

  <livewire:admin.employees.create/>
</div>
