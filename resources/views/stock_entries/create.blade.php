<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('stock-entries.index') }}"
               class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Record Stock Entry') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">

                <form method="POST" action="{{ route('stock-entries.store') }}" class="space-y-5">
                    @csrf

                    {{-- Product --}}
                    <div>
                        <label for="product_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Product <span class="text-red-500">*</span>
                        </label>
                        <select id="product_id" name="product_id"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('product_id') border-red-400 @enderror">
                            <option value="">Select a product…</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                    @if(isset($product->current_stock))
                                        (Stock: {{ $product->current_stock }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Supplier --}}
                    <div>
                        <label for="supplier_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Supplier <span class="text-red-500">*</span>
                        </label>
                        <select id="supplier_id" name="supplier_id"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('supplier_id') border-red-400 @enderror">
                            <option value="">Select a supplier…</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Quantity --}}
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Quantity <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="quantity" name="quantity" min="1"
                               value="{{ old('quantity') }}"
                               placeholder="e.g. 100"
                               class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('quantity') border-red-400 @enderror">
                        @error('quantity')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Delivery Reference --}}
                    <div>
                        <label for="delivery_reference" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Delivery Reference <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="delivery_reference" name="delivery_reference"
                               value="{{ old('delivery_reference') }}"
                               placeholder="e.g. DEL-2024-00123"
                               class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('delivery_reference') border-red-400 @enderror">
                        @error('delivery_reference')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">Must be unique per delivery.</p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <a href="{{ route('stock-entries.index') }}"
                           class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition">
                            Record Entry
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>