<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Brand</th> 
            <th>Komputer Name</th>
            <th>Spesification</th>
            <th>User</th>
            <th>Serial Number</th>
            <th>IP Address</th>
            <th>Unit</th>
            <th>Asset Status</th>
            <th>Vendor</th>
            <th>Year</th>
            <th>System Operation</th>
            <th>Office</th>
            <th>Status Join Domain</th>
            <th>kes</th>
            <th>Mouse</th>
            <th>Keyboard</th>
            <th>Monitor</th>
            <th>Contract Date</th>
            <th>Rental Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($datas as $data)
        <tr>
            <td>{{ $loop->iteration }}</td> 
            <td>{{ $data->getDeviceBrands->name }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->spesification }}</td>
            <td>{{ $data->user_name }}</td>
            <td>{{ $data->serial_number }}</td> 
            <td>{{ $data->ip_address }}</td>
            <td>{{ $data->getUnits->nama_unit ?? 'Tidak ada' }}</td>
            <td>{{ $data->ownership_status }}</td>
            <td>{{ $data->getVendor->bp_name ?? 'Tidak ada' }}</td>
            <td>{{ $data->year }}</td>
            <td>{{ $data->system_operation }}</td>
            <td>{{ $data->office }}</td>
            <td>{!! $data->status_id == 1 ? 'ya' : 'tidak' !!}</td>
            <td>{{ $data->kes }}</td>
            <td>{{ $data->mouse }}</td>
            <td>{{ $data->keyboard }}</td>
            <td>{{ $data->monitor }}</td>
            <td>{{ $data->contract_date }}</td>
            <td>{{ $data->rental_price }}</td> 
        </tr>
        @endforeach
    </tbody>
</table>
