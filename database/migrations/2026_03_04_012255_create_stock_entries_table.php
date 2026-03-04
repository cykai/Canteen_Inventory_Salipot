public function up(): void
{
    Schema::create('stock_entries', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
        $table->integer('quantity');
        $table->decimal('unit_price', 10, 2)->nullable();
        $table->timestamps();
    });
}