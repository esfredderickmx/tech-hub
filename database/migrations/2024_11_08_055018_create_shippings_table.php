<?php

use App\Enums\ShippingStatus;
use App\Models\Employee;
use App\Models\Purchase;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('shippings', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Purchase::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
      $table->foreignIdFor(Employee::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
      $table->string('address');
      $table->dateTime('dispatch_date')->nullable()->default(null);
      $table->dateTime('delivery_date')->nullable()->default(null);
      $table->decimal('cost', 10);
      $table->enum('status', ShippingStatus::valuesToArray())->default(ShippingStatus::PENDING);
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('shippings');
  }
};
