<!DOCTYPE html> 
<head>
    <title>Export PDF</title> 
</head>
<style>
    .table1 {
        font-family: sans-serif;
        color: #444;
        border-collapse: collapse; 
        border: 1px solid #f2f5f7;
        margin: 0 auto;
        font-size: 12px;
    }
    
    .table1 tr th{
        background: #35A9DB;
        color: #fff;
        font-weight: normal;
    }
    
    .table1, th, td {
        padding: 8px 20px;
        text-align: center;
    }
    
    .table1 tr:hover {
        background-color: #f5f5f5;
    }
    
    .table1 tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table1 {
        width: 100%;
        border-collapse: collapse;
    }

    .table1 th, .table1 td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    /* Set column widths as a percentage */
    .table1 th:nth-child(1),
    .table1 td:nth-child(1) {
        width: 5%;
    }

    .table1 th:nth-child(2),
    .table1 td:nth-child(2) {
        width: 20%;
    }

    .table1 th:nth-child(3),
    .table1 td:nth-child(3) {
        width: 10%;
    }

    .table1 th:nth-child(4),
    .table1 td:nth-child(4) {
        width: 15%;
    }

    .table1 th:nth-child(5),
    .table1 td:nth-child(5) {
        width: 20%;
    }

    .table1 th:nth-child(6),
    .table1 td:nth-child(6) {
        width: 20%;
    }

    .table1 th:nth-child(7),
    .table1 td:nth-child(7) {
        width: 10%;
    }

    /* Enable word-wrap for content inside cells */
    .table1 td, .table1 th {
        word-wrap: break-word;
    }
    
</style>
<body>
    
    <table class="table1" width="80%">
        
        <thead>
            <tr>
                <th>No</th> 
                <th>Laptop Name</th> 
                <th>User</th> 
                <th>Unit</th>
                <th>Status Asset</th>
                <th>Vendor</th>
                <th>Year</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results['results'] as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>  
                <td>{{ $data->name }}</td> 
                <td>{{ $data->user_name }}</td> 
                <td>{{ $data->nama_unit ?? 'Tidak ada' }}</td>
                <td>{{ $data->ownership_status }}</td>
                <td>{{ $data->vendor }}</td>
                <td>{{ $data->year }}</td>
            </tr>
            @endforeach
        </tbody>
        
    </table>	 
</body>
</html>