<?php

namespace App\Http\Livewire\Message;

use App\Models\Server;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class FormSendText extends Component
{
    public $phone = '628';

    public $message = '';

    /**
     * Form rules.
     *
     * @TODO: Phone number rules.
     * @return array
     */
    public function rules(): array
    {
        return [
            'phone' => 'required|digits_between:8,15',
            'message' => 'required|string|max:160',
        ];
    }

    /**
     * Form attributes.
     *
     * @return array
     */
    public function validationAttributes(): array
    {
        return [
            'phone' => 'phone',
            'message' => 'message',
        ];
    }

    public function submit()
    {
        $validated = $this->validate();

        $server = $this->getServer();

        $request = Http::post($server->host .':'.$server->port .'/message',[
            'phone' => $validated['phone'],
            'message' => $validated['message'],
        ]);

        if ($request->status() >= 300 || $request->status() < 200) {
            session()->flash('status', 'Server Error!');
            return;
        }

        session()->flash('status', 'Sent!');
    }

    private function getServer()
    {
        return Server::query()->first();
    }

    public function render()
    {
        return view('message.form-send-text');
    }
}
