<!DOCTYPE html>
<html>

<head>
    <title>Invoice Subscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .item-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .item-details {
            flex: 1;
            margin-left: 20px;
        }

        .status {
            padding: 5px 10px;
            border-radius: 5px;
            color: #fff;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .active {
            background-color: #4caf50;
        }

        .pending {
            background-color: #ff9800;
        }

        p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        .thank-you {
            margin-top: 30px;
            text-align: center;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Checkout Details</h1>
        <div class="item-container">
            <div>
                <p>Total Amount:</p>
                <h3>Rp {{ $transactions->total_amount }}</h3>
            </div>
            <div>
                <p>Checkout Date:</p>
                <h3>{{ $transactions->created_at }}</h3>
            </div>
        </div>
        <div class="item-details">
            <div>
                @if ($transactions->is_paid)
                    <span class="status active">Active</span>
                @else
                    <span class="status pending">Pending</span>
                @endif
            </div>
            <div>
                <p>Subscription Start Date:</p>
                <h3>{{ $transactions->subscription_start_date }}</h3>
            </div>
        </div>
        <div class="thank-you">
            <p>Thank you for your purchase!</p>
        </div>
    </div>
</body>

</html>
