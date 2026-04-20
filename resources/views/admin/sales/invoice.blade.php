<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Factura {{ $sale->invoice_number }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #003229; padding-bottom: 10px; }
        .header h1 { color: #003229; margin: 0; }
        .info-section { margin-bottom: 20px; }
        .info-grid { width: 100%; border-collapse: collapse; }
        .info-grid td { vertical-align: top; width: 50%; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th { background-color: #f5f3ee; text-align: left; padding: 10px; border: 1px solid #ddd; }
        .table td { padding: 10px; border: 1px solid #ddd; }
        .totals { margin-top: 20px; text-align: right; }
        .totals p { margin: 5px 0; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #777; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Jessica Joyería</h1>
        <p>Comprobante de Adquisición Privada</p>
    </div>

    <table class="info-grid">
        <tr>
            <td>
                <strong>Factura:</strong> {{ $sale->invoice_number }}<br>
                <strong>Fecha:</strong> {{ $sale->sale_date->format('d/m/Y H:i') }}<br>
                <strong>Estado:</strong> {{ ucfirst($sale->status) }}
            </td>
            <td style="text-align: right;">
                <strong>Cliente:</strong> {{ $sale->customer_name }}<br>
                <strong>Documento:</strong> {{ $sale->customer_document }}<br>
                <strong>Email:</strong> {{ $sale->customer_email }}
            </td>
        </tr>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th>Producto / SKU</th>
                <th>Cantidad</th>
                <th>Precio Unit.</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->items as $item)
            <tr>
                <td>
                    <strong>{{ $item->product->name }}</strong><br>
                    <small>SKU: {{ $item->product->sku }}</small>
                </td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->unit_price, 2) }}</td>
                <td>${{ number_format($item->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <p><strong>Subtotal:</strong> ${{ number_format($sale->total_amount / 1.19, 2) }}</p>
        <p><strong>IVA (19%):</strong> ${{ number_format($sale->total_amount - ($sale->total_amount / 1.19), 2) }}</p>
        <p style="font-size: 1.2em; color: #003229;"><strong>Inversión Total:</strong> ${{ number_format($sale->total_amount, 2) }}</p>
    </div>

    @if($sale->notes)
    <div class="info-section">
        <strong>Notas:</strong><br>
        <p style="font-style: italic;">{{ $sale->notes }}</p>
    </div>
    @endif

    <div class="footer">
        <p>Atendido por: {{ $sale->user->name }}</p>
        <p>© {{ date('Y') }} Jessica Joyería - Sistema de Gestión de Inventario</p>
    </div>
</body>
</html>
