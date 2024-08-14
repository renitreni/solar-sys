<?php

namespace App\Livewire\Components;

use App\Models\Client;
use Livewire\Attributes\On;
use Livewire\Component;

class ClientFormLivewireComponent extends Component
{
    public $name;

    public $email;

    public $address;

    public $contact_no;

    public $clientId;
    
    public function render()
    {
        return view('livewire.components.client-form-livewire-component');
    }

    #[On('client-edit')]
    public function bindEdit($clientId)
    {
        $client = Client::find($clientId);
        $this->name = $client->name;
        $this->email = $client->email;
        $this->address = $client->address;
        $this->contact_no = $client->contact_no;
        $this->clientId = $client->id;
    }

    #[On('client-add')]
    public function clearFields()
    {
        $this->name = null;
        $this->email = null;
        $this->address = null;
        $this->contact_no = null;
        $this->clientId = null;
        $this->js('$("#clientFormModal").modal("show")');
    }

    public function store()
    {
        $this->validate([
            'email' => ['required', 'unique:clients,email'],
            'name' => 'required',
        ]);

        $client = new Client;
        $client->name = $this->name;
        $client->email = $this->email;
        $client->address = $this->address;
        $client->contact_no = $this->contact_no;
        $client->save();

        $this->js('$("#clientFormModal").modal("hide")');
        $this->dispatch('pg:eventRefresh-ClientTable');
    }

    public function update()
    {
        $this->validate([
            'email' => 'required',
            'name' => 'required',
        ]);

        $client = Client::find($this->clientId);
        $client->name = $this->name;
        $client->email = $this->email;
        $client->address = $this->address;
        $client->contact_no = $this->contact_no;
        $client->save();

        $this->js('$("#clientFormModal").modal("hide")');
        $this->dispatch('pg:eventRefresh-ClientTable');
    }

    public function destroy()
    {
        Client::find($this->clientId)->delete();

        $this->js('$("#clientFormModal").modal("hide")');
        $this->dispatch('pg:eventRefresh-ClientTable');
    }
}
