<form class="online_payment ajax" action="<?php echo route('postCreateOrder', ['event_id' => $event->id]); ?>" method="post">      
    <p>
        Wij zijn trots u als gast te mogen begroeten tijdens Verenigt in de Kern 2020! <br><br>

        Na het afronden van de bestelling ontvangt u direct de e-tickets. Let op: de QR-code is nog niet actief.<br><br>

        Nadat de betaling is voldaan ontvangt u van ons een bevestigingsmail en wordt de QR-code geactiveerd. Zonder tijdige betaling is de QR-code niet actief.<br><br>
        
        Druk op ‘bestelling afronden’ om door te gaan naar de betaalinstructies.  <br><br>
        
        Namens het voltallige Stichtingsbestuur; tot in September!  <br><br>      
    </p>
    {!! Form::token() !!}
    <input class="btn btn-lg btn-success card-submit" id="card-submit" style="width:100%;" type="submit" value="BESTELLING AFRONDEN">
</form>


