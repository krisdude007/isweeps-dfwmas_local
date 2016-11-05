<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <link rel="stylesheet" type="text/css" href="/webassets/css/client.css" />
    </head>
    <body>
        <div style='max-width:615px;max-height:680px;background-color:#ececec;font-family:museosans,museo, sans-serif;font-size:12px; color: #696969;padding-top:10px;'>
            <div id='content' style='max-width:600px; max-height:580px; margin:0 auto;background-color:#ffffff; '>
                <img src='http://{hostname}/webassets/images/laliga/emails/Email-Header_Azteca.jpg'/>
                <div style='padding: 15px;font-family:museosans,museo, sans-serif;'>
                    <div style='font-size:28px;color:#696969;font-weight:100;margin-bottom:10px;margin-top: 20px;'><?php echo Yii::t('youtoo', 'Welcome To Azteca’s Contests'); ?></div>
                    <p style="font-family: museosans,museo, sans-serif;"><?php echo Yii::t('youtoo','Hello '); ?><span style='font-weight:bold;'>{first_name} {last_name},</span></p>
                    <p style="font-family: museosans,museo, sans-serif;"><?php echo Yii::t('youtoo', 'Thanks for registering! Now it’s time to play for your chance to WIN! It only takes 3 easy steps!!'); ?></p>

                    <p style="font-family: museosans,museo, sans-serif;">
                        <?php echo Yii::t('youtoo', "1) Visit us at {link}."); ?><br/>
                        <?php echo Yii::t('youtoo', '2) Click on the Game you want to “Play Now.”'); ?><br/>
                        <?php echo Yii::t('youtoo', '3) Answer the Question correctly for your chance to WIN all sorts of prizes!'); ?>
                    </p>
                    <br>
                    <?php echo Yii::t('youtoo', 'That’s it!'); ?><br/>
                    <p style="font-family: museosans,museo, sans-serif;">
                        <?php echo Yii::t('youtoo', 'Some games cost $1.00 to play, some games are Free – but all gameplay earn you<br/> credits that can be used in the online Store! Check it out now!') . '<a href="{storelink}">Tienda</a>'; ?>
                    </p>
                    <p style="font-family: museosans,museo, sans-serif;">
                        <?php echo Yii::t('youtoo', 'Good luck!'); ?><br>
                        <?php echo Yii::t('youtoo','The Azteca Team'); ?><br>
                        <a href='http://us.azteca.com'>us.azteca.com</a>
                    </p>
                </div>
            </div>
            <div style='padding:15px;font-family: museosans,museo, sans-serif;'>
                <p style="font-family: museosans,museo, sans-serif; font-size: 10px;">
                    <?php echo Yii::t('youtoo','To UNSUBSCRIBE from future email notifications, '); ?><a href='http://{hostname}/you/profile' style='color: #ea8417'><?php echo Yii::t('youtoo','click here'); ?></a><br>
                </p>
                <p style='margin-top:15px;font-family: museosans,museo, sans-serif; font-size: 10px;'>
                    &#169; <?php echo date('Y'); ?> Azteca <a style="font-family: museosans,museo, sans-serif; color: #ea8417;" href='http://static.azteca.com/TermsOfService.html' target='_blank'><?php echo Yii::t('youtoo','Terms of Use'); ?></a> & <a style="font-family: museosans,museo, sans-serif; color: #ea8417;" href='http://static.azteca.com/OnlinePrivacyPolicy.html' target='_blank' ><?php echo Yii::t('youtoo','Privacy Policy'); ?></a>.
                    Youtoo Technologies, LLC <a style="font-family: museosans,museo, sans-serif; color: #ea8417;" href='http://youtootech.com/patents' target='_blank'>youtootech.com/patents</a>
                </p>
            </div>
        </div>
    </body>
</html>