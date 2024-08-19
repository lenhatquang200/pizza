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
            'type' => 'select_from_array',
            'options' => \App\Enums\PageNameEnum::all(), // Đây là mảng các giá trị
            'allows_null' => false,
            'default' => \App\Enums\PageNameEnum::HOME,
        ]);

        CRUD::addField([
            'name' => 'imagetype',
            'label' => 'Image Type',
            'type' => 'select_from_array',
            'options' => \App\Enums\ImageTypeEnum::all(),
            'allows_null' => false,
            'default' => \App\Enums\ImageTypeEnum::BANNERHOME,
        ]);

        CRUD::addField([
            'name' => 'imageurl',
            'label' => 'Image URL',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public',
            'prefix' => 'uploads/',
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
        // Validate input
        $this->validate($request, [
            'imageurl' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store file and get path
        $data = $request->except('imageurl');

        if ($request->hasFile('imageurl')) {
            $imagePath = $request->file('imageurl')->store('uploads', 'public');
            $data['imageurl'] = $imagePath;
        }

        // Ensure 'pagename' and 'imagetype' are text values
        $data['pagename'] = \App\Enums\PageNameEnum::getName($data['pagename']);
        $data['imagetype'] = \App\Enums\ImageTypeEnum::getName($data['imagetype']);

        // Save data
        CRUD::create($data);

        \Alert::success('Image uploaded successfully.')->flash();

        return redirect()->back();
    }
    public function update(\Illuminate\Http\Request $request)
    {
        // Validate input
        $this->validate($request, [
            'imageurl' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('imageurl');

        // Xử lý lưu trữ ảnh
        if ($request->hasFile('imageurl')) {
            $imagePath = $request->file('imageurl')->store('uploads', 'public');
            $data['imageurl'] = $imagePath;

            // Xóa ảnh cũ nếu có
            $model = CRUD::getCurrentEntry();
            if ($model && $model->imageurl) {
                Storage::disk('public')->delete($model->imageurl);
            }
        }

        // Ensure 'pagename' and 'imagetype' are text values
        $data['pagename'] = \App\Enums\PageNameEnum::getName($data['pagename']);
        $data['imagetype'] = \App\Enums\ImageTypeEnum::getName($data['imagetype']);

        // Cập nhật dữ liệu
        $model = CRUD::getCurrentEntry();
        $model->update($data);

        \Alert::success('Image updated successfully.')->flash();

        return redirect()->back();
    }
}
