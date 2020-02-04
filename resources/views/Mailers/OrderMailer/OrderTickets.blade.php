@extends('Mailers.Layouts.Master')

@section('message_content')
Beste,<br><br>

Uw bestelling voor het evenement <strong>{{$order->event->title}}</strong> is gelukt.<br><br>

Uw tickets zijn bijgevoegd aan deze email. U kunt uw bestelling ook bekijken via de volgende link: {{route('showOrderDetails', ['order_reference' => $order->order_reference])}}

@if(!$order->is_payment_received)
<br><br>
<strong>Let op: Uw bestelling moet nog betaald worden, voor meer informatie: {{route('showOrderDetails', ['order_reference' => $order->order_reference])}}</strong>
<br><br>
@endif
<h3>Gegevens</h3>
Referentie: <strong>{{$order->order_reference}}</strong><br>
Naam: <strong>{{$order->full_name}}</strong><br>
Datum: <strong>{{$order->created_at->format(config('attendize.default_datetime_format'))}}</strong><br>
Email: <strong>{{$order->email}}</strong><br>

@if ($order->is_business)
<h3>Business Details</h3>
@if ($order->business_name) @lang("Public_ViewEvent.business_name"): <strong>{{$order->business_name}}</strong><br>@endif
@if ($order->business_tax_number) @lang("Public_ViewEvent.business_tax_number"): <strong>{{$order->business_tax_number}}</strong><br>@endif
@if ($order->business_address_line_one) @lang("Public_ViewEvent.business_address_line1"): <strong>{{$order->business_address_line_one}}</strong><br>@endif
@if ($order->business_address_line_two) @lang("Public_ViewEvent.business_address_line2"): <strong>{{$order->business_address_line_two}}</strong><br>@endif
@if ($order->business_address_state_province) @lang("Public_ViewEvent.business_address_state_province"): <strong>{{$order->business_address_state_province}}</strong><br>@endif
@if ($order->business_address_city) @lang("Public_ViewEvent.business_address_city"): <strong>{{$order->business_address_city}}</strong><br>@endif
@if ($order->business_address_code) @lang("Public_ViewEvent.business_address_code"): <strong>{{$order->business_address_code}}</strong><br>@endif
@endif

<h3>Bestelling</h3>
<div style="padding:10px; background: #F9F9F9; border: 1px solid #f1f1f1;">
    <table style="width:100%; margin:10px;">
        <tr>
            <td>
                <strong>Ticket</strong>
            </td>
            <td>
                <strong>Aantal</strong>
            </td>
            <td>
                <strong>Prijs</strong>
            </td>
            <td>
                <strong>Bedrag</strong>
            </td>
        </tr>
        @foreach($order->orderItems as $order_item)
        <tr>
            <td>{{$order_item->title}}</td>
            <td>{{$order_item->quantity}}</td>
            <td>
                @isFree($order_item->unit_price)
                FREE
                @else
                {{money($order_item->unit_price, $order->event->currency)}}
                @endif
            </td>
            <td>
                @isFree($order_item->unit_price)
                FREE
                @else
                {{money(($order_item->unit_price + $order_item->unit_booking_fee) * ($order_item->quantity),
                $order->event->currency)}}
                @endif
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="2"></td>
            <td><strong>Totaal</strong></td>
            <td colspan="1">
                {{$orderService->getGrandTotal(true)}}
            </td>
        </tr>
    </table>
    <br><br>
</div>
<br>
Hartelijk dank!<br>
Stichting Neet te Redde
@stop
