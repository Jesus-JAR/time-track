<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ public_path('css/app.css') }}" type="text/css">
</head>
<body>
<h2 class="text-4xl text-red">Record List</h2>
<table class="table w-full">
    <thead class="bg-sea-700">
    <tr>
        <th class="px-4 py-2">
            <div class="flex bg-green-400 items-center">
                Hour in
            </div>
        </th>
        <th class="px-4 py-2">
            <div class="flex items-center">
                Hour out
            </div>
        </th>
        <th class="px-4 py-2">
            <div class="flex items-center">
                Work hours
            </div>
        </th>
        <th class="px-4 py-2">
            <div class="flex items-center">
                Created
            </div>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($records as $record)
        <tr>
            <td class="border px-4 py-2 w-20 text-center">{{ $record->hour_in }}</td>
            <td class="border px-4 py-2 text-center">{{ $record->hour_out }}</td>
            <td class="border px-4 py-2 w-48 text-center">{{ $record->total_day }}</td>
            <td class="border px-4 py-2 text-center">{{ \Carbon\Carbon::parse($record->created_at)->format('Y/m/d')}}</td>
            @endforeach
        </tr>
    </tbody>
</table>

</body>
</html>
