<?php

use App\Models\Employee;
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component {
  use Toast;

  public Employee $employee;

  public bool $is_open = false;

  public function destroyEmployee(): void {
    $this->employee->delete();

    $this->info('Empleado eliminado correctamente.', icon: 'tabler.info-circle');
    $this->is_open = false;

    $this->js('$wire.$parent.$refresh()');
  }
}; ?>

<div @open-delete-{{ $employee->id }}.window="$wire.is_open = true">
  <x-modal wire:model="is_open" title="Eliminar empleado">
    <div class="font-medium text-lg text-left">¿Está seguro de que desea eliminar al empleado {{ str($employee->first_name)->append(' ', $employee->last_name) }}</div>

    <x-slot:actions>
      <x-button label="Eliminar" icon="tabler.trash" spinner="destroyEmployee" wire:click="destroyEmployee()" class="btn-error"/>
      <x-button label="Cancelar" @click="$wire.is_open = false"/>
    </x-slot:actions>
  </x-modal>
</div>
