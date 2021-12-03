<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clearance cert</title>
</head>
<style>
    .wrapper {
        max-width: 900px;
        margin: 0 auto;
    }

    center img {
        width: 100px
    }

    h3 {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-height: 300px;
        margin-top: 30px;
    }

    table tr {
        line-height: 40px;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    table td,
    th {
        text-align: left;
        padding-left: 10px;
    }

    .clearance-details {
        margin-top: 20px;
    }
</style>

<body>

    <div class="wrapper">
        <center><img
                src="data:image/png;base64,<?php echo base64_encode(file_get_contents("C:/xampp\htdocs\online_clearance/public/images/meru.png"))?>"
                alt=""></center>
        <h3>{{Str::ucfirst(Auth::user()->name)}} Clearance status</h3>
        <h4>Final clearance : <strong>Not Cleared</strong></h4>
        <div class="clearance-details">
            <table>
                <thead>
                    <tr>
                        <th>Station</th>
                        <th>Application date</th>
                        <th>Clearance status</th>
                    </tr>
                </thead>
                <tr>
                    <td>Academic</td>
                    <td>{{ $stations->created_at }}</td>
                    <td>{{ $stations->academic ? "Cleared" :"Not cleared"}}</td>
                </tr>
                <tr>
                    <td>Finance</td>
                    <td>{{ $stations->created_at }}</td>
                    <td>{{ $stations->finance ? "Cleared" :"Not cleared"}}</td>
                </tr>
                <tr>
                    <td>Library</td>
                    <td>{{ $stations->created_at }}</td>
                    <td>{{ $stations->library ? "Cleared" :"Not cleared"}}</td>
                </tr>
                <tr>
                    <td>Hostel</td>
                    <td>{{ $stations->created_at }}</td>
                    <td>{{ $stations->hostel ? "Cleared" :"Not cleared"}}</td>
                </tr>

            </table>
        </div>

    </div>

</body>

</html>