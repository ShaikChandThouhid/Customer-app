<!DOCTYPE html>
<html>
<head>
    <title>Customers List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
</head>
<body>
    <div class="container">
        <h2>Customers List</h2>
        <form action="{{ route('customers.index') }}" method="GET">
            <div class="form-group">
                <label for="filter_date">Filter by Date:</label>
                <input type="text" class="form-control" id="filter_date" name="filter_date">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <br>
        <a href="{{ route('customers.create') }}" class="btn btn-success">Add Customer</a>
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Date of Birth</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->first_name }}</td>
                        <td>{{ $customer->last_name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone_number }}</td>
                        <td>{{ $customer->date_of_birth }}</td>
                        <td>
                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#filter_date").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
</body>
</html>
