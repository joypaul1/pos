<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class MyController extends Controller
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
        // return DB::getSchemaBuilder()->getColumnListing('products');
       return view('backend.admin.product.import');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import()
    {
        try {
            Excel::import(new UsersImport,request()->file('file'));
        } catch (\Exception $ex) {
            // throw $th;
            dd($ex->getMessage());
        }

        return back()->with('success','Well done! successfully inserted');
    }
}
