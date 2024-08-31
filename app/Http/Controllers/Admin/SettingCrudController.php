<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SettingRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Enums\SettingTypeEnum;

class SettingCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Setting::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/setting');
        CRUD::setEntityNameStrings('setting', 'settings');
    }

    protected function setupListOperation()
    {
        Log::info('Setting up list operation for settings');

        CRUD::column('title')
            ->label('Title')
            ->type('text')
            ->value(function ($entry) {
                return SettingTypeEnum::getName($entry->title);
            });

        CRUD::column('value')->label('Value');

        $this->crud->addColumn([
            'name' => 'image',
            'label' => 'Image',
            'type' => 'custom_html',
            'value' => function ($entry) {
                $imagePath = public_path('storage/' . $entry->image);
                if (!$entry->image || !file_exists($imagePath)) {
                    return '-';
                }

                return '
                    <a href="#" data-image="/storage/' . $entry->image . '" onclick="openImageModal(event)">
                        <img src="/storage/' . $entry->image . '" style="height: 60px; width: auto;" />
                    </a>
                ';
            },
        ]);

        Log::info('Data in list operation:', ['data' => CRUD::getEntries()]);
        Log::info('Data from CRUD:', ['data' => $this->crud->getEntries()]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(SettingRequest::class);

        CRUD::addField([
            'name' => 'title',
            'label' => 'Option',
            'type' => 'select_from_array',
            'options' => \App\Enums\SettingTypeEnum::all(),
            'allows_null' => false,
            'default' => \App\Enums\SettingTypeEnum::BRAND_LOGO,
        ]);

        CRUD::field('value')->label('Value')->type('textarea');
        CRUD::field('image')
        ->label('Image')
        ->type('upload')
        ->upload('public')
        ->attributes([
            'accept' => 'image/*',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    // public function store(\Illuminate\Http\Request $request)
    // {
    //     $this->validate($request, [
    //         'title' => 'required|string',
    //         'value' => 'nullable|string',
    //         'image' => 'nullable|file|mimes:jpeg,png,jpg|max:20480',
    //     ]);

    //     $data = $request->except(['image']);

    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('images', 'public');
    //         $data['image'] = $imagePath;
    //     }

    //     CRUD::create($data);

    //     \Alert::success('Setting created successfully.')->flash();

    //     return redirect()->back();
    // }

    public function update(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            'image' => 'nullable|file|mimes:jpeg,png,jpg|max:20480',
        ]);

        $data = $request->except(['image']);

        $model = CRUD::getCurrentEntry();

        if ($request->hasFile('image')) {
            if ($model->image) {
                Storage::disk('public')->delete($model->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        } else {
            $data['image'] = $model->image;
        }

        $model->update($data);

        \Alert::success('Setting updated successfully.')->flash();

        return $this->crud->performSaveAction();
    }
}
