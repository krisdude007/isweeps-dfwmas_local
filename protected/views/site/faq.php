<div id="pageContainer" class="container" style="padding-left: 0px;">
    <div class="subContainer" style="padding: 0px;">
        <?php $this->renderPartial('_sideBar', array()); ?>
        <div class="col-sm-12 col-xs-12 floatRight" style="padding-right: 0px; padding-left: 0px;">
            <p>&nbsp</p>
            <h3 style="font-weight: 300; margin-bottom: 40px;"><?php echo Yii::t('youtoo', 'FAQ'); ?></h3>
            <div class="form">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'user-profile-form',
                    'enableAjaxValidation' => true,
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                ));
                ?>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>¿Tengo qué pagar para participar en el Sorteo?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>Existen métodos con y sin pago para participar en el Sorteo.  Tú puedes pagar para participar en el Sorteo mediante el uso de una tarjeta de crédito o cuenta de PayPal a través de la página web.  También puedes enviar una tarjeta postal para participar.  Consulta los Términos y Condiciones / Reglas Oficiales para mayor información.</div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>¿Si elijo el método de pago, cuál es el precio para participar?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>Para participar utilizando el método de pago, el costo del Sorteo es de $1 (un dólar estadounidense).  Es posible que de vez en cuando haya sorteos gratis. </div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>¿Existe un límite de edad?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>Sí.  Está diseñado como un juego para mayores de 21 años, o según las restricciones legales de edad para sorteos pagados que existan en tu estado de residencia.</div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>¿Cuáles son las horas del juego?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>El juego funciona las 24 horas del día con un nuevo juego cada semana.</div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>¿Cómo son las preguntas? ¿Puedo jugar más de una vez?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>Juego 1, la pregunta principal del Sorteo en Casa será de opción múltiple basado en la transmisión de los Viernes por la Noche de Futbol Azteca.  Los jugadores tendrán que elegir una respuesta de las tres respuestas de opción múltiple que se ofrecen.  El siguiente juego, el juego 2, también cuesta $1 (un dólar estadounidense) para participar, pero éste consistirá en escoger a los equipos ganadores de múltiples partidos y todas las respuestas deberán ser correctas para obtener una (1) entrada al sorteo.  Sí, puedes participar varias veces sin exceder un máximo de $10  (diez dólares estadounidenses) por día. </div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>¿Cuáles son los métodos para participar?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>Como se mencionó anteriormente, hay dos métodos para participar.  Tú puedes pagar para participar en el sorteo mediante el uso de una tarjeta de crédito o cuenta de PayPal a través de la página web.  También puedes enviar una tarjeta postal para participar.  Consulta los Términos y Condiciones / Reglas Oficiales para mayor información.</div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>¿Cuáles son los requisitos del sistema, si es que los hay, a instalar en la computadora?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>No es necesario instalar ningún software en tu computadora; siempre y cuando tengas conexión a Internet con un navegador apropiado (Firefox, Safari, Chrome, Internet Explorer), puedes iniciar tu sesión o registrarte para participar en el Sorteo Azteca.</div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>¿Qué pasa con la privacidad? ¿Quién puede ver mi perfil?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>Tu privacidad es muy importante para nosotros . Por favor, consulta la Política de Privacidad utilizando el link/enlace en la parte inferior de la página para cualquier duda tengas.</div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>¿Cómo se seleccionan los ganadores?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>Cada semana habrá un ganador, el cual será seleccionado únicamente del grupo de participantes con la respuesta CORRECTA.  El ganador del grupo de participantes correctos será seleccionado al azar a través de una plataforma computarizada.</div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>¿Cómo se anuncian los ganadores?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>El ganador será anunciado semanalmente y la lista histórica también estará disponible en línea.  Todas las menciones en los medios de comunicación serán a exclusivo criterio de Azteca.  Los ganadores serán notificados a través de la dirección de correo electrónico o número de teléfono ingresado en la cuenta de perfil del usuario en el sitio web del Sorteo.</div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>¿Cómo obtengo mi premio si soy un ganador?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>Los ganadores confirmados tendrán que firmar los papeles correspondientes  para recibir su premio.  Un representante de Azteca se pondrá en contacto con los ganadores; si un ganador no puede ser contactado después de intentar durante cinco (5) días hábiles a partir del primer intento de notificación, dicha persona será descalificada, y otro ganador será seleccionado de acuerdo con las Reglas Oficiales del Sorteo.  Sólo se hará un intento por premio para designar a un ganador alterno.  De no ser posible, el premio no será otorgado.</div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>¿Qué es un Crédito, cómo lo utilizo?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>Los jugadores recibirán un (1) crédito por cada transacción exitosa de $1 (un dólar estadounidense).  Los créditos únicamente pueden ser intercambiados por artículos de la tienda.  Los Créditos no tienen ningún tipo de valor fisico monetario y no devengan intereses.</div>
                    </div>
                </div>
                <br/>
                <div class="col-sm-12 col-md-12">
                    <div class="faq panel panel-primary" style='background-color: #eeeeee; border-color: #eeeeee; border-radius: 0px;'>
                        <div class="faq panel-heading" style='padding: 0px;'>
                            <h3 class="faq panel-title" style='padding: 5px;text-align: left;'><span class="pull-left clickable panel-collapsed"><i class="glyphicon glyphicon-chevron-right" style='top: 0px;'></i>&nbsp;&nbsp;</span>¿Tengo que pagar para registrarme?</h3>
                        </div>
                        <div class="faq panel-body" style='background-color: #eeeeee; border-color: #eeeeee; display: none; margin: 15px; text-align: left;'>No, no es necesario pagar para inscribirse, pero es necesario registrarse en línea para participar en el Sorteo.</div>
                    </div>
                </div>
            </div>
            <br/>

            <p>&nbsp</p>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<script>
    function collapseMe() {
        $('#collapseOne').addClass('collapse').removeClass('in');
        $('#collapseTwo').addClass('collapse').removeClass('in');
        $('#collapseThree').addClass('collapse').removeClass('in');
        return true;
    }

    $(document).on('click', '.panel-heading span.clickable', function(e) {
        var $this = $(this);
        if (!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideUp();
            $this.addClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-right');
        } else {
            $this.parents('.panel').find('.panel-body').slideDown();
            $this.removeClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-down');
        }
    })

</script>
