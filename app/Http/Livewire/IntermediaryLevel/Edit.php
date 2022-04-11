<?php

namespace App\Http\Livewire\IntermediaryLevel;

use Livewire\Component;
use Illuminate\Support\Str;

// models
use App\Models\Admin\IntermediaryLevel;

class Edit extends Component
{
    public $categories;
    public $intermediary_level_slug;
    public $intermediary_level_id;

    public $title;
    public $categoryId = '';

    public function mount()
    {
        $intermediary_level = IntermediaryLevel::where('slug', $this->intermediary_level_slug)->firstOrFail();
        $this->title = $intermediary_level->title;
        $this->categoryId = $intermediary_level->course_category_id;
        $this->intermediary_level_id = $intermediary_level->id;

        $this->rules = $this->rules();
    }
    
    // 2 functions below are for validation. Otherwise, the unique validation cannot be applied in a single function/property
    protected array $rules = [];
    
    public function rules()
    {
        return [
            'title' => 'required|unique:intermediary_levels,slug,'.$this->intermediary_level_slug,
            'categoryId' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateIntermediaryLevel(){

        $this->validate();
        
        $intermediary_level_edited = IntermediaryLevel::findorFail($this->intermediary_level_id);
        $intermediary_level_edited->title = $this->title;
        $intermediary_level_edited->course_category_id = $this->categoryId;
        $intermediary_level_edited->slug = Str::slug($this->title);
        $created = $intermediary_level_edited->save();

        if ($created) {
            $this->title = '';
            $this->categoryId = '';
            $this->empty_categoryId = '';
            session()->flash('status', 'Program successfully updated!');
            return redirect()->route('intermediary_level.index');
        } else {
            $this->title = '';
            $this->categoryId = '';
            $this->empty_categoryId = '';
            session()->flash('failed', 'Program update failed!');
            return redirect()->route('intermediary_level.create');
        }
    }

    public function render()
    {
        return view('livewire.intermediary-level.edit');
    }
}
