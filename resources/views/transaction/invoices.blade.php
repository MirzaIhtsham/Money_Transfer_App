<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $transaction->id }}</title>
</head>
<body>
    <h1>Invoice #{{ $transaction->id }}</h1>
    <p><strong>Sender:</strong> {{ $transaction->sender->name }}</p>
    <p><strong>Receiver:</strong> {{ $transaction->receiver->name }}</p>
    <p><strong>Amount:</strong> ${{ number_format($transaction->amount, 2) }}</p>
    <p><strong>Date:</strong> {{ $transaction->created_at->format('d/m/Y') }}</p>
    <p><strong>Status:</strong> {{ ucfirst($transaction->status) }}</p>
</body>
</html>
