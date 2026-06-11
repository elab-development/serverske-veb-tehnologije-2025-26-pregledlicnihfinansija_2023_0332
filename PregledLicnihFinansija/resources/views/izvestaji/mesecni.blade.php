<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mesečni izveštaj</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .summary { margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Mesečni izveštaj - {{ $mesec }}/{{ $godina }}</h1>
    <table>
        <thead>
            <tr>
                <th>Datum</th>
                <th>Kategorija</th>
                <th>Tip</th>
                <th>Iznos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transakcije as $t)
            <tr>
                <td>{{ $t->datum }}</td>
                <td>{{ $t->kategorija->naziv }}</td>
                <td>{{ $t->kategorija->tip }}</td>
                <td>{{ $t->kolicina }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="summary">
        <p><strong>Ukupni prihodi:</strong> {{ $ukupni_prihodi }}</p>
        <p><strong>Ukupni troškovi:</strong> {{ $ukupni_troskovi }}</p>
        <p><strong>Bilans:</strong> {{ $bilans }}</p>
    </div>
</body>
</html>