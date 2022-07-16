<?php

namespace App\Http\Livewire\Setting;

use App\Models\Device;
use App\Models\Server;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use NotificationChannels\Webhook\WebhookChannel;

class FormDevice extends Component
{
    public $latest;

    public $status = 'Not Checked';

    public $qr;

    private function getServer()
    {
        return Server::query()->first();
    }

    private function getDevice()
    {
        return Device::query()->first();
    }

    public function mount()
    {
        $device = $this->getDevice();

        $this->latest = ($device) ? $device->status : 'Not Checked';
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getStatus()
    {
        $server = $this->getServer();
        $this->qr = null;

        if (!$server) {
            return;
        }

        $request = Http::get($server->host .':'.$server->port .'/status');

        if ($request->status() >= 300 || $request->status() < 200) {
            $this->status = 'Server Error';
        }

        $response = $request->json() ?? [];

        if (\Arr::get($response, 'success') == true) {
            $this->status = \Arr::get($response, 'data.status', 'Unknown');
            if ($qr = \Arr::get($response, 'data.qr')) {
                $this->qr = $qr;
            }

            $this->updateDevice($this->status);
        }

    }

    protected function updateDevice($status)
    {
        $model = $this->getDevice() ?? new Device();
        $model->status =  $status;
        $model->save();

        $this->latest = $model->status;
    }

    public function render()
    {
        return view('setting.form-device');
    }
}
