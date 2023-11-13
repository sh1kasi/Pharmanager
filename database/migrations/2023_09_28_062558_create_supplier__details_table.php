<?php

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('supplier__details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Supplier::class);
            $table->foreignIdFor(Product::class);
            $table->integer('quantity');
            $table->decimal('price_unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier__details');
    }
};
