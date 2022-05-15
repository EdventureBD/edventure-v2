<?php

namespace App\Http\Livewire\Bundle;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Admin\Bundle;
use App\Models\Admin\IntermediaryLevel;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $bundle;
    public $categories;

    public $bundle_name;
    public $description;
    public $price;
    public $intermediaryLevelId;
    public $duration;
    public $url;
    public $image;
    public $banner;
    public $tempImage;
    public $tempBanner;
    public $deleteImage;
    public $deleteBanner;
    // initializing with empty string so disabled selected option works properly
    public $status = "";

    public function updatedBundle_name()
    {
        $this->validate([
            'bundle_name' => ['required', 'string', 'max:100'],
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

    public function updatedStatus()
    {
        $this->validate([
            'status' => 'required|numeric|integer||between:0,1'
        ]);
    }

    protected $rules = [
        'bundle_name' => ['required', 'string', 'max:100'],
        'description' => 'required|string|max:500',
        'url' => ['nullable', 'string', 'min:3'],
        'price' => 'required|integer|numeric|gt:-1',
        'intermediaryLevelId' => 'required',
        'duration' => 'required|numeric|between:1,36',
        'status' => 'required|numeric|integer||between:0,1'
    ];

    public function updateBundle()
    {
        $data = $this->validate();
        $bundle = Bundle::find($this->bundle->id);
        // dd($data, $bundle);
        // if ($this->tempImage) {
        //     $imageUrl = $this->image->store('public/bundle');
        //     $this->image = Storage::url($imageUrl);
        //     Storage::delete($this->deleteImage);
        // }

        if (!empty($this->tempImage)) {
            $fileName = "public/bundle/icon/" . str_replace('/storage/bundle/icon/', '', $bundle->icon);
            Storage::delete($fileName);
            $this->image = Storage::url($this->tempImage->store('public/bundle/icon'));
        }

        if (!empty($this->tempBanner)) {
            $fileName = "public/bundle/banner/" . str_replace('/storage/bundle/banner/', '', $bundle->banner);
            $file2 = Storage::delete($fileName);
            $this->banner = Storage::url($this->tempBanner->store('public/bundle/banner'));
        }

        $bundle->icon = $this->image;
        $bundle->banner = $this->banner;
        $bundle->bundle_name = $data['bundle_name'];
        $bundle->slug = Str::slug($data['bundle_name']);
        $bundle->intermediary_level_id = $data['intermediaryLevelId'];
        $bundle->description = $data['description'];
        $bundle->duration = $data['duration'];
        $bundle->trailer = $data['url'];
        $bundle->price = $data['price'];
        $bundle->status = $data['status'];
        $save = $bundle->save();

        if ($save) {
            session()->flash('status', 'Bundle successfully updated!');
            return redirect()->route('bundle.index');
        } else {
            session()->flash('failed', 'Bundle added updated!');
            return redirect()->route('bundle.edit', $this->bundle->id);
        }
    }

    public function mount()
    {
        $this->bundle_name = $this->bundle->bundle_name;
        $this->description = $this->bundle->description;
        $this->price = $this->bundle->price;
        $this->intermediaryLevelId = $this->bundle->intermediary_level_id;
        $this->duration = $this->bundle->duration;
        $this->url = $this->bundle->trailer;
        $this->image = $this->bundle->icon;
        $this->banner = $this->bundle->banner;
        $this->deleteImage = $this->bundle->icon;
        $this->deleteBanner = $this->bundle->banner;
        $this->status = $this->bundle->status;
        $this->intermediary_levels = IntermediaryLevel::all();
    }

    public function render()
    {
        return view('livewire.bundle.edit');
    }
}
