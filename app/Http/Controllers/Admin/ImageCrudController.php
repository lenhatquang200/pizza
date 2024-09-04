<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ImageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Class ImageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ImageCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Image::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/banner');
        CRUD::setEntityNameStrings('banner', 'banners');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'imageurl',
            'label' => 'Banner',
            'type' => 'custom_html',
            'value' => function ($entry) {
                return '
                    <a href="#" data-image="/storage/' . $entry->imageurl . '" onclick="openImageModal(event)">
                        <img src="/storage/' . $entry->imageurl . '" style="height: 60px; width: auto;" />
                    </a>
                ';
            },
        ]);
        
        $this->crud->addColumn([
            'name' => 'imagetype',
            'label' => 'Position',
            'type' => 'text',
        ]);

        $this->crud->addColumn([
            'name' => 'url',
            'label' => 'Direct Url',
            'type' => 'text',
        ]);
    }
    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation($update=false)
    {
        Log::info('Setting up Create Operation for ImageCrudController.');

        CRUD::setValidation(ImageRequest::class);

        Log::info('Adding fields for Image model.');

        CRUD::addField([
            'name' => 'imagetype',
            'label' => 'Positon',
            'type' => 'select_from_array',
            'options' => \App\Enums\ImageTypeEnum::all(),
            'allows_null' => false,
            'default' => \App\Enums\ImageTypeEnum::BANNERHOME,
        ]);

        $field = [
          'name' => 'url',
          'label' => 'Banner Url (can be empty)',
          'type' => 'text',
          'attributes' => [
                'placeholder' => 'https://abc.xyz',
            ],
            'hint' => 'Please enter a URL in the format: https://abc.xyz',
            'validation' => 'nullable|url',
        ];

        if (!$update) {
            $field['value'] = '#';
        }

        CRUD::addField($field);

        CRUD::addField([
            'name' => 'imageurl',
            'label' => 'Banner',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public',
            'prefix' => '',
            'attributes' => [
                'accept' => 'image/*',
            ],
        ]);

        Log::info('Create Operation setup completed for ImageCrudController.');
    }
    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation(true);
    }
    public function store(ImageRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('imageurl')) {
            $imagePath = $request->file('imageurl')->store('uploads', 'public');
            $data['imageurl'] = $imagePath;
        }

        $data['imagetype'] = \App\Enums\ImageTypeEnum::getName($data['imagetype']);

        // Save data
        CRUD::create($data);

        \Alert::success('Image uploaded successfully.')->flash();

        $this->crud->setSaveAction();

        return $this->crud->performSaveAction();
    }
    public function update(ImageRequest $request)
    {
        $data = $request->except('imageurl');

        if ($request->hasFile('imageurl')) {
            $imagePath = $request->file('imageurl')->store('uploads', 'public');
            $data['imageurl'] = $imagePath;

            $model = CRUD::getCurrentEntry();
            if ($model && $model->imageurl) {
                Storage::disk('public')->delete($model->imageurl);
            }
        }

        $data['imagetype'] = \App\Enums\ImageTypeEnum::getName($data['imagetype']);

        $model = CRUD::getCurrentEntry();
        $model->update($data);

        \Alert::success('Image updated successfully.')->flash();

        $this->crud->setSaveAction();

        return $this->crud->performSaveAction();
    }
}
