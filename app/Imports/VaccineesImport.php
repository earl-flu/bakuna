<?php

namespace App\Imports;

use App\Models\Vaccinee;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VaccineesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $pwd = $row['person_with_disability_pwd'] == 'YES' ? 1 : 0;
        $indigenous_member = $row['indigenous_member'] == 'YES' ? 1 : 0;
        $suffix = $row['suffix'] == 'NOT APPLICABLE' ? null : $row['suffix'];
        $municipality = $this->getMunicipalityValue($row['municipality']);
        $sex = $row['sex'] == 'MALE' ? 'M' : 'F';

        return new Vaccinee([
            'uuid' => Str::uuid(),
            'pwd' => $pwd,
            'indigenous_member' => $indigenous_member,
            'last_name' => $row['last_name'],
            'first_name' => $row['first_name'],
            'middle_name' => $row['middle_name'],
            'suffix' => $suffix,
            'mobile_number' => $row['mobile_number'],
            'region' => 'REGION V (BICOL REGION)',
            'province' => '052000000Catanduanes',
            'municipality' => $municipality,
            'barangay' => $row['barangay'],
            'sex' => $sex,
            'birthdate' => Carbon::parse($row['birthdate']),
            'occupation' => $row['occupation'],
            'vaccination_date' => Carbon::parse($row['vaccination_date']),
        ]);

        // $pwd = $row[7] == 'YES' ? 1 : 0;
        // $indigenous_member = $row[8] == 'YES' ? 1 : 0;
        // $suffix = $row[4] == 'NOT APPLICABLE' ? null : $row[4];
        // $municipality = $this->getMunicipalityValue($row[9]);
        // $sex = $row[6] == 'MALE' ? 'M' : 'F';

        // return new Vaccinee([
        //     'uuid' => Str::uuid(),
        //     'pwd' => $pwd,
        //     'indigenous_member' => $indigenous_member,
        //     'last_name' => $row[1],
        //     'first_name' => $row[2],
        //     'middle_name' => $row[3],
        //     'suffix' => $suffix,
        //     'mobile_number' => $row[12],
        //     'region' => 'REGION V (BICOL REGION)',
        //     'province' => '052000000Catanduanes',
        //     'municipality' => $municipality,
        //     'barangay' => $row[10],
        //     'sex' => $sex,
        //     'birthdate' => Carbon::parse($row[5]),
        //     'vaccination_date' => Carbon::parse($row[13]),
        //     'occupation' => $row[11]
        // ]);
    }

    private function getMunicipalityValue($muni)
    {
        return Vaccinee::MUNICIPALITIES[$muni];
    }
}
