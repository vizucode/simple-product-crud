<div class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="absolute inset-0 bg-black/50" wire:click="close"></div>

    <div class="relative w-full max-w-md rounded-lg bg-white p-6 shadow-lg">
        <h2 class="mb-4 text-lg font-semibold">
            {{ $mode === 'create' ? 'Create Product' : 'Edit Product' }}
        </h2>

        <div class="space-y-3">
            <div>
                <input
                    type="file"
                    wire:model="image"
                    accept="image/*"
                    class="w-full"
                />
                @error('image') <p class="text-sm text-red-600">{{ $message }}</p> @enderror

                @if ($image)
                    <img
                        src="{{ $image->temporaryUrl() }}"
                        class="mt-2 h-32 rounded object-cover"
                    >
                @elseif ($imageurl)
                    <img
                        src="{{ asset('storage/' . $imageurl) }}"
                        class="mt-2 h-32 rounded object-cover"
                    >
                @endif
            </div>
            <div>
                <input type="text" wire:model="name" placeholder="Product name"
                    class="w-full rounded border px-3 py-2" />
                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <input type="number" wire:model="price" placeholder="Price"
                    class="w-full rounded border px-3 py-2" />
                @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <input type="number" wire:model="qty" placeholder="Quantity"
                    class="w-full rounded border px-3 py-2" />
                @error('qty') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <input type="text" wire:model="description" placeholder="Description"
                    class="w-full rounded border px-3 py-2" />
                @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-2">
            <button wire:click="close" class="rounded border px-4 py-2">
                Cancel
            </button>

            <button wire:click="save" class="rounded bg-blue-600 px-4 py-2 text-white">
                {{ $mode === 'create' ? 'Save' : 'Update' }}
            </button>
        </div>
    </div>
</div>