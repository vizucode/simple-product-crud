<div class="min-h-screen bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between py-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Products</h1>
                <p class="mt-2 text-gray-500">Manage your product inventory</p>
            </div>
            @if ($products->isNotEmpty())
                <button
                    wire:click="create"
                    class="rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700 transition-colors shadow-sm"
                >
                    + Add Product
                </button>
            @endif
        </div>

        @if ($products->isEmpty())
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center py-24">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No Products</h3>
                    <p class="text-base text-gray-500 mb-6">Get started by creating your first product.</p>
                    <button
                        wire:click="create"
                        class="rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700 transition-colors shadow-sm"
                    >
                        + Create Product
                    </button>
                </div>
            </div>
        @else
            <x-card-wrapper>
                @foreach($products as $product)
                    <x-card>
                        <div class="relative overflow-hidden bg-gray-100 h-48 cursor-pointer group" wire:click="show({{ $product->id }})">
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                        </div>

                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 line-clamp-2">{{ $product->name }}</h3>
                            <p class="mt-2 text-lg font-bold text-blue-600">Rp {{ number_format($product->price) }}</p>
                            <p class="mt-2 text-sm text-gray-500 line-clamp-2">{{ $product->description }}</p>

                            <div class="mt-4 flex gap-2">
                                <button
                                    wire:click="edit({{ $product->id }})"
                                    class="flex-1 rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors"
                                >
                                    Edit
                                </button>
                                <button
                                    @click="$dispatch('confirm-delete', { product_id: {{ $product->id }} })"
                                    class="flex-1 rounded-lg bg-red-600 px-3 py-2 text-sm font-medium text-white hover:bg-red-700 transition-colors"
                                >
                                    Delete
                                </button>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </x-card-wrapper>

            <div class="mt-12">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    @if ($showModal)
        <x-modal 
            :mode="$mode" 
            :name="$name" 
            :imageurl="$image_url" 
            :image="$image" 
            :price="$price"
            :qty="$qty"
            :description="$description"
            wire:key="product-modal">
        </x-modal>
    @endif

    <x-confirm-delete />
</div>
