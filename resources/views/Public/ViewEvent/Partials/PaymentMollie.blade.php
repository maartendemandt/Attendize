<form class="online_payment ajax" action="<?php echo route('postCreateOrder', ['event_id' => $event->id]); ?>" method="post">      
    <div class="well">
        <div class="row">
            <div class="col-sm-6 col-xs-6">
                <p>
                    <b>@lang("Public_ViewEvent.first_name")</b><br> 
                    {{ $request_data['order_first_name'] }}
                </p>
            </div>
            <div class="col-sm-6 col-xs-6">
                <p>
                    <b>@lang("Public_ViewEvent.last_name")</b><br> 
                    {{ $request_data['order_last_name'] }}
                </p>
            </div>
            <div class="col-sm-12 col-xs-12 mt-4">
                <p>
                    <b>@lang("Public_ViewEvent.email")</b><br> 
                    {{ $request_data['order_email'] }}
                </p>
            </div>
        </div>
    </div>
    {!! Form::token() !!}
    <input class="btn btn-lg btn-success card-submit" id="card-submit" style="width:100%;" type="submit" value="Complete Payment">
</form>


