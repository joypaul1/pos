<?php

namespace App\Exports;

use App\Model\Product;
use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection,  WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::get([
            'name', 'pid', 'pname', 'pmname',
            'sheif_no', 'model_Of_vehicle',
            'class_Of_vehicle', 'chasiss_no', 'engine_no', 'key_no', 'none_of_cylineder_with_cc',
            'colour', 'year_of_manufacture', 'hourse_power', 'laden_weight', 'wheel_base', 'seating_capacity',
            'makers_Name','supplier_id', 'category_id', 'unit_id'
        ]);
    }

    public function headings(): array
    {
        return  [
            'name', 'parts_id', 'parts_name', 'parts_model_name', 'sheif_no', 'model_Of_vehicle', 'class_Of_vehicle',
            'chasiss_no', 'engine_no', 'key_no', 'none_of_cylineder_with_cc', 'colour',
            'year_of_manufacture', 'hourse_power', 'laden_weight', 'wheel_base', 'seating_capacity',
            'makers_Name', 'supplier_id', 'category_id', 'unit_id'
        ];
    }
}
