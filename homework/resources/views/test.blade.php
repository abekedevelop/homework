<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<select name="" id="">
    <option value="0" selected></option>
    @foreach($cities as $city)
        <option value="$city->id">{{ $city->city_name_ru }}</option>
    @endforeach
</select>
</body>
</html>