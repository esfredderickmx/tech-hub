<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;

new class extends Component {
  use Toast;

  public function mount(): void {
    if (Session::has('toast_message')) {
      $toast = Session::pull('toast_message');
      $icon = match ($toast['type']) {
        'success' => 'tabler.circle-check',
        'info' => 'tabler.info-circle',
        'warning' => 'tabler.alert-circle',
        'error' => 'tabler.circle-x',
      };

      $this->toast(type: $toast['type'], title: $toast['message'], position: 'toast-bottom toast-end', icon: $icon, css: "alert-{$toast['type']}");
    }
  }
}; ?>

<div class="hidden"></div>
