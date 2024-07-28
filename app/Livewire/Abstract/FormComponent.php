<?php

namespace App\Livewire\Abstract;

use Illuminate\Support\Str;
use Livewire\Component;

abstract class FormComponent extends Component
{
    public function initModelData($model)
    {
        foreach (collect($model) as $key => $item) {
            if (property_exists($this, $varName = Str::camel($key))) {
                $this->{$varName} = $item;
            }
        }
    }
}
