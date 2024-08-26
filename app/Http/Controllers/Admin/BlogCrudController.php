<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BlogRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Storage;

/**
 * Class BlogCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BlogCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Blog::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/blog');
        CRUD::setEntityNameStrings('blog', 'blogs');
        $this->crud->setOperationSetting('menu', [
            'name' => 'Blogs',
            'icon' => 'fa fa-blog', 
        ]);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('title');
        $this->crud->addColumn([
            'name' => 'image',
            'label' => 'Image',
            'type' => 'image',
            'prefix' => 'storage/',
            'height' => '60px',
            'width' => 'auto',
        ]);
        CRUD::column('short_description');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(BlogRequest::class);

        CRUD::addField([
            'name' => 'title',
            'label' => 'Title',
            'type' => 'text',
        ]);

        CRUD::addField([
            'name' => 'content',
            'label' => 'Content',
            'type' => 'textarea',
            'attributes' => [
                'id' => 'content',
                'rows'=>30
            ],
        ]);

        CRUD::addField([
            'name' => 'image',
            'label' => 'Image',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public',
        ]);

        CRUD::addField([
            'name' => 'short_description',
            'label' => 'Short Description',
            'type' => 'textarea',
        ]);
        $this->crud->setCreateView('admin.blog.create');
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
        $this->crud->setUpdateView('admin.blog.edit');
    }

    /**
     * Override the store method to handle file uploads manually.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'short_description' => 'nullable|string',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $data['image'] = $imagePath;
        }

        $entry = CRUD::getModel()::create($data);

        \Alert::success('Blog created successfully.')->flash();

        return redirect()->back();
    }

    /**
     * Override the update method to handle file uploads manually.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'short_description' => 'nullable|string',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $data['image'] = $imagePath;

            $model = CRUD::getCurrentEntry();
            if ($model && $model->image) {
                Storage::disk('public')->delete($model->image);
            }
        }

        $model = CRUD::getCurrentEntry();
        $model->update($data);

        \Alert::success('Blog updated successfully.')->flash();

        return redirect()->back();
    }
}
