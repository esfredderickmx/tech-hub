<?php

use Livewire\Volt\Component;

new class extends Component {
  //
}; ?>

<div>
  <x-alert title="Usa la barra de navegación lateral o los enlaces debajo para moverte entre pestañas." icon="tabler.info-circle" class="alert-info mb-6"/>

  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
    <a href="{{ route('admin.customers') }}" wire:navigate>
      <x-card class="items-center">
        <x-tabler-user-dollar class="h-20 w-20"/>
        <div class="text-xl font-medium">Clientes</div>
      </x-card>
    </a>
    <a href="{{ route('admin.employees') }}" wire:navigate>
      <x-card class="items-center">
        <x-tabler-tie class="h-20 w-20"/>
        <div class="text-xl font-medium">Empleados</div>
      </x-card>
    </a>
    <a href="{{ route('admin.providers') }}" wire:navigate>
      <x-card class="items-center">
        <x-tabler-truck class="h-20 w-20"/>
        <div class="text-xl font-medium">Proveedores</div>
      </x-card>
    </a>
    <a href="{{ route('admin.products') }}" wire:navigate>
      <x-card class="items-center">
        <x-tabler-packages class="h-20 w-20"/>
        <div class="text-xl font-medium">Productos</div>
      </x-card>
    </a>
  </div>
</div>
