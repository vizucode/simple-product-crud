<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{

    use WithFileUploads;
    use WithPagination;

    public bool $showModal = false;
    public string $mode = 'create';
    public ?int $productId = null;

    public string $name = '';
    public ?float $price = null;
    public ?int $qty = null;
    public string $description = '';
    public $image;
    public ?string $image_url = '';


    protected function rules() 
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => $this->mode === 'create' ? 'required|image|max:2048' : 'nullable|image|max:2048',
        ];
    }

    public function create()
    {
        $this->resetForm();
        $this->mode = 'create';
        $this->showModal = true;
    }

    public function edit(int $id)
    {
        $product = Product::findOrFail($id);

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->qty = $product->qty;
        $this->description = $product->description;
        $this->image_url = $product->image_url;

        $this->mode = 'edit';
        $this->showModal = true;
    }

    public function delete(int $id) {
        try {
            $product = Product::findOrFail($id);

            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }
            $product->delete();
        }catch (\Exception $e) {
            $this->dispatch('sweet-toast', icon: 'error', message: 'An error occurred while deleting the product.');
            return;
        }
    }

    public function close()
    {
        $this->resetValidation();
        $this->showModal = false;
    }

    private function resetForm()
    {
        $this->reset(['productId', 'name', 'price', 'qty', 'description', 'image_url', 'image']);
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();

        try {
            if ($this->image) {
                $path = $this->image->store('products', 'public');
            }

            if ($this->mode === 'create') {
                Product::create([
                    'name' => $this->name,
                    'price' => $this->price,
                    'qty' => $this->qty,
                    'description' => $this->description,
                    'image_url' => $path ?? null,
                ]);
            } else {
                $product = Product::findOrFail($this->productId);

                if ($this->image_url && $this->image_url !== $product->image_url) {
                    Storage::disk('public')->delete($product->image_url);
                }

                Product::where('id', $this->productId)->update([
                    'name' => $this->name,
                    'price' => $this->price,
                    'qty' => $this->qty,
                    'description' => $this->description,
                    'image_url' => $path ?? $this->image_url,
                ]);
            }

            $this->close();
            $this->dispatch('sweet-toast', icon: 'success', message: 'Product saved successfully.');

        } catch (\Exception $e) {
            $this->dispatch('sweet-toast', icon: 'error', message: 'An error occurred while saving the product.');
        }
    }

    public function render()
    {
        return view('livewire.products.index', [
            'products' => Product::query()->latest()->paginate(3),
        ]);
    }
}
