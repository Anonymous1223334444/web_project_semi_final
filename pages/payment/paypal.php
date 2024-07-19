<?php

    require "../../vendor/autoload.php";

    // Set up PayPal environment
    $clientId = 'AcjYi_nnahu81QPiWMm3HPomSUHrV_HYx7Xp2E2ywKJYH7b-SIZdbyfJ8gbm-GEd14k3bUvP-pNezQ_a';
    $clientSecret = 'EC66lPZAVgJiua8V58LS9cow2Kwb-KAXI-gK-MBvqbBnBr0PG2LzXzxIgrIagEamWrfDrC8EU9CND4-T';

    $paypal = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential($clientId, $clientSecret)
    );

    // Set up the payment
    $payment = new \PayPal\Api\Payment();
    $payment->setIntent('sale')
        ->setPayer(
            new \PayPal\Api\Payer(['payment_method' => 'paypal'])
        )
        ->setRedirectUrls(
            new \PayPal\Api\RedirectUrls(
                [
                    'return_url' => 'http://localhost/web_dev_3/pages/action/payment_success.php',
                    'cancel_url' => 'http://localhost/web_dev_3/pages/pay_method.php'
                ]
            )
        )
        ->setTransactions([
            (new \PayPal\Api\Transaction())
                ->setAmount(
                    new \PayPal\Api\Amount(
                        [
                            'total' => '10.00',
                            'currency' => 'EUR'
                        ]
                    )
                )
        ]);

    // Create payment
    try {
        $payment->create($paypal);
        header('Location: ' . $payment->getApprovalLink());
        exit;
    } catch (\PayPal\Exception\PayPalConnectionException $ex) {
        echo $ex->getMessage();
    }
?>