<?php

namespace App\Livewire;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

final class ProjectTable extends PowerGridComponent
{
    public $disableAction = false;

    public function setUp(): array
    {
        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Project::query()
            ->with('client');
    }

    public function relationSearch(): array
    {
        return [
            'client' => [
                'name',
            ],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('client_name', fn ($v) => $v->client->name)
            ->add('project_number')
            ->add('property_type')
            ->add('property_owner_name')
            ->add('property_address')
            ->add('property_state')
            ->add('property_city')
            ->add('property_area_code')
            ->add('wet_stamp_mailing_address')
            ->add('wet_stamp_count')
            ->add('shipping_number')
            ->add('task_price_total')
            ->add('commercial_job_price')
            ->add('task_total')
            ->add('rfi_messages')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::action('Action')->hidden($this->disableAction),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::make('Client', 'client_name'),
            Column::make('Project number', 'project_number')
                ->sortable()
                ->searchable(),

            Column::make('Property type', 'property_type')
                ->sortable()
                ->searchable(),

            Column::make('Property owner name', 'property_owner_name')
                ->sortable()
                ->searchable(),

            Column::make('Property address', 'property_address')
                ->sortable()
                ->searchable(),

            Column::make('Property state', 'property_state')
                ->sortable()
                ->searchable(),

            Column::make('Property city', 'property_city')
                ->sortable()
                ->searchable(),

            Column::make('Property area code', 'property_area_code')
                ->sortable()
                ->searchable(),

            Column::make('Wet stamp mailing address', 'wet_stamp_mailing_address')
                ->sortable()
                ->searchable(),

            Column::make('Wet stamp count', 'wet_stamp_count')
                ->sortable()
                ->searchable(),

            Column::make('Shipping number', 'shipping_number')
                ->sortable()
                ->searchable(),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(Project $row): array
    {
        return [
            Button::add('view')
                ->slot('View')
                ->id()
                ->class('btn btn-xs btn-secondary m-1')
                ->dispatch('project-view-modal', ['rowId' => $row->id]),
            Button::add('edit')
                ->slot('Edit')
                ->id()
                ->class('btn btn-xs btn-primary m-1')
                ->dispatch('edit-project-form', ['rowId' => $row->id]),
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
