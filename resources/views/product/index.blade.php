<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productpagina</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .search-container {
            margin-bottom: 20px;
        }
        .success-message {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .error-message {
            background-color: #f44336;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Overzicht producten uit het assortiment</h1>
    
    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="error-message">
            {{ session('error') }}
        </div>
    @endif

    <div class="search-container">
        <form method="GET" action="{{ route('product.index') }}">
            <label for="startdatum">Startdatum:</label>
            <input type="date" id="startdatum" name="startdatum" value="{{ request('startdatum') }}">
            <label for="einddatum">Einddatum:</label>
            <input type="date" id="einddatum" name="einddatum" value="{{ request('einddatum') }}">
            <button type="submit">Zoeken</button>
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>Naam Leverancier</th>
                <th>Contactpersoon</th>
                <th>Stad</th>
                <th>Productnaam</th>
                <th>Einddatum Levering</th>
                <th>Verwijder</th>
            </tr>
        </thead>
        <tbody>
            @if ($products->isEmpty())
                <tr>
                    <td colspan="6" style="text-align: center;">Er zijn geen leveringen geweest van producten in deze periode.</td>
                </tr>
            @else
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->LeverancierNaam }}</td>
                        <td>{{ $product->ContactPersoon }}</td>
                        <td>{{ $product->Stad }}</td>
                        <td>{{ $product->ProductNaam }}</td>
                        <td>{{ $product->EinddatumLevering }}</td>
                        <td>
                            <a href="{{ route('product.details', ['id' => $product->ProductId]) }}">
                                <button type="button">❌</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>
