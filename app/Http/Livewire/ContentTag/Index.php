<?php

namespace App\Http\Livewire\ContentTag;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\ContentTag;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.content-tag.index', [
            'content_tags' => ContentTag::paginate(10)
        ]);
    }
}
