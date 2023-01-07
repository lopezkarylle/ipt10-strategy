<?php

namespace Strategy;

use Strategy\Cart\Item;
use Strategy\Cart\ShoppingCart;
use Strategy\Order\Order;
use Strategy\Invoice\TextInvoice;
use Strategy\Invoice\PDFInvoice;
use Strategy\Customer\Customer;
use Strategy\Payments\CashOnDelivery;
use Strategy\Payments\CreditCardPayment;
use Strategy\Payments\PaypalPayment;

class Application
{
    public static function run()
    {
        $Glorious = new Item('Twice Candy Bong', 'Candy Bong' , 5000);
        $Logitech = new Item('Twice Candy Bong', 'Candy Bong Z', 6500);

        $cart = new ShoppingCart();
        $cart->addItem($Glorious, 2);
        $cart->addItem($Logitech, 5);

        $customer = new Customer('Im Nayeon', 'Seoul, South Korea', 'imnayeon@twice.sk');
        
        $order = new Order($customer, $cart);

        $text_invoice = new TextInvoice();
        $order->setInvoiceGenerator($text_invoice);
        $text_invoice->generate($order);

        $cash_on_delivery = new CashOnDelivery($customer);
        $order->setPaymentMethod($cash_on_delivery);
        $order->payInvoice();
        
    }
}