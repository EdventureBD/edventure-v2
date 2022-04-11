<?php

namespace App\Http\Livewire\IntermediaryLevel;

use Livewire\Component;
use Illuminate\Support\Str;

// models
use App\Models\Admin\IntermediaryLevel;

class Create extends Component
{

    public $categories;
    public $title;
    public $categoryId = '';

    protected $rules = [
        'title' => ['required', 'unique:intermediary_levels,title'],
        'categoryId' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function storeIntermediaryLevel(){

        $this->validate();

        $created = IntermediaryLevel::create([
            'course_category_id' => $this->categoryId,
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'status' => 1,
        ]);

        if ($created) {
            $this->title = '';
            $this->categoryId = '';
            session()->flash('status', 'Program successfully added!');
            return redirect()->route('intermediary_level.index');
        } else {
            $this->title = '';
            $this->categoryId = '';
            session()->flash('failed', 'Program added failed!');
            return redirect()->route('intermediary_level.create');
        }
    }

    public function render()
    {
        return view('livewire.intermediary-level.create', 
        [
            'categories' => $this->categories,
        ]);
    }
}
