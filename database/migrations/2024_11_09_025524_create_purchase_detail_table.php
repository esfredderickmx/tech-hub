<?php

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('purchase_detail', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Purchase::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
      $table->foreignIdFor(Product::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
      $table->integer('quantity');
      $table->decimal('unit_price', 10);
      $table->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('purchase_detail');
  }
};
