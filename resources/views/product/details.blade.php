<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .warning {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Product Details</h1>
    @if (!$canDelete)
        <p class="warning">Product kan niet worden verwijderd, datums van vandaag ligt voor einddatum levering</p>
    @endif
    <table>
        <tr>
            <th>Naam Product:</th>
            <td>{{ $product->ProductNaam }}</td>
        </tr>
        <tr>
            <th>Barcode:</th>
            <td>{{ $product->Barcode }}</td>
        </tr>
        <tr>
            <th>Bevat Gluten:</th>
            <td>{{ $product->BevatGluten }}</td>
        </tr>
        <tr>
            <th>Bevat Gelatine:</th>
            <td>{{ $product->BevatGelatine }}</td>
        </tr>
        <tr>
            <th>Bevat AZO-Kleurstof:</th>
            <td>{{ $product->BevatAZOKleurstof }}</td>
        </tr>
        <tr>
            <th>Bevat Lactose:</th>
            <td>{{ $product->BevatLactose }}</td>
        </tr>
        <tr>
            <th>Bevat Soja:</th>
            <td>{{ $product->BevatSoja }}</td>
        </tr>
    </table>
    <div style="text-align: center;">
        @if ($canDelete)
            <a href="{{ route('product.delete', ['id' => request()->route('id')]) }}" 
               onclick="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">
                <button type="button">Verwijder</button>
            </a>
        @else
            <button type="button" disabled style="opacity: 0.5;">Verwijder</button>
        @endif
    </div>
</body>
</html>
