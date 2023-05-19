<html>
<head>
<meta charset="utf-8" />
</head>
<body>
<table>
    <thead>
        <td>path</td>
        <td>link</td>
        <td>count</td>
    </thead>
    <tbody>
@foreach($items as $item)
    <tr>
        <td>{{ $item[0] }}</td>
        <td>{{ config::get('web.website.url') }}/{{ rawurldecode($item[0]) }}</td>
        <td>{{ $item[1] }}</td>
    </tr>
@endforeach
</tbody>
</table>
</body>
</html>
