<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LogRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LogCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LogCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Log::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/log');
        CRUD::setEntityNameStrings('nhật ký', 'nhật ký điểm danh');
        if(backpack_user()->role>1){
            $this->crud->denyAccess("create");
            $this->crud->denyAccess("update");
            $this->crud->denyAccess("delete");
        }
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('day')->label("Ngày/Tháng/Năm")->type("date");
        CRUD::column('time')->label("Giờ");
        CRUD::addColumn([
            'name' => 'room_id',
            'type' => 'select',
            'model'=>'App\Models\Room',
            'entity'=>"Room",
            'label'=>"Lớp"
        ]);
        CRUD::addColumn([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Học sinh",
            'type'      => 'select',
            'name'      => 'Student', // the method that defines the relationship in your Model

            // optional
            'entity'    => 'Student', // the method that defines the relationship in your Model
            'model'     => "App\Models\User", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?
        ]);
        CRUD::addColumn([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Giáo viên",
            'type'      => 'select',
            'name'      => 'Teacher', // the method that defines the relationship in your Model

            // optional
            'entity'    => 'Teacher', // the method that defines the relationship in your Model
            'model'     => "App\Models\User", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?
        ]);
        CRUD::addColumn([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Đối tác",
            'type'      => 'select',
            'name'      => 'Client', // the method that defines the relationship in your Model

            // optional
            'entity'    => 'Client', // the method that defines the relationship in your Model
            'model'     => "App\Models\User", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?
        ]);
        CRUD::column('unit');
        CRUD::column('content')->label("Nội dung");
        CRUD::column('duration');
        CRUD::column('rate_per_hour');
        CRUD::column('rate_for_class');
        CRUD::column('comment');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
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
        CRUD::setValidation(LogRequest::class);


        CRUD::field('day')->label("Ngày/Tháng/Năm");
        CRUD::field('time')->label("Giờ");
        CRUD::addField([
            'name' => 'room_id',
            'type' => 'select',
            'model'=>'App\Models\Room',
            'entity'=>"Room",
            'label'=>"Chọn phòng học",
        ]);
        CRUD::addField([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Giáo viên",
            'type'      => 'select2_multiple',
            'name'      => 'Teacher', // the method that defines the relationship in your Model

            // optional
            'entity'    => 'Teacher', // the method that defines the relationship in your Model
            'model'     => "App\Models\User", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?

            // optional
            'options'   => (function ($query) {
                return $query->where('role', 1)->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);
        CRUD::addField([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Học sinh",
            'type'      => 'select2_multiple',
            'name'      => 'Student', // the method that defines the relationship in your Model

            // optional
            'entity'    => 'Student', // the method that defines the relationship in your Model
            'model'     => "App\Models\User", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?

            // optional
            'options'   => (function ($query) {
                return $query->where('role', 2)->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);
        CRUD::addField([    // Select2Multiple = n-n relationship (with pivot table)
            'label'     => "Đối tác",
            'type'      => 'select2_multiple',
            'name'      => 'Client', // the method that defines the relationship in your Model

            // optional
            'entity'    => 'Client', // the method that defines the relationship in your Model
            'model'     => "App\Models\User", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            // 'select_all' => true, // show Select All and Clear buttons?

            // optional
            'options'   => (function ($query) {
                return $query->where('role', 3)->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);
        CRUD::field('unit');
        CRUD::field('content')->label("Nội dung");
        CRUD::field('duration');
        CRUD::field('rate_per_hour');
        CRUD::field('rate_for_class');
        CRUD::field('comment')->type("textarea")->label("Ghi chú");

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
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
}
