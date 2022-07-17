<?php

namespace App\Http\Livewire\Token;

use Auth;
use Livewire\Component;
use Str;

class FormCreateToken extends Component
{
    public function submit()
    {
        $user = Auth::user();
        $token = $user->createToken(Str::slug(config('app.name') . 'auth token for ' . $user->getAuthIdentifier(),'_'))->plainTextToken;
        $user->api_token = $token;
        $user->save();

        $this->emit('token-lists-refresh');
    }

    public function render()
    {
        return view('token.form-create-token');
    }
}
