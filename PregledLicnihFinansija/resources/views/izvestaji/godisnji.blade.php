<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Godišnji izveštaj</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .summary { margin-top: 20px; }
        .pozitivan { color: green; }
        .negativan { color: red; }
    </style>
</head>
<body>
    <h1>Godišnji izveštaj - {{ $godina }}</h1>
    <table>
        <thead>
            <tr>
                <th>Mesec</th>
                <th>Ukupni prihodi</th>
                <th>Ukupni troškovi</th>
                <th>Bilans</th>
            </tr>
        </thead>
        <tbody>
            @foreach($meseci as $m)
            <tr>
                <td>{{ $m['mesec'] }}</td>
                <td>{{ $m['ukupni_prihodi'] }}</td>
                <td>{{ $m['ukupni_troskovi'] }}</td>
                <td class="{{ $m['bilans'] >= 0 ? 'pozitivan' : 'negativan' }}">
                    {{ $m['bilans'] }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="summary">
        <p><strong>Ukupni prihodi za godinu:</strong> {{ $ukupni_prihodi }}</p>
        <p><strong>Ukupni troškovi za godinu:</strong> {{ $ukupni_troskovi }}</p>
        <p><strong>Godišnji bilans:</strong> {{ $bilans }}</p>
    </div>
</body>
</html>