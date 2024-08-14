<?php

namespace App\Livewire;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class RelatedJobsTable extends PowerGridComponent
{
    use WithExport;

    public $propertyAddress;

    public $projectId;

    #[On('related-job-table')]
    public function setParameter($projectId, $propertyAddress)
    {
        $this->projectId = $projectId;
        $this->propertyAddress = Str::trim($propertyAddress);
    }

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
        return Project::query()->with('client')->where('property_address', $this->propertyAddress)->whereNot('id', $this->projectId);
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
            ->add('client.name')
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
            ->add('priority_level')
            ->add('task_price_total')
            ->add('commercial_job_price')
            ->add('task_total')
            ->add('rfi_messages')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')->hidden(),
            Column::make('Client Name', 'client.name'),
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

            Column::make('Task price total', 'task_price_total')
                ->sortable()
                ->searchable(),

            Column::make('Task total', 'task_total')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
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
