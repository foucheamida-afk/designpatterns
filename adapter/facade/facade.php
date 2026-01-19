<?php

require_once '../card.php';
require_once '../payment.php';

class PaymentFacade {
    private LocalATM $atm;
    private PaymentGateway $gateway;

    public function __construct(PaymentGateway $gateway, LocalATMCard $card) {
        $this->atm = new LocalATM();
        $this->gateway = $gateway;
        $this->card = $card;
    }

    public function processPayment(float $amount): void {
        // Insert card
        $this->atm->readCard($this->card);
        echo "\n";

        // Process payment
        echo $this->gateway->pay($amount);
    }
}

// Usage example
$paypal = new PayPalGateway();
$localCard = new CardAdapter(new InternationalCard());

$facade = new PaymentFacade($paypal, $localCard);
$facade->processPayment(100.50);