<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Contact</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Edit Contact</h2>
        <form action="{{url('edit')}}" method="Post">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="hidden" value="{{$contactDetails->id}}" name="id">
                <input type="text" class="form-control" id="name" value="{{ old('name',$contactDetails->name) }}"
                    placeholder="Enter name" name="name">
                @if($errors->has('name'))
                <div class="error">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="name">Phone:</label>
                <input type="text" class="form-control" id="phone"
                    value="{{old('phone',$contactDetails->phone_number)}}" placeholder="Enter phone" name="phone">
                @if($errors->has('phone'))
                <div class="error">{{ $errors->first('phone') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <br><a class="btn btn-info" href="{{url('/')}}">Back to Contact List </a>
    </div>
</body>

</html>