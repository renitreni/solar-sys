<?php

namespace App\Livewire;

use App\Models\Client;
use Livewire\Attributes\On;
use Livewire\Component;

class CustomerLivewire extends Component
{
    public $name;
    public $email;
    public $address;
    public $contact_no;
    public $clientId;

    public function render()
    {
        return view('livewire.customer-livewire');
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

    public function update()
    {
        $this->validate([
            'email' => 'required',
            'name' => 'required'
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
}
