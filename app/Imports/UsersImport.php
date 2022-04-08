<?php

namespace App\Imports;

use App\Model\Product;
use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            'name'     => $row['name'] ,
            'pid'     => $row['parts_id']??null,
            'pname'     => $row['parts_name']??null,
            'pmname'     => $row['parts_model_name']??null,
            'sheif_no'     => $row['sheif_no']??null,
            'model_Of_vehicle'     => $row['model_of_vehicle']??null,
            'class_Of_vehicle'     => $row['class_of_vehicle']??null,
            'chasiss_no'     => $row['chasiss_no'] ??null,
            'engine_no'     => $row['engine_no']??null,
            'key_no'     => $row['key_no']??null,
            'none_of_cylineder_with_cc'     => $row['none_of_cylineder_with_cc'],
            'colour'     => $row['colour']??null,
            'year_of_manufacture'     => $row['year_of_manufacture']??null,
            'hourse_power'     => $row['hourse_power']??null,
            'laden_weight'     => $row['laden_weight']??null,
            'wheel_base'     => $row['wheel_base']??null,
            'seating_capacity'     => $row['seating_capacity']??null,
            'makers_Name'     => $row['makers_Name']??null,
            'supplier_id'     => $row['supplier_id']??null,
            'category_id'     => $row['category_id']??null,
            'unit_id'     => $row['unit_id']??null,

        ]);
    }
}
