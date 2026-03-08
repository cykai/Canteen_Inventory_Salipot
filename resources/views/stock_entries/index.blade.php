<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Stock Entries') }}
            </h2>
            <a href="{{ route('stock-entries.create') }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition">
                + New Entry
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="flex items-center gap-3 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-lg text-green-800 dark:text-green-300 text-sm">
                    <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Filters --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-5">
                <form method="GET" action="{{ route('stock-entries.index') }}" class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-[160px]">
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Filter by Product</label>
                        <select name="product_id"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Products</option>
                            @foreach ($allProducts as $product)
                                <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1 min-w-[160px]">
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Filter by Supplier</label>
                        <select name="supplier_id"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Suppliers</option>
                            @foreach ($allSuppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition">
                            Apply
                        </button>
                        @if (request('product_id') || request('supplier_id'))
                            <a href="{{ route('stock-entries.index') }}"
                               class="px-4 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Table --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                @if ($stockEntries->isEmpty())
                    <div class="flex flex-col items-center justify-center py-16 text-gray-400 dark:text-gray-500">
                        <svg class="w-12 h-12 mb-3 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4"/>
                        </svg>
                        <p class="text-sm font-medium">No stock entries found</p>
                        <a href="{{ route('stock-entries.create') }}" class="mt-3 text-indigo-600 hover:underline text-sm">Record your first entry →</a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                <tr>
                                    <th class="px-5 py-3">Delivery Ref</th>
                                    <th class="px-5 py-3">Product</th>
                                    <th class="px-5 py-3">Supplier</th>
                                    <th class="px-5 py-3 text-right">Quantity</th>
                                    <th class="px-5 py-3">Date</th>
                                    <th class="px-5 py-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach ($stockEntries as $entry)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                                        <td class="px-5 py-3.5 font-mono text-gray-700 dark:text-gray-300">
                                            {{ $entry->delivery_reference }}
                                        </td>
                                        <td class="px-5 py-3.5 text-gray-800 dark:text-gray-200 font-medium">
                                            {{ $entry->product->name ?? '—' }}
                                        </td>
                                        <td class="px-5 py-3.5 text-gray-600 dark:text-gray-400">
                                            {{ $entry->supplier->name ?? '—' }}
                                        </td>
                                        <td class="px-5 py-3.5 text-right">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400">
                                                +{{ number_format($entry->quantity) }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3.5 text-gray-500 dark:text-gray-400 text-xs">
                                            {{ $entry->created_at->format('d M Y, H:i') }}
                                        </td>
                                        <td class="px-5 py-3.5 text-right">
                                            <form action="{{ route('stock-entries.destroy', $entry) }}" method="POST"
                                                  onsubmit="return confirm('Delete this stock entry? This will reduce the product stock by {{ $entry->quantity }} units.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 text-xs font-medium transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($stockEntries->hasPages())
                        <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-700">
                            {{ $stockEntries->appends(request()->query())->links() }}
                        </div>
                    @endif
                @endif
            </div>

            {{-- Summary --}}
            <p class="text-xs text-gray-400 dark:text-gray-500 text-right">
                Showing {{ $stockEntries->firstItem() ?? 0 }}–{{ $stockEntries->lastItem() ?? 0 }}
                of {{ $stockEntries->total() }} entries
            </p>

        </div>
    </div>
</x-app-layout>