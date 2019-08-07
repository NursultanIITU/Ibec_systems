<!doctype html>
<html lang="en">
<head>
        <title>History</title>
        <script type="text/javascript" src="public/assets/js/jquery-3.4.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h1 align="center">History Table</h1>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="history_table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Action</th>
                <th scope="col">Zagon ID</th>
                <th scope="col">Ovechka ID</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<script>

    $(document).ready(function () {
        $('#history_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('history') }}",
            "columns":[
                { "data": "id" },
                { "data": "name" },
                { "data": "zagon_id" },
                { "data": "ovechki_id" },
                { "data": "created_at" }
            ]
        });
    });
</script>
</body>
</html>