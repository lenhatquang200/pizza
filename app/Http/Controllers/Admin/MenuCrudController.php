<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
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
        ->limit(50)
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
            ->label('Upload File (PDF or Image)');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            'files[]' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:20480',
        ]);

        //dd($request->hasFile('files'),$request->files);

        $file = $request->file('files');

        $pdfPath = null;
        $imagePath = null;

        if ($file) {
            $fileType = $file->getClientOriginalExtension();
            $filePath = $file->store('uploads', 'public');

            if ($fileType === 'pdf') {
                $pdfPath = $filePath;
            } else {
                $imagePath = $filePath;
            }
        }

        $data = [
            'pdf_path' => $pdfPath,
            'image_path' => $imagePath,
        ];

        CRUD::create($data);

        \Alert::success('Menu created successfully.')->flash();

        return redirect()->back();
    }

    public function update(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            'files' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:20480',
        ]);

        $data = $request->except(['files']);

        // Get the uploaded file
        $file = $request->file('files');

        // Initialize variables to store paths
        $pdfPath = null;
        $imagePath = null;

        // Check if a file was uploaded
        if ($file) {
            $fileType = $file->getClientOriginalExtension();
            $filePath = $file->store('uploads', 'public');

            // Separate PDFs and images
            if ($fileType === 'pdf') {
                $pdfPath = $filePath;
            } else {
                $imagePath = $filePath;
            }
        }

        // Update the record with the file paths
        $data['pdf_path'] = $pdfPath;
        $data['image_path'] = $imagePath;

        CRUD::update($data);

        // Flash success message to the user
        \Alert::success('Menu updated successfully.')->flash();

        return redirect()->back();
    }
}
