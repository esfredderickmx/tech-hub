<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ isset($title) ? $title.' | '.config('app.name') : config('app.name') }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/robsontenorio/mary@0.44.2/libs/currency/currency.js"></script>
</head>
<body class="min-h-screen font-sans antialiased bg-base-200">
{{-- The navbar with `sticky` and `full-width` --}}
<x-nav id="main-nav" sticky full-width class="bg-primary text-primary-content">

  <x-slot:brand>
    {{-- Drawer toggle for "main-drawer" --}}
    <label for="main-drawer" class="lg:hidden mr-3 btn btn-circle btn-ghost">
      <x-icon name="tabler.menu-2"/>
    </label>

    {{-- User Info --}}
    @php
      $user_info = auth()->user()->employee ?? auth()->user()->customer;
    @endphp
    <x-avatar
      :placeholder="str($user_info->first_name)->substr(0, 1)->append(str($user_info->last_name)->substr(0, 1))->upper()"
      :title="str($user_info->first_name)->append(' ', $user_info->last_name)"
      :subtitle="str('@')->append(auth()->user()->username)" class="!w-10"/>
  </x-slot:brand>

  {{-- Right side actions --}}
  <x-slot:actions>
    <x-button label="Cerrar sesión" icon="tabler.door-exit" :link="route('auth.sign-out')" class="btn-ghost" responsive/>
    <x-theme-toggle class="btn btn-circle btn-ghost"/>
  </x-slot:actions>
</x-nav>

{{-- The main content with `full-width` --}}
<x-main with-nav full-width>

  {{-- This is a sidebar that works also as a drawer on small screens --}}
  {{-- Notice the `main-drawer` reference here --}}
  <x-slot:sidebar drawer="main-drawer" class="bg-base-100">
    {{-- Activates the menu item when a route matches the `link` property --}}
    <x-menu activate-by-route>
      <x-menu-item title="Inicio" icon="tabler.home-f" :link="route('home')"/>
      <x-menu-sub title="Administración" icon="tabler.layout-dashboard-f" open>
        <x-menu-item title="Clientes" icon="tabler.user-dollar" :link="route('admin.customers')"/>
        <x-menu-item title="Empleados" icon="tabler.tie" :link="route('admin.employees')"/>
        <x-menu-item title="Proveedores" icon="tabler.truck" :link="route('admin.providers')"/>
        <x-menu-item title="Productos" icon="tabler.packages" :link="route('admin.products')"/>
        {{--<x-menu-item title="Compras" icon="tabler.report-money" link="###"/>
        <x-menu-item title="Pedidos" icon="tabler.package-export" link="###"/>--}}
      </x-menu-sub>
      <x-menu-item title="Comprar" icon="tabler.shopping-cart-f" link="###"/>
      {{--<x-menu-item title="Mis pedidos" icon="tabler.basket-f" link="###"/>--}}
    </x-menu>
  </x-slot:sidebar>

  {{-- The `$slot` goes here --}}
  <x-slot:content>
    {{ $slot }}
  </x-slot:content>
</x-main>

{{--  TOAST area --}}
<x-toast/>
@livewire('components.session-toaster')
</body>
</html>
