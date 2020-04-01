<section id='order_form'  style="padding: 0; background-color: #fff;">
    <div class="row" style="background-color:#29a05b; padding: 0; color: #fff">
        <h1 class="section_head" style="text-transform:uppercase; padding: 48px 0; margin: 0">
            @lang("Public_ViewEvent.order_details")
        </h1>
    </div>
    <div class="container" style="padding: 32px 0">
        <div class="row">
            <div class="col-md-12" style="text-align: center">
                @lang("Public_ViewEvent.below_order_details_header")
            </div>
            <div class="col-md-4 col-md-push-8">
                
                <div class="panel panel-success" style="margin-top: 20px">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="ico-cart mr5"></i>
                            @lang("Public_ViewEvent.order_summary")
                        </h3>
                    </div>

                    <div class="panel-body pt0" style="background-color: #f8f8f8">
                        <table class="table mb0 table-condensed">
                            @foreach($tickets as $ticket)
                            <tr>
                                <td class="pl0" style="border: 0px; ">{{{$ticket['ticket']['title']}}} X <b>{{$ticket['qty']}}</b></td>
                                <td class="pr0" style="border: 0px; text-align: right;">
                                    @isFree($ticket['full_price'])
                                        @lang("Public_ViewEvent.free")
                                    @else
                                    {{ money($ticket['full_price'], $event->currency) }}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    @if($order_total > 0)
                    <div class="panel-footer">
                        <h5>
                            @lang("Public_ViewEvent.total"): <span style="float: right;"><b>{{ $orderService->getOrderTotalWithBookingFee(true) }}</b></span>
                        </h5>
                        @if($event->organiser->charge_tax)
                        <h5>
                            {{ $event->organiser->tax_name }} ({{ $event->organiser->tax_value }}%):
                            <span style="float: right;"><b>{{ $orderService->getTaxAmount(true) }}</b></span>
                        </h5>
                        <h5>
                            <strong>@lang("Public_ViewEvent.grand_total")</strong>
                            <span style="float: right;"><b>{{  $orderService->getGrandTotal(true) }}</b></span>
                        </h5>
                        @endif
                    </div>
                    @endif

                </div>
                <div class="help-block">
                    {!! @trans("Public_ViewEvent.time", ["time"=>"<span id='countdown'></span>"]) !!}
                </div>
            </div>
            <div class="col-md-8 col-md-pull-4">
                <div class="event_order_form">
                    {!! Form::open(['url' => route('postValidateOrder', ['event_id' => $event->id ]), 'class' => 'ajax payment-form']) !!}

                    {!! Form::hidden('event_id', $event->id) !!}

                    <h3> @lang("Public_ViewEvent.your_information")</h3>

                    <div class="row" style="margin-top: 20px">
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label("order_first_name", trans("Public_ViewEvent.first_name")) !!}
                                {!! Form::text("order_first_name", null, ['required' => 'required', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label("order_last_name", trans("Public_ViewEvent.last_name")) !!}
                                {!! Form::text("order_last_name", null, ['required' => 'required', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label("order_email", trans("Public_ViewEvent.email")) !!}
                                {!! Form::text("order_email", null, ['required' => 'required', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row"><div class="col-md-12">&nbsp;</div></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ticket_holders_details" >
                                <h3 style="margin-bottom: 16px;">@lang("Public_ViewEvent.ticket_holder_information")</h3>
                                <div style="margin-top: 24px; margin-bottom: 16px; width: 100%; display: flex; flex-direction: row; justify-content: center;">
                                    <a href="javascript:void(0);" style="width: 100%;" class="btn btn-lg btn-success" id="mirror_buyer_info">
                                        @lang("Public_ViewEvent.copy_buyer")
                                    </a>
                                </div>
                                <?php
                                    $total_attendee_increment = 0;
                                ?>
                                @foreach($tickets as $ticket)
                                    @for($i=0; $i<=$ticket['qty']-1; $i++)
                                    <div class="panel panel-success">

                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <b>{{$ticket['ticket']['title']}}</b>: @lang("Public_ViewEvent.ticket_holder_n", ["n"=>$i+1])
                                            </h3>
                                        </div>
                                        <div class="panel-body" style="background-color: #f8f8f8">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {!! Form::label("ticket_holder_first_name[{$i}][{$ticket['ticket']['id']}]", trans("Public_ViewEvent.first_name")) !!}
                                                        {!! Form::text("ticket_holder_first_name[{$i}][{$ticket['ticket']['id']}]", null, ['required' => 'required', 'class' => "ticket_holder_first_name.$i.{$ticket['ticket']['id']} ticket_holder_first_name form-control"]) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {!! Form::label("ticket_holder_last_name[{$i}][{$ticket['ticket']['id']}]", trans("Public_ViewEvent.last_name")) !!}
                                                        {!! Form::text("ticket_holder_last_name[{$i}][{$ticket['ticket']['id']}]", null, ['required' => 'required', 'class' => "ticket_holder_last_name.$i.{$ticket['ticket']['id']} ticket_holder_last_name form-control"]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        {!! Form::label("ticket_holder_email[{$i}][{$ticket['ticket']['id']}]", trans("Public_ViewEvent.email_address")) !!}
                                                        {!! Form::text("ticket_holder_email[{$i}][{$ticket['ticket']['id']}]", null, ['required' => 'required', 'class' => "ticket_holder_email.$i.{$ticket['ticket']['id']} ticket_holder_email form-control"]) !!}
                                                    </div>
                                                </div>
                                                @include('Public.ViewEvent.Partials.AttendeeQuestions', ['ticket' => $ticket['ticket'],'attendee_number' => $total_attendee_increment++])

                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                @endforeach
                            </div>
                        </div>
                    </div>

                    @if($event->pre_order_display_message)
                    <div class="well well-small">
                        {!! nl2br(e($event->pre_order_display_message)) !!}
                    </div>
                    @endif

                {!! Form::hidden('is_embedded', $is_embedded) !!}
                {!! Form::hidden('no_payment', $no_payment) !!}
                {!! Form::submit(trans("Public_ViewEvent.checkout_order"), ['class' => 'btn btn-lg btn-primary card-submit', 'style' => 'width:100%;']) !!}
                {!! Form::close() !!}

                </div>
            </div>
        </div>
        <img src="https://cdn.attendize.com/lg.png" />
    </div>
</section>
@if(session()->get('message'))
    <script>showMessage('{{session()->get('message')}}');</script>
@endif

