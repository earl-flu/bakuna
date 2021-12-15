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
    @foreach($vaccinees as $vacci)
        <tr>
            <td>{{ $vacci->category }}</td>
            <td>{{ $vacci->govt_id_number }}</td>
            <td>{{ $vacci->pwd ? 'Y' : 'N' }}</td>
            <td>{{ $vacci->indigenous_member ? 'Y' : 'N' }}</td>
            <td style="text-transform:uppercase">{{ $vacci->last_name }}</td>
            <td style="text-transform:uppercase">{{ $vacci->first_name }}</td>
            <td style="text-transform:uppercase">{{ $vacci->middle_name }}</td>

            <td>{{ $vacci->suffix }}</td>
            <td>{{ $vacci->mobile_number }}</td>
            <td>{{ $vacci->region }}</td>
            <td>{{ $vacci->province }}</td>
            <td>{{ $vacci->municipality }}</td>
            <td>{{ $vacci->barangay }}</td>
            <td>{{ $vacci->sex }}</td>
            <td>{{ $vacci->birthdate }}</td>
            <td>{{ $vacci->deferral ? 'Y' : 'N' }}</td>
            <td>{{ $vacci->deferral_reason }}</td>
            <td>{{ $vacci->vaccination_date }}</td>
            <td>{{ $vacci->vaccine_name }}</td>
            <td>{{ $vacci->batch_number }}</td>
            <td>{{ $vacci->lot_number }}</td>
            <td>{{ $vacci->bakuna_center_cbcr_id }}</td>
            <td>{{ $vacci->vaccinator_name }}</td>
            <td>{{ $vacci->vaccine_shot == 1 ? 'Y': 'N' }}</td>
            <td>{{ $vacci->vaccine_shot == 2 ? 'Y' : 'N' }}</td>
            <td>{{ $vacci->adverse_event ? 'Y' : 'N' }}</td>
            <td>{{ $vacci->adverse_event_condition }}</td>
        </tr>
    @endforeach
    </tbody>
</table>