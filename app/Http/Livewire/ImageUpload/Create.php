<?php

namespace App\Http\Livewire\ImageUpload;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Admin\ImageUpload;

class Create extends Component
{
    use WithFileUploads;

    public $images = [];
    public $title = [];

    public function removeImage($index)
    {
        unset($this->images[$index]);
    }

    protected $rules = [
        'images.*' => 'image|max:4096|required',
        'title.*' => 'string'
    ];

    public function saveImages()
    {
        $data = $this->validate();

        foreach ($this->images as $key => $image) {
            $imageUrl = $image->store('public/uploadImages');

            $imageUpload = new ImageUpload;
            $imageUpload->image = $imageUrl;
            if (!empty($this->title[$key])) {
                $imageUpload->title = $this->title[$key];
                $imageUpload->slug = Str::slug($this->title[$key]);
            }
            $save = $imageUpload->save();
        }
        return redirect()->route('upload-image.index');
    }

    public function render()
    {
        return view('livewire.image-upload.create');
    }
}
