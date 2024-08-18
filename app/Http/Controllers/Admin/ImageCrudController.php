<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ImageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Log;

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
        CRUD::setRoute(config('backpack.base.route_prefix') . '/image');
        CRUD::setEntityNameStrings('image', 'images');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        Log::info('Setting up Create Operation for ImageCrudController.');

        CRUD::setValidation(ImageRequest::class);

        Log::info('Adding fields for Image model.');

        CRUD::addField([
            'name' => 'pagename',
            'label' => 'Page Name',
            'type' => 'text',
        ]);

        CRUD::addField([
            'name' => 'imagetype',
            'label' => 'Image Type',
            'type' => 'text',
        ]);

        CRUD::addField([
            'name' => 'image',
            'label' => 'Image',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public',
            'prefix' => 'uploads/',
            'wrapper' => [
                'class' => 'form-group col-md-6',
            ],
        ]);

        CRUD::addField([
            'name' => 'imageurl',
            'label' => 'Image URL',
            'type' => 'text',
            'attributes' => [
                'readonly' => true,
            ],
            'wrapper' => [
                'class' => 'form-group col-md-6',
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
        $this->setupCreateOperation();
    }

    public function store(\Illuminate\Http\Request $request)
    {
    $this->validate($request, [
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->except('image');

    if ($request->hasFile('image')) {
        // Lưu ảnh vào thư mục uploads
        $imagePath = $request->file('image')->store('uploads', 'public');
        // Lưu đường dẫn ảnh vào cơ sở dữ liệu
        $data['imageurl'] = $imagePath;
    }

    CRUD::create($data);

    return redirect()->back()->with('success', 'Image uploaded successfully.');
    }
}
