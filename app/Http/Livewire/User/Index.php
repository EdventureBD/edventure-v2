<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $type;

    public function render()
    {
        return view('livewire.user.index', [
            'users' => User::orderBy('user_type')->whereIn('user_type', $this->type)->paginate(10)
        ]);
    }
}
