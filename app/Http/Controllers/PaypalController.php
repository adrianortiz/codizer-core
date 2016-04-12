<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// APIS DE PAYPAL
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaypalController extends Controller
{
    // Configuraciones que vamos a estar utilizando
    private $_api_context;

    public function __construct() {
        // setup PayPal api context
        // trae los datos de config > paypal.php
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    /**
     * Configurar la información que requiere Paypal
     * y enviarsela
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postPayment($tiendaRoute)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $items = array();
        $subtotal = 0;
        $cart = \Session::get($tiendaRoute);
        $currency = 'MXN';

        foreach($cart as $producto) {
            $item = new Item();
            $item->setName($producto->nombre)
                ->setCurrency($currency)
                ->setDescription($producto->desc_producto)
                ->setQuantity($producto->quantity)
                ->setPrice($producto->final_price);
            $items[] = $item;
            $subtotal += $producto->quantity * $producto->final_price;
        }

        $item_list = new ItemList();
        $item_list->setItems($items);

        // Agregar un costo de envio + 100
        $details = new Details();
        $details->setSubtotal($subtotal)
            ->setShipping(0);

        $total = $subtotal + 0;
        $amount = new Amount();
        $amount->setCurrency($currency)
            ->setTotal($total)
            ->setDetails($details);

        // Total a pagar, contenido, moneda
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Pedido de prueba de Core');

        // Ruta a donde se va a redirigir
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(\URL::route('payment.status'))
            ->setCancelUrl(\URL::route('payment.status'));

        // Realizar pago como venta directa
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        // Comunicarse con la API de paypal
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Ups! Algo salió mal');
            }
        }

        // Si lo ultimo salio bien
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        // Guardar el id de sesión de Paypal en una variable de sesión
        \Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {
            // redirect to paypal
            return \Redirect::away($redirect_url);
        }

        return \Redirect::route('store.front.product.orden.show')
            ->with('error', 'Ups! Error desconocido.');
    }


    /**
     * La respuesta que nos da Paypal
     * Una vez que el usuario se loguea y hace la trasaction
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getPaymentStatus()
    {
        // Get the payment ID before session clear
        $payment_id = \Session::get('paypal_payment_id');

        // clear the session payment ID
        \Session::forget('paypal_payment_id');

        $payerId = \Input::get('PayerID');
        $token = \Input::get('token');

        //if (empty(\Input::get('PayerID')) || empty(\Input::get('token'))) {
        if (empty($payerId) || empty($token)) {
            return \Redirect::route('home')
                ->with('message', 'Hubo un problema al intentar pagar con Paypal');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId(\Input::get('PayerID'));

        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

        //echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later
        if ($result->getState() == 'approved') { // payment made

            // LOGICA PARA ALMACENAR LOS DATOS DEL PEDIDO EN LA BD

            return \Redirect::route('home')
                ->with('message', 'Compra realizada de forma correcta');
        }

        return \Redirect::route('home')
            ->with('message', 'La compra fue cancelada');
    }

}
