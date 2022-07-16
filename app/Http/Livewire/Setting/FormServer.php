<?php

namespace App\Http\Livewire\Setting;

use App\Models\Server;
use Livewire\Component;

class FormServer extends Component
{
    public $form = [];

    /**
     * Form rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'form.host' => 'required|string',
            'form.port' => 'required|integer|min:80|max:9999',
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
            'form.host' => 'Host/Domain/URL',
            'form.port' => 'Port',
        ];
    }

    private function getValue()
    {
        return Server::query()->first();
    }

    public function mount()
    {
        $value = $this->getValue();

        $this->fill([
            'form.host' => value($value) ? $value->host : 'localhost',
            'form.port' => value($value) ? $value->port : '3210',
        ]);
    }

    public function submit()
    {
        $validated = $this->validate();
        $input = $validated['form'];

        $model = $this->getValue() ?? new Server();
        $model->host = $input['host'];
        $model->port = $input['port'];
        $model->save();

        session()->flash('status', 'Saved!');
    }

    public function render()
    {
        return view('setting.form-server');
    }
}
