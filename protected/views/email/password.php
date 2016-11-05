<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <link rel="stylesheet" type="text/css" href="/webassets/css/client.css" />
    </head>
    <body>
        <div style='max-width:615px;max-height:620px;background-color: #ececec;font-family: museosans, museo, sans-serif;font-size:12px; color: #696969;padding-top:10px;'>
            <div id='content' style='max-width:600px;  max-height:520px; margin:0 auto;background-color:#ffffff;font-family: museosans; '>
                <img src='http://{hostname}/webassets/images/laliga/emails/Email-Header_Azteca.jpg'/>
                <div style='padding: 15px;'>
                    <div style='font-size:28px;color:#696969;font-family: museosans, museo, sans-serif;font-weight:100;margin-bottom:10px;margin-top: 20px;'><?php echo Yii::t('youtoo', 'A Password Reset Request Was Issued for Your Account'); ?></div>
                    <p style="font-family: museosans,museo, sans-serif;"><?php echo Yii::t('youtoo','Hello '); ?><span style='font-weight:bold;font-family: museosans;'>{first_name} {last_name},</span></p>
                    <p style="font-family: museosans,museo, sans-serif;">
                        <?php echo Yii::t('youtoo', 'A password reset request was issued for your account! Please click here to login and change your password: '); ?><br/>
                    </p>
                    <p style="font-family: museosans,museo, sans-serif;">
                        <a style="font-family: museosans,museo, sans-serif; color: #ea8417;" href="{link}">{link}</a>
                    </p>
                    <p style="font-family: museosans,museo, sans-serif;">
                        <?php echo Yii::t('youtoo', 'Once you login, click on your “Account” and then “Password” to update your password.'); ?>
                    </p>
                    <p style="font-family: museosans,museo, sans-serif;">
                        <?php echo Yii::t('youtoo', 'Thanks!'); ?><br>
                        <?php echo Yii::t('youtoo','The Azteca Team'); ?><br>
                        <a style="font-family: museosans,museo, sans-serif; color: #ea8417;" href='http://us.azteca.com'>us.azteca.com</a>
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