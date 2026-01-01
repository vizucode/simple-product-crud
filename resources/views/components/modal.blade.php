<div class="fixed inset-0 z-50 flex items-center justify-center">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" wire:click="close"></div>

    <div class="relative w-full max-w-md rounded-xl bg-white p-8 shadow-xl" wire:key="product-modal-{{ $mode }}">
        <h2 class="mb-6 text-2xl font-bold text-gray-900">
            @if ($mode == 'create')
            Create Product
            @elseif ($mode == 'edit')
            Edit Product
            @else
            Detail Product
            @endif
        </h2>

        @if ($mode != 'view')
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
                    <input type="file" wire:model="image" accept="image/*"
                        class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer" />
                    @error('image') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror

                    @if ($image)
                    <img src="{{ $image->temporaryUrl() }}"
                        class="mt-3 h-40 w-full rounded-lg object-cover border border-gray-100">
                    @elseif ($imageurl)
                    <img src="{{ asset('storage/' . $imageurl) }}"
                        class="mt-3 h-40 w-full rounded-lg object-cover border border-gray-100">
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
                    <input type="text" wire:model="name" placeholder="Enter product name"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm placeholder:text-gray-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20" />
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                    <input type="number" wire:model="price" placeholder="0"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm placeholder:text-gray-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20" />
                    @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                    <input type="number" wire:model="qty" placeholder="0"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm placeholder:text-gray-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20" />
                    @error('qty') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea type="text" wire:model="description" placeholder="Enter product description"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm placeholder:text-gray-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20" ></textarea>
                    @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        @else
            <div class="space-y-5">
                <div class="mb-6">
                    @if ($imageurl)
                        <img src="{{ asset('storage/' . $imageurl) }}"
                            class="w-full h-64 rounded-lg object-cover border border-gray-100">
                    @else
                        <div class="w-full h-64 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">No Image</span>
                        </div>
                    @endif
                </div>

                <div>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $name }}</h3>
                </div>

                <div>
                    <p class="text-3xl font-bold text-blue-600">Rp {{ number_format($price, 0, ',', '.') }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4 py-4 border-y border-gray-100">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Quantity</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $qty }} pcs</p>
                    </div>
                </div>

                <div>
                    <p class="text-sm text-gray-500 mb-2">Description</p>
                    <p class="text-gray-700 leading-relaxed">{{ $description ?? '-' }}</p>
                </div>
            </div>
        @endif

        <div class="mt-8 flex justify-end gap-3">
            <button wire:click="close"
                class="rounded-lg border border-gray-300 px-4 py-2.5 font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                Close
            </button>

            @if ($mode != 'view')
            <button wire:click="save"
                class="rounded-lg bg-blue-600 px-6 py-2.5 font-medium text-white hover:bg-blue-700 transition-colors">
                {{ $mode === 'create' ? 'Save Product' : 'Update Product' }}
            </button>
            @endif
        </div>
    </div>
</div>