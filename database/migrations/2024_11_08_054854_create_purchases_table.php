<?php

use App\Enums\PurchaseType;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('purchases', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Customer::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
      $table->foreignIdFor(Employee::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
      $table->decimal('total', 10);
      $table->enum('type', PurchaseType::valuesToArray())->default(PurchaseType::ONSITE);
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('purchases');
  }
};
