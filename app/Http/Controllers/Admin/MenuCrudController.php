<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Menu::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/menu');
        CRUD::setEntityNameStrings('menu', 'menus');
    }

    protected function setupListOperation()
    {
        CRUD::column('pdf_or_image')
            ->type('custom_html')
            ->label('PDF/Image')
            ->value(function ($entry) {
                if ($entry->pdf_path) {
                    return '<a href="/storage/' . $entry->pdf_path . '" target="_blank">Link PDF</a>';
                }

                if ($entry->image_path) {
                    return '<img src="/storage/' . $entry->image_path . '" style="height: 60px; width: auto;" />';
                }

                return 'No PDF or Image available';
            });
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(MenuRequest::class);

        CRUD::field('files')
        ->type('upload_multiple')
        ->upload('public')
        ->label('Upload Files (PDF or Image)')
        ->attributes([
            'accept' => 'image/*,.pdf',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'files.*' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:20480',
        ]);

        $files = $request->file('files');

        $pdfPath = null;
        $imagePath = null;

        if ($files) {
            foreach ($files as $file) {
                $fileType = $file->getClientOriginalExtension();
                $filePath = $file->store('uploads', 'public');

                if ($fileType === 'pdf') {
                    $pdfPath = $filePath;
                } else {
                    $imagePath = $filePath;
                }

                // Save a new Menu record for each file
                CRUD::create([
                    'pdf_path' => $fileType === 'pdf' ? $pdfPath : null,
                    'image_path' => $fileType !== 'pdf' ? $imagePath : null,
                ]);
            }
        }

        \Alert::success('Menu created successfully.')->flash();

        $this->crud->setSaveAction();

        return $this->crud->performSaveAction();
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'files.*' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:20480',
        ]);

        $files = $request->file('files');

        $pdfPath = null;
        $imagePath = null;

        if ($files) {
            foreach ($files as $file) {
                $fileType = $file->getClientOriginalExtension();
                $filePath = $file->store('uploads', 'public');

                if ($fileType === 'pdf') {
                    $pdfPath = $filePath;
                } else {
                    $imagePath = $filePath;
                }

                // Update the Menu record with the file paths
                CRUD::update($request->route('id'), [
                    'pdf_path' => $fileType === 'pdf' ? $pdfPath : null,
                    'image_path' => $fileType !== 'pdf' ? $imagePath : null,
                ]);
            }
        }

        \Alert::success('Menu updated successfully.')->flash();

        $this->crud->setSaveAction();

        return $this->crud->performSaveAction();
    }
}
