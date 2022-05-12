<?php

namespace App\Http\Livewire\Bundle;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Admin\Bundle;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $intermediary_levels;
    public $intermediaryLevelId;
    public $bundle_name;
    public $description;
    public $duration;
    public $price;
    public $image;
    public $banner;
    public $tempImage;
    public $tempBanner;
    public $url;
    public $bundle_for_whom;

    public function updatedbundle_name()
    {
        $this->validate([
            'bundle_name' => ['required', 'string', 'max:100', 'unique:bundles,bundle_name'],
        ]);
    }

    public function updatedDuration()
    {
        $this->validate([
            'duration' => 'required|numeric|between:1,36',
        ]);
    }

    public function updatedUrl()
    {
        $this->validate([
            'url' => ['nullable', 'string', 'min:3'],
        ]);
    }

    public function updatedImage()
    {
        $this->tempImage = $this->image;
    }

    public function updatedBanner()
    {
        $this->tempBanner = $this->banner;
    }

    public function updatedIntermediaryLevelId()
    {
        $this->validate([
            'intermediaryLevelId' => 'required'
        ]);
    }

    public function updatedPrice()
    {
        $this->validate([
            'price' => 'required|integer|numeric'
        ]);
    }

    public function updatedDescription()
    {
        $this->validate([
            'description' => 'required|string|max:500'
        ]);
    }

    protected $rules = [
        'bundle_name' => ['required', 'string', 'max:100', 'unique:bundles'],
        'banner' => 'nullable|image|mimes:jpeg,jpg,png',
        'image' => 'nullable|mimes:jpeg,jpg,png',
        'description' => 'required|string|max:1000',
        'url' => ['nullable', 'string', 'min:3'],
        'price' => 'required|integer|numeric|gt:-1',
        'intermediaryLevelId' => 'required',
        'duration' => 'required|numeric|between:1,36',
        'bundle_for_whom' => 'required'
    ];

    public function saveBundle()
    {
        $data = $this->validate();

        if ($this->image) {
            $imageUrl = $this->image->store('public/bundle/icon');
            $this->image = Storage::url($imageUrl);
        }
        if ($this->banner) {
            $imageUrl2 = $this->banner->store('public/bundle/banner');
            $this->banner = Storage::url($imageUrl2);
        }

        $bundle = new Bundle();
        $bundle->bundle_name = $data['bundle_name'];
        $bundle->slug = Str::slug($data['bundle_name']);
        $bundle->icon = $this->image;
        $bundle->banner = $this->banner;
        $bundle->intermediary_level_id = $data['intermediaryLevelId'];
        $bundle->description = $data['description'];
        $bundle->duration = $data['duration'];
        $bundle->trailer = $data['url'];
        $bundle->price = $data['price'];
        $bundle->status = 1;
        $bundle->bundle_for_whom = $data['bundle_for_whom'];
        $save = $bundle->save();

        if ($save) {
            session()->flash('status', 'Bundle successfully added!');
            return redirect()->route('bundle.index');
        } else {
            session()->flash('failed', 'Bundle added failed!');
            return redirect()->route('bundle.create');
        }
    }

    public function render()
    {
        return view('livewire.bundle.create');
    }
}
