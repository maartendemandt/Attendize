@if(!$event->is_live)
<section id="goLiveBar">
    <div class="container">
        @if(!$event->is_live)

        {{ @trans("ManageEvent.event_not_live") }}
        <a href="{{ route('MakeEventLive' , ['event_id' => $event->id]) }}"
           style="background-color: green; border-color: green;"
        class="btn btn-success btn-xs">{{ @trans("ManageEvent.publish_it") }}</a>
        @endif
    </div>
</section>
@endif
<section id="intro" style="display: flex; flex-direction: column; justify-content: space-between; padding: 0; height: 600px; background: url('{{ asset('vidk.jpg') }}') center center no-repeat; background-size:cover">

    
</section>
<div style="width: 100%; background-color: #913A8C; padding-top: 8px; padding-bottom: 8px;">
    <div class="container" >
        <div class="event_buttons" style="display: flex; flex-direction: row;  justify-content: space-around;">
            <a class="btn btn-event-link btn-lg" style="flex: 1;" href="{{{$event->event_url}}}#details">INFORMATIE</a>
            <a class="btn btn-event-link btn-lg" style="flex: 1" href="{{{$event->event_url}}}#tickets">@lang("Public_ViewEvent.TICKETS")</a>
            <a class="btn btn-event-link btn-lg" style="flex: 1" href="{{{$event->event_url}}}#organiser">@lang("Public_ViewEvent.CONTACT")</a>
        </div>
    </div>
</div>