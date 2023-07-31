<?php

namespace App\Imports;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Cow;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Shared\Date; // Import the Date class

class MyExcelImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $mobile_number = Auth::guard('web')->user()['mobile_number'];
        if($row['select_breed'] != ''){
            if(strtolower($row['select_breed'])=="ayrshire")
            {
                $breed=1;
            }
            elseif(strtolower($row['select_breed'])=="friesian")
            {
                $breed=2;
            }
            elseif(strtolower($row['select_breed'])=="guernsey")
            {
                $breed=3;
            }
            elseif(strtolower($row['select_breed'])=="holstein")
            {
                $breed=4;
            }
            elseif(strtolower($row['select_breed'])=="jersey")
            {
                $breed=5;
            }
            elseif(strtolower($row['select_breed'])=="fleckvieh")
            {
                $breed=6;
            }
            elseif(strtolower($row['select_breed'])=="boran")
            {
                $breed=7;
            }
            elseif(strtolower($row['select_breed'])=="sahiwal")
            {
                $breed=8;
            }
            elseif(strtolower($row['select_breed'])=="zebu")
            {
                $breed=9;
            }
            elseif(strtolower($row['select_breed'])=="brahman")
            {
                $breed=10;
            }
            elseif(strtolower($row['select_breed'])=="brown swiss")
            {
                $breed=11;
            }
            elseif(strtolower($row['select_breed'])=="red freshian")
            {
                $breed=12;
            }
            elseif(strtolower($row['select_breed'])=="crosses")
            {
                $breed=13;
            }
        }
        if($row['select_cow_group'] != ''){
            if(strtolower($row['select_cow_group'])=="lactating")
            {
                $cow_group=1;
            }
            elseif(strtolower($row['select_cow_group'])=="drying")
            {
                $cow_group=2;
            }
            elseif(strtolower($row['select_cow_group'])=="in calf")
            {
                $cow_group=3;
            }
            elseif(strtolower($row['select_cow_group'])=="heifer")
            {
                $cow_group=4;
            }
        }
        $date_of_birth = Date::excelToDateTimeObject($row['date_of_birth']);
        $date_of_birth = $date_of_birth->format('Y-m-d');

        // Define how to map and store the data from the Excel file to the database
        return new Cow([
            'title' => $row['cow_name'],
            'breed_id' => $breed,
            'group_id' => $cow_group,
            'mobile_number' => $mobile_number,
            'date_of_birth' => $date_of_birth,
            'calving_lactation' => $row['no_of_calvinglactation'],
            'status' => 'active'
        ]);
    }
}
