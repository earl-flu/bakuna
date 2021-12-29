<table>
    <thead>
    <tr>
        <th>CATEGORY</th>
        <th>UNIQUE_PERSON_ID</th>
        <th>PWD</th>
        <th>Indigenous Member</th>
        <th>LAST_NAME</th>
        <th>FIRST_NAME</th>
        <th>MIDDLE_NAME</th>

        <th>SUFIX</th>
        <th>CONTACT_NO</th>
        <th>REGION</th>
        <th>PROVINCE</th>
        <th>MUNI_CITY</th>
        <th>BARANGAY</th>
        <th>SEX</th>
        <th>BIRTHDATE</th>
        <th>DEFERRAL</th>
        <th>REASON_FOR_DEFERRAL</th>
        <th>VACCINATION_DATE</th>
        <th>VACCINE_MANUFACTURER_NAME</th>
        <th>BATCH_NUMBER</th>
        <th>LOT_NO</th>
        <th>BAKUNA_CENTER_CBCR_ID</th>
        <th>VACCINATOR_NAME</th>
        <th>1ST_DOSE</th>
        <th>2ND_DOSE</th>
        <th>Adverse Event</th>
        <th>Adverse Event Condition</th>


    </tr>
    </thead>
    <tbody>
    @foreach($bakunas as $bakuna)
        <tr>
            <td>{{ $bakuna->category }}</td>
            <td>{{ $bakuna->govt_id_number }}</td>
            <td>{{ $bakuna->pwd ? 'Y' : 'N' }}</td>
            <td>{{ $bakuna->indigenous_member ? 'Y' : 'N' }}</td>
            <td style="text-transform:uppercase">{{ $bakuna->vaccinee->last_name }}</td>
            <td style="text-transform:uppercase">{{ $bakuna->vaccinee->first_name }}</td>
            <td style="text-transform:uppercase">{{ $bakuna->vaccinee->middle_name }}</td>

            <td>{{ $bakuna->vaccinee->suffix }}</td>
            <td>{{ $bakuna->vaccinee->mobile_number }}</td>
            <td>{{ $bakuna->vaccinee->region }}</td>
            <td>{{ $bakuna->vaccinee->province }}</td>
            <td>{{ $bakuna->vaccinee->municipality }}</td>
            <td>{{ $bakuna->vaccinee->barangay }}</td>
            <td>{{ $bakuna->vaccinee->sex }}</td>
            <td>{{ $bakuna->vaccinee->birthdate }}</td>
            <td>{{ $bakuna->is_deferred ? 'Y' : 'N' }}</td>
            <td>{{ $bakuna->deferral_reason }}</td>
            <td>{{ $bakuna->vaccination_date }}</td>
            <td>{{ $bakuna->manufacturer_name }}</td>
            <td>{{ $bakuna->batch_number }}</td>
            <td>{{ $bakuna->lot_number }}</td>
            <td>{{ $bakuna->bakuna_center_cbcr_id }}</td>
            <td>{{ $bakuna->vaccinator_name == 1 ? 'TEJADA, MILAGROS E' : 'BAGAYAN, CYNTHIA DC' }}</td>
            <td>{{ $bakuna->vaccine_shot == 1 ? 'Y': 'N' }}</td>
            <td>{{ $bakuna->vaccine_shot == 2 ? 'Y' : 'N' }}</td>
            <td>{{ $bakuna->is_adverse_event ? 'Y' : 'N' }}</td>
            <td>{{ $bakuna->adverse_event_condition }}</td>
        </tr>
    @endforeach
    </tbody>
</table>