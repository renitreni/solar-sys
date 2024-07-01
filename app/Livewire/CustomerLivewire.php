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
    }
}
