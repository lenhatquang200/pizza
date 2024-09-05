<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name')->label('Product Name');
        CRUD::column('category_id')->type('select')->label('Category')
          ->entity('category')->model('App\Models\Category')->attribute('name');

        $this->crud->addColumn([
          'name' => 'image',
          'label' => 'Image',
          'type' => 'custom_html',
          'value' => function ($entry) {
              return '
                    <a href="#" data-image="'.$entry->image_url.'" onclick="openImageModal(event)">
                        <img src="'.$entry->image_url.'" style="height: 60px; width: auto;" />
                    </a>
                ';
          },
        ]);
        CRUD::column('price')->label('Price');
        CRUD::column('is_special')->type('boolean')->label('Is Special');

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
        CRUD::setValidation(ProductRequest::class);
//        CRUD::setFromDb(); // set fields from db columns.
        CRUD::field('category_id')->type('select')->label('Category')->entity('category')
          ->model('App\Models\Category')->attribute('name');
        CRUD::field('name')->type('text')->label('Product Name');
        CRUD::field('image')->type('upload')->upload()->label('Product Image')->crop(true)->aspect_ratio(1);
        CRUD::field('price')->type('text')->label('Price');
        CRUD::field('description')->type('textarea')->label('Description');
        CRUD::field('short_description')->type('text')->label('Short Description');
        CRUD::field('is_special')->type('checkbox')->label('Is Special');
        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
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
    public function store()
    {
        // Custom logic before storing
        $request = $this->crud->getRequest();
        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/products');
            $image->move($destinationPath, $filename);
            // Save the image path to the request
            $data['image'] = $filename;
        }

        // Call the parent store method to perform the default storing operation
        CRUD::create($data);
        $this->crud->setSaveAction();
        return $this->crud->performSaveAction();

    }
    public function update()
    {
        // Custom logic before updating
        $request = $this->crud->getRequest();
        $product = $this->crud->getCurrentEntry();

        // Handle image upload
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/products');
            $image->move($destinationPath, $filename);
//            dd($image,$filename);

            // Delete the old image if necessary
            if ($product->image && file_exists(public_path('storage/' . $product->image))) {
                unlink(public_path('storage/' . $product->image));
            }

            // Save the new image path
//            dd($filename);
            $data['image'] = $filename;
        }

        // Call the parent update method to perform the default updating operation
        $model = CRUD::getCurrentEntry();
        $model->update($data);

        \Alert::success('Image updated successfully.')->flash();

        $this->crud->setSaveAction();

        return $this->crud->performSaveAction();
    }


}
