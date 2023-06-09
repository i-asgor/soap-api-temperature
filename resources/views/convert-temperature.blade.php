<!DOCTYPE html>
<html>
<head>
    <title>Convert Temperature</title>
</head>
<body>
    <h1>Convert Temperature</h1>
    
    <form action="{{ route('convert-temperature') }}" method="GET">
        <label for="celsius">Celsius:</label>
        <input type="text" id="celsius" name="celsius">
        <button type="submit">Convert</button>
    </form>
    
    @isset($fahrenheit)
        <p>Fahrenheit: {{ $fahrenheit }}</p>
    @endisset

    @foreach($fahrenheitDatas as $fahrenheitData)
    <ul>
        <li> Celcius: {{ $fahrenheitData->celcius}} and Fahrenheit: {{ $fahrenheitData->fahrenheit}}   --- {{$fahrenheitData->created_at}}</li>
    </ul>

    @endforeach
</body>
</html>
