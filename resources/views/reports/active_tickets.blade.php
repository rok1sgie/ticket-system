<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Aktyvių bilietų ataskaita</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
<h1>Aktyvių problemų ataskaita</h1>
<p>Ataskaitos data: {{ now()->format('Y-m-d H:i') }}</p>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Pavadinimas</th>
        <th>Kategorija</th>
        <th>Savininkas</th>
        <th>Būsena</th>
        <th>Sukurta</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tickets as $ticket)
        <tr>
            <td>{{ $ticket->id }}</td>
            <td>{{ $ticket->title }}</td>
            <td>{{ $ticket->category->name }}</td>
            <td>{{ $ticket->user->name }}</td>
            <td>{{ $ticket->statusLabel() }}</td>
            <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
