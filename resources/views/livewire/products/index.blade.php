<div class="p-8">
    <button
        wire:click="create"
        class="mb-4 rounded bg-blue-500 px-4 py-2 font-semibold text-white hover:bg-blue-700"
    >
        Create A Product
    </button>

    <x-card-wrapper>
        @foreach($products as $product)
            <x-card>
                <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}"
                    class="aspect-square w-full rounded-lg object-cover" />

                <h3 class="mt-4 text-sm text-gray-700">{{ $product->name }}</h3>
                <p class="mt-1 text-lg font-medium text-gray-900">Rp {{ number_format($product->price) }}</p>
                <p class="text-sm text-gray-500 mt-2">{{ $product->description }}</p>

                <div class="mt-4 flex gap-2">
                    <button
                        wire:click="edit({{ $product->id }})"
                        class="rounded border px-3 py-1 text-sm"
                    >
                        Edit
                    </button>
                    <button
                        @click="$dispatch('confirm-delete', { product_id: {{ $product->id }} })"
                        class="rounded border px-3 py-1 text-sm bg-red-600 text-white hover:bg-red-800"
                    >
                        Delete
                    </button>
                </div>
            </x-card>
        @endforeach
    </x-card-wrapper>

    {{ $products->links() }}

    @if ($showModal)
        <x-modal :mode="$mode" :name="$name" :imageurl="$image_url" :image="$image" wire:key="product-modal"></x-modal>
    @endif

    <x-confirm-delete />
</div>
