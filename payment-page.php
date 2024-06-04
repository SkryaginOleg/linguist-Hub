<?php
session_start();

// Merchant details
$merchantAccount = "www_linguisthub_space";
$merchantSecretKey = "434d63a19c6ac9c761a0c054b0b4ff9c7398dc57";
$wayForPayApiUrl = "https://secure.wayforpay.com/pay";

function generateSignature($data, $secretKey) {
    $hashString = implode(';', $data);
    return hash_hmac('md5', $hashString, $secretKey);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderReference = uniqid("order_", true);
    $orderDate = time();
    $amount = $_POST['amount'];
    $currency = 'UAH';
    $productName = ['VIP Membership'];
    $productCount = [1];
    $productPrice = [$amount];

    $merchantDomainName = 'www.linguisthub.space';
    
    $data = [
        'merchantAccount' => $merchantAccount,
        'merchantDomainName' => $merchantDomainName,
        'orderReference' => $orderReference,
        'orderDate' => $orderDate,
        'amount' => $amount,
        'currency' => $currency,
        'productName' => $productName,
        'productCount' => $productCount,
        'productPrice' => $productPrice,
        'merchantSignature' => generateSignature([
            $merchantAccount,
            $merchantDomainName,
            $orderReference,
            $orderDate,
            $amount,
            $currency,
            implode(';', $productName),
            implode(';', $productCount),
            implode(';', $productPrice)
        ], $merchantSecretKey),
        'returnUrl' => 'https://' . $merchantDomainName . '/payment_success.php',
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase VIP Membership</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>
        body {
    background: #f7f7f7;
    font-family: 'Arial', sans-serif;
}

.container {
    max-width: 1200px;
}

.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background: white;
    margin-bottom: 20px;
    transition: transform 0.3s;
    display: flex;
    flex-direction: column;
}

.card:hover {
    transform: translateY(-10px);
}

.card-title {
    font-size: 20px;
    margin-bottom: 15px;
}

.card-text {
    font-size: 14px;
    margin-bottom: 15px;
}

.price {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin-top: auto;
}

.old-price {
    text-decoration: line-through;
    color: #999;
    margin-right: 10px;
}

.new-price {
    color: #e74c3c;
    font-size: 22px;
    font-weight: bold;
}

.discount {
    font-size: 14px;
    color: #28a745;
    margin-bottom: 20px;
}

.btn-primary {
    background: #007bff;
    border: none;
    transition: background 0.3s;
}

.btn-primary:hover {
    background: #0056b3;
}

    </style>
    <div class="container mt-5">
        <h1 class="text-center mb-5">Choose Your VIP Membership</h1>
        <div class="row d-flex">
            <div class="col-md-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">1 Month</h5>
                        <p class="card-text">Perfect for short-term access. Enjoy all premium features for a month.</p>
                        <p class="price mt-auto">100 UAH</p>
                        <p class="discount">No discount</p>
                        <form method="POST" action="payment-page.php">
                            <input type="hidden" name="amount" value="100">
                            <button type="submit" class="btn btn-primary btn-block mt-auto">Purchase</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">3 Months</h5>
                        <p class="card-text">Great for ongoing access. Save with a 3-month plan.</p>
                        <p class="price mt-auto">
                            <span class="old-price">300 UAH</span>
                            <span class="new-price">250 UAH</span>
                        </p>
                        <p class="discount">You save 50 UAH (17% off)</p>
                        <form method="POST" action="payment-page.php">
                            <input type="hidden" name="amount" value="250">
                            <button type="submit" class="btn btn-primary btn-block mt-auto">Purchase</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">6 Months</h5>
                        <p class="card-text">Ideal for long-term users. Get the best value for 6 months.</p>
                        <p class="price mt-auto">
                            <span class="old-price">600 UAH</span>
                            <span class="new-price">460 UAH</span>
                        </p>
                        <p class="discount">You save 140 UAH (23% off)</p>
                        <form method="POST" action="payment-page.php">
                            <input type="hidden" name="amount" value="460">
                            <button type="submit" class="btn btn-primary btn-block mt-auto">Purchase</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">1 Year</h5>
                        <p class="card-text">Best for regular users. Enjoy a full year of premium features.</p>
                        <p class="price mt-auto">
                            <span class="old-price">1200 UAH</span>
                            <span class="new-price">880 UAH</span>
                        </p>
                        <p class="discount">You save 320 UAH (27% off)</p>
                        <form method="POST" action="payment-page.php">
                            <input type="hidden" name="amount" value="880">
                            <button type="submit" class="btn btn-primary btn-block mt-auto">Purchase</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($data)): ?>
        <form id="wayforpay-payment-form" method="POST" action="<?php echo $wayForPayApiUrl; ?>">
            <?php foreach ($data as $key => $value): ?>
                <?php if (is_array($value)): ?>
                    <?php foreach ($value as $v): ?>
                        <input type="hidden" name="<?php echo $key; ?>[]" value="<?php echo $v; ?>">
                    <?php endforeach; ?>
                <?php else: ?>
                    <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
                <?php endif; ?>
            <?php endforeach; ?>
        </form>
        <script>
            document.getElementById('wayforpay-payment-form').submit();
        </script>
    <?php endif; ?>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

