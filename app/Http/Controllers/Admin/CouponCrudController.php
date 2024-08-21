<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CouponRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Class CouponCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CouponCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Coupon::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/coupon');
        CRUD::setEntityNameStrings('coupon', 'coupons');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */

    protected function setupListOperation()
    {
        Log::info('Setting up list operation for coupons');

        CRUD::column('bannerurl')->label('Banner URL')->type('text');
        CRUD::column('validfrom')->label('Valid From')->type('datetime');
        CRUD::column('validto')->label('Valid To')->type('datetime');
        CRUD::column('displayfrom')->label('Display From')->type('datetime');
        CRUD::column('displayto')->label('Display To')->type('datetime');
        CRUD::column('isfeatured')->label('Featured')->type('boolean');


         // Using dd() to check the data
        // $entries = CRUD::getEntries();
        // dd($entries);  // Dump and die the entries

        // // Alternatively, if CRUD::getEntries() does not work, you can directly dump data from the model
        // $data = \App\Models\Coupon::all();  // Assuming Coupon is your model
        // dd($data);  // Dump and die the data
        Log::info('Data in list operation:', ['data' => CRUD::getEntries()]);
        Log::info('Data from CRUD:', ['data' => $this->crud->getEntries()]);

    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CouponRequest::class);
        CRUD::addFields([
            [
                'name' => 'bannerurl',
                'label' => 'Banner URL',
                'type' => 'upload',
                'upload' => true,
                'disk' => 'public',
                'prefix' => 'uploads/',
            ],

            [
                'name' => 'validfrom',
                'label' => 'Valid From',
                'type' => 'datetime',
            ],
            [
                'name' => 'validto',
                'label' => 'Valid To',
                'type' => 'datetime',
            ],
            [
                'name' => 'displayfrom',
                'label' => 'Display From',
                'type' => 'datetime',
            ],
            [
                'name' => 'displayto',
                'label' => 'Display To',
                'type' => 'datetime',
            ],
            [
                'name' => 'isfeatured',
                'label' => 'Featured',
                'type' => 'boolean',
            ],
        ]);
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
        'bannerurl' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->except('bannerurl');

    if ($request->hasFile('bannerurl')) {
        $imagePath = $request->file('bannerurl')->store('uploads', 'public');
        $data['bannerurl'] = $imagePath;
    }

    CRUD::create($data);

    \Alert::success('Coupon created successfully.')->flash();

    return redirect()->back();
}

public function update(\Illuminate\Http\Request $request)
{
    $this->validate($request, [
        'bannerurl' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->except('bannerurl');

    if ($request->hasFile('bannerurl')) {
        $imagePath = $request->file('bannerurl')->store('uploads', 'public');
        $data['bannerurl'] = $imagePath;

        $model = CRUD::getCurrentEntry();
        if ($model && $model->bannerurl) {
            Storage::disk('public')->delete($model->bannerurl);
        }
    }

    $model = CRUD::getCurrentEntry();
    $model->update($data);

    \Alert::success('Coupon updated successfully.')->flash();

    return redirect()->back();
    }
}
