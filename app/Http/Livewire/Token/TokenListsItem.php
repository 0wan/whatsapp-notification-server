<?php

namespace App\Http\Livewire\Token;

use App\Models\PersonalAccessToken;
use Auth;
use Livewire\Component;

class TokenListsItem extends Component
{
    public $model;

    public $afterDelete = false;

    public function mount($model)
    {
        $this->model = $model;
    }

    private function getToken()
    {
        return PersonalAccessToken::find($this->model);
    }

    private function isLatestToken($user, $tokenId): bool
    {
        if ($token = $user->api_token) {
            $id = \Str::before($token, '|');

            return $id == $tokenId;
        }

        return false;
    }

    public function deleteToken()
    {
        $token = $this->getToken();
        $token->delete();

        $this->afterDelete = true;

        $this->emit('token-lists-refresh');
    }

    public function render()
    {
        $user = Auth::user();
        $token = $this->getToken();

        return (!$this->afterDelete)
            ? view('token.token-lists-item', ['token' => $token, 'isLatest' => $this->isLatestToken($user, $this->model)])
            : $this->empty();
    }

    public function empty()
    {
        return <<<'blade'
            <div></div>
        blade;
    }
}
