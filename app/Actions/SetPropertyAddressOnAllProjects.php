<?php

namespace App\Actions;

use App\Models\Project;

class SetPropertyAddressOnAllProjects
{
    public static function handle($propertyAddress, $newPropertyAddress)
    {
        Project::where('property_address', $propertyAddress)->update(['property_address' => $newPropertyAddress]);
    }
}
