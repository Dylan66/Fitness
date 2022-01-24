<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Notifications\Payment as NotificationsPayment;

class PaymentsController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth:web', 'role'])->except(['paypal_payment', 'paypal_success', 'data']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $payments = Payment::paginate(10);
        return view('dashboard.payments.index')->with('payments', $payments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
        // return $payment;
        return view('dashboard.payments.show')->with('payment', $payment);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
        return redirect()->back();
    }



    public function paypal_payment(Booking $booking)
    {
        //
        // return $booking;

        $provider = new ExpressCheckout();

        $data = $this->data($booking);

        // return $data;
        $response = $provider->setExpressCheckout($data);


        // return $response;
        return redirect($response['paypal_link']);
    }

    public function paypal_success(Request $request)
    {
        //
        $provider = new ExpressCheckout();
        $token = $request->token;
        $payer_id = $request->PayerID;
        $response1 = $provider->getExpressCheckoutDetails($token);

        $booking = Booking::where('user_id', Auth::id())->first();

        // return $booking;

        $data = $this->data($booking);

        // return $response1;

        $payment = new Payment();
        $payment->token = $response1['TOKEN'];
        $payment->time = $response1['TIMESTAMP'];
        $payment->correlation_id = $response1['CORRELATIONID'];
        $payment->status = $response1['ACK'];
        $payment->email = $response1['EMAIL'];
        $payment->payer_id = $response1['PAYERID'];
        $payment->payer_status = $response1['PAYERSTATUS'];
        $payment->first_name = $response1['FIRSTNAME'];
        $payment->last_name = $response1['LASTNAME'];
        $payment->country_code = $response1['COUNTRYCODE'];
        $payment->address_status = $response1['ADDRESSSTATUS'];
        $payment->currency_code = $response1['CURRENCYCODE'];
        $payment->amount = $response1['AMT'];
        $payment->item_amount = $response1['ITEMAMT'];
        $payment->booking_id = $booking->id;
        $payment->user_id = Auth::id();

        // return $payment;
        $payment->save();
        // return $payment;



        $response = $provider->doExpressCheckoutPayment($data, $token, $payer_id);

        $booking->is_complete = 1;
        $booking->save();
        Notification::send(Auth::user(), new NotificationsPayment($booking, $payment));

        toastr()->success('Payment successfull');

        return redirect()->route('home');
    }
    public function data(Booking $booking)
    {
        $data = [];
        $data['items'] = [
            [
                'name' => $booking->service->name,
                'price' => $booking->service->amount,
                'desc'  => $booking->service->description,
                'qty' => 1
            ],

        ];


        $data['invoice_id'] = $booking->id;
        $data['invoice_description'] = $booking->service->description;
        $data['return_url'] = route('success');
        $data['cancel_url'] = url('/home');

        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $data['total'] = $total;
        return $data;
    }
}
