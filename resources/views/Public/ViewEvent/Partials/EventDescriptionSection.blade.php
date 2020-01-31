<section id="details" style="background-color: #fff;">
    <div class="row" style="background-color:#29a05b; padding: 0; color: #fff">
        <h1 class="section_head" style="padding: 48px 0; margin: 0">
            INFORMATIE
        </h1>
    </div>
    <div class="container" style="padding: 32px 0">
        <div class="row">
            @php
                $descriptionColSize =  $event->images->count()
                    && in_array($event->event_image_position, ['left', 'right'])
                    ? '7' : '12';
            @endphp

            @if ($event->images->count() && $event->event_image_position == 'left')
                <div class="col-md-5">
                    <div class="content event_poster">
                        <img alt="{{$event->title}}" src="{{config('attendize.cdn_url_user_assets').'/'.$event->images->first()['image_path']}}" property="image">
                    </div>
                </div>
            @endif
            @if ($event->images->count() && $event->event_image_position == 'before')
                <div class="col-md-8 col-md-push-2">
                    <div class="content event_poster">
                        <img alt="{{$event->title}}" src="{{config('attendize.cdn_url_user_assets').'/'.$event->images->first()['image_path']}}" property="image">
                    </div>
                </div>
            @endif

            <!--
            <div class="col-md-{{ $descriptionColSize }}">
                <div class="content event_details" property="description">
                    {!! Markdown::parse($event->description) !!}
                </div>
            </div>
            -->

            @if ($event->images->count() && $event->event_image_position == 'right')
                <div class="col-md-5">
                    <div class="content event_poster">
                        <img alt="{{$event->title}}" src="{{config('attendize.cdn_url_user_assets').'/'.$event->images->first()['image_path']}}" property="image">
                    </div>
                </div>
            @endif
            @if ($event->images->count() && $event->event_image_position == 'after')
                <div class="col-md-12" style="margin-top: 20px">
                    <div class="content event_poster">
                        <img alt="{{$event->title}}" src="{{config('attendize.cdn_url_user_assets').'/'.$event->images->first()['image_path']}}" property="image">
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>