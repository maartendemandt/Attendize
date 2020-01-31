<form class="online_payment ajax" action="<?php echo route('postCreateOrder', ['event_id' => $event->id]); ?>" method="post">      
    <p>
        Nadat je zo je 'bestelling afrond' graag het totaalbedrag van {{ money($ticket['full_price'], $event->currency) }} binnen 7 werkdagen overmaken naar de rekening:<br><br>

        NL21312312312312 t.a.v. Stichting Neet te Redde <br>
        Onder vermelding van je voor- en achternaam. <br> <br>

        Na he afronden van de bestelling ontvang je direct je tickets, let wel op: deze worden pas geactiveerd nadat wij het totaalbedrag op bovenstaande rekening hebben ontvangen. <br> <br>
    </p>
    {!! Form::token() !!}
    <input class="btn btn-lg btn-success card-submit" id="card-submit" style="width:100%;" type="submit" value="BESTELLING AFRONDEN">
</form>


