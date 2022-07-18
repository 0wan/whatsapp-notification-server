<?php

namespace App\Http\Livewire\Token;

use Livewire\Component;

class TokenLists extends Component
{
    protected $listeners = ['token-lists-refresh' => '$refresh'];

    public function getItems()
    {
        return \Auth::user()->tokens()->latest()->get();
    }

    public function render()
    {
        return view('token.token-lists', ['items' => $this->getItems()]);
    }
}
