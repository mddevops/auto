<!DOCTYPE html>
<html lang="en">

<head>
    <title>Тестовое задание (Autodrive)</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container" style="margin-top: 50px;">
        <h4 style="text-align: center;">Тестовое задание</h4>


        <form action="{{ route('upload') }}" id="frm-create-course" method="post">
            {{csrf_field()}}
            @if(Session::has('message'))
                <div class="alert alert-success">
                    <strong>{{ Session::get('message') }}</strong>
                </div>
            @endif
            @if (count($errors))
                <div class="form-group">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <div class="form-group">
                <label for="file">Select XML File:</label>
                <input type="file" class="form-control" required id="file" name="file">
            </div>

            <button type="submit" class="btn btn-primary" id="submit-post">Submit</button>
        </form>
    </div>
    <div class="container mt-4">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">mark</th>
                    <th scope="col">model</th>
                    <th scope="col">generation</th>
                    <th scope="col">year</th>
                    <th scope="col">run</th>
                    <th scope="col">color</th>
                    <th scope="col">body-type</th>
                    <th scope="col">engine-type</th>
                    <th scope="col">transmission</th>
                    <th scope="col">gear-type</th>
                    <th scope="col">generation_id</th>
                </tr>
                </thead>
                <tbody>
                @foreach($xml as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->mark}}</td>
                        <td>{{$data->model}}</td>
                        <td>{{$data->generation}}</td>
                        <td>{{$data->year}}</td>
                        <td>{{$data->run}}</td>
                        <td>{{$data->color}}</td>
                        <td>{{$data->body_type}}</td>
                        <td>{{$data->engine_type}}</td>
                        <td>{{$data->transmission}}</td>
                        <td>{{$data->gear_type}}</td>
                        <td>{{$data->generation_id}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
