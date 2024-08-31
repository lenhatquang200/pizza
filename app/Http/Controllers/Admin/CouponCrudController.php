<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CouponRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

        CRUD::column('bannerurl')
        ->label('Banner')
        ->type('custom_html')
        ->value(function ($entry) {
            return '
                <a href="#" data-image="/storage/' . $entry->bannerurl . '" onclick="openImageModal(event)">
                    <img src="/storage/' . $entry->bannerurl . '" style="height: 60px; width: auto;" />
                </a>
            ';
        });

        CRUD::column('couponcode')->label('Code')->type('text');
//        CRUD::column('validto')->label('Valid To')->type('datetime');
//        CRUD::column('displayfrom')->label('Display From')->type('datetime');
//        CRUD::column('displayto')->label('Display To')->type('datetime');
        CRUD::column('isfeatured')->label('Featured')->type('boolean');

        Log::info('Data in list operation:', ['data' => CRUD::getEntries()]);
        Log::info('Data from CRUD:', ['data' => $this->crud->getEntries()]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation($update =false)
    {
        CRUD::setValidation(CouponRequest::class);
        $field = [
            'name' => 'url',
            'label' => 'Coupon URL (can be empty)',
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

        CRUD::addFields([
            [
                'name' => 'bannerurl',
                'label' => 'Coupon banner',
                'type' => 'upload',
                'upload' => true,
                'disk' => 'public',
                'prefix' => '',
                'attributes' => [
                    'accept' => 'image/*',
                ],
            ],

            [
                'name' => 'couponcode',
                'label' => 'Coupon Code',
                'type' => 'text',
                'attributes'=> [
                  'required' => true,
                  'oninput' => 'this.value = this.value.toUpperCase()' // Converts input to uppercase
                ]
            ],

//            [
//                'name' => 'validfrom',
//                'label' => 'Valid From',
//                'type' => 'datetime',
//            ],
//            [
//                'name' => 'validto',
//                'label' => 'Valid To',
//                'type' => 'datetime',
//            ],
//            [
//                'name' => 'displayfrom',
//                'label' => 'Display From',
//                'type' => 'datetime',
//            ],
//            [
//                'name' => 'displayto',
//                'label' => 'Display To',
//                'type' => 'datetime',
//            ],
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
        $this->setupCreateOperation(true);
    }

    public function store(CouponRequest $request)
    {
        $data = $request->all();

        // Handle featured coupon logic
        if (isset($data['isfeatured']) && $data['isfeatured']) {
            \App\Models\Coupon::where('isfeatured', true)->update(['isfeatured' => false]);
        }

        // Handle file upload for bannerurl
        if ($request->hasFile('bannerurl')) {
            $imagePath = $request->file('bannerurl')->store('uploads', 'public');
            $data['bannerurl'] = $imagePath;
        }

        CRUD::create($data);

        \Alert::success('Coupon created successfully.')->flash();

        return $this->crud->performSaveAction();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CouponRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request)
{
    $data = $request->except('bannerurl');

    $id = CRUD::getCurrentEntryId();

    if (isset($data['isfeatured']) && $data['isfeatured']) {
        \App\Models\Coupon::where('isfeatured', true)
            ->where('id', '!=', $id)
            ->update(['isfeatured' => false]);
    }

    $model = \App\Models\Coupon::find($id);

    if ($model) {
        if ($request->hasFile('bannerurl')) {
            $imagePath = $request->file('bannerurl')->store('uploads', 'public');
            $data['bannerurl'] = $imagePath;

            if ($model->bannerurl) {
                Storage::disk('public')->delete($model->bannerurl);
            }
        } else {
            $data['bannerurl'] = $model->bannerurl;
        }

        $model->update($data);

        \Alert::success('Coupon updated successfully.')->flash();
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction();
        } else {
            \Alert::error('Coupon not found.')->flash();
            return $this->crud->performSaveAction();
        }
    }
}
