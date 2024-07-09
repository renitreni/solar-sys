<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Attributes\On;
use Livewire\Component;

class ServiceLivewire extends Component
{
    public $serviceId;

    public $serviceName;

    public function render()
    {
        return view('livewire.service-livewire');
    }

    #[On('edit-service')]
    public function bindEdit($rowId)
    {
        $service = Service::find($rowId);
        $this->serviceId = $service->id;
        $this->serviceName = $service->service_name;

        $this->js("$('#serviceFormModal').modal('show');");
    }

    #[On('service-add')]
    public function create()
    {
        $this->serviceId = null;
        $this->serviceName = null;

        $this->js("$('#serviceFormModal').modal('show');");
    }

    public function update()
    {
        $this->validate([
            'serviceName' => ['required', 'max:100']
        ]);

        $service = Service::find($this->serviceId);
        $service->service_name = $this->serviceName;
        $service->save();

        $this->js("$('#serviceFormModal').modal('hide');");
        $this->dispatch('pg:eventRefresh-ServiceTable');
    }

    public function destroy()
    {
        $service = Service::find($this->serviceId);
        $service->delete();

        $this->js("$('#serviceFormModal').modal('hide');");
        $this->dispatch('pg:eventRefresh-ServiceTable');
    }

    public function store()
    {
        $this->validate([
            'serviceName' => ['required', 'max:100']
        ]);

        $service = new Service();
        $service->service_name = $this->serviceName;
        $service->save();

        $this->js("$('#serviceFormModal').modal('hide');");
        $this->dispatch('pg:eventRefresh-ServiceTable');
    }
}
