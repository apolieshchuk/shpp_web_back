<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>shpp-library-admin</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="library Sh++">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" crossorigin="anonymous"/>
</head>
<body style="padding: 20px" data-gr-c-s-loaded="true" class="">
    <script>
        function logout() {
            $.ajax({
                type: "GET",
                url: "/admin",
                async: false,
                username: "logmeout",
                password: "123456",
                headers: { "Authorization": "Basic xxx" }
            })
                .done(function(){
                })
                .fail(function(){
                    window.location = "/";
                });

            return false;
        }
    </script>
    <div style="text-align: end; margin-bottom: 20px;" ><a href="#" onclick="logout()">Logout</a></div>

    <div style="display: flex">
        <table style="width: 700px"
               id="table"
               class="table table-striped table-bordered table-hover table-sm"
               data-toggle="table"
               data-search="true"
               data-show-columns="true"
               data-pagination="true"
               data-page-size="5"
        >
            <thead>
            <tr>
                <th data-field="Book" data-filter-control="input" data-sortable="true" >Book</th>
                <th data-field="Authors" data-filter-control="input" data-sortable="true">Authors</th>
                <th data-field="Year" data-filter-control="input" data-sortable="true">Year</th>
                <th data-field="Actions" data-filter-control="input" data-sortable="true">Actions</th>
                <th data-field="Clicks" data-filter-control="input" data-sortable="true">Clicks</th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->book }}</td>
                <td>{{ $book->authors }}</td>
                <td>{{ $book->year }}</td>

                <td>
{{--                    <a href="/admin/deleteBook/?id={{ $book->id }}"--}}
{{--                    onclick="return confirm('Delete book?')"--}}
{{--                    >delete</a>--}}
                    <form action="/admin/{{ $book->id }}" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" onclick="return confirm('Delete book?')">
                            delete
                        </button>
                    </form>
                </td>
                <td>{{ $book->clicks }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div style="margin-left: 20px; width: 5px; background-color: #007bff"></div>
        <form style="margin-left: 20px; display: flex; flex-direction: column" method="POST" action="/admin" enctype="multipart/form-data">
            @csrf
            <p style='align-self: center'> Add new Book </p>
            <div style="display: flex">
                <div style="margin-right: 20px">
                    <div class="form-group">
                        <label for="bookName">Book name</label>
                        <input type="text"
                               class="form-control"
                               name="book"
                               id="bookName"
                               placeholder="Book name"
                               required
                        >
                    </div>
                    <div class="form-group">
                        <label for="bookYear">Publish year</label>
                        <input type="text"
                               class="form-control"
                               name="year"
                               id="bookYear"
                               placeholder="Publish year"
                               required
                        >
                    </div>
                    <div class="form-group">
                        <label for="bookImg">Book preview</label>
                        <input type="file" name='image' class="form-control-file" id="bookImg">
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="author1">Author 1</label>
                        <input type="text"
                               class="form-control"
                               name="author1"
                               id="author1"
                               placeholder="Author 1"
                               required
                        >
                    </div>
                    <div class="form-group">
                        <label for="author2">Author 2</label>
                        <input type="text" class="form-control" name="author2" id="author2" placeholder="Author 2">
                    </div>
                    <div class="form-group">
                        <label for="author3">Author 3</label>
                        <input type="text" class="form-control" name="author3" id="author3" placeholder="Author 3">
                    </div>
                </div>
            </div>
            <button style="width: 300px; align-self: center" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    $(function() {
        $('#table').bootstrapTable()
    })
</script>
</html>





