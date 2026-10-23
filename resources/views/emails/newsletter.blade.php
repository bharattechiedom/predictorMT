
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Newsletter Subscription</title>
</head>
<body style="background:#f4f6f8;font-family:Arial;padding:0;margin:0;">

<table width="100%" cellpadding="0" cellspacing="0">
<tr><td align="center">

<table width="600" cellpadding="0" cellspacing="0"
       style="background:#fff;border-radius:12px;margin:40px 0;overflow:hidden">

<tr>
<td style="background:#ff6600;padding:20px;text-align:center;color:#fff">
<h2 style="margin:0;">Thanks for Subscribing!</h2>
</td>
</tr>

<tr>
<td style="padding:30px;color:#333">
<p>Hello 👋</p>

<p>Thank you for subscribing to our newsletter. Now you'll receive exclusive offers, updates, and news directly in your inbox.</p>

<p style="margin-top:25px;">
If you no longer wish to receive emails, click below:
</p>

<p style="text-align:center;margin:25px 0;">
<a href="{{ route('newsletter.unsubscribe',$data['token']) }}"
   style="background:#dc3545;color:#fff;padding:12px 25px;text-decoration:none;border-radius:30px">
   Unsubscribe
</a>
</p>


 <p style="font-size:12px;color:#777;text-align:center" ><i class="fa fa-copyright" aria-hidden="true"></i> {{ date('Y') }}. All Rights Reserved <span
                itemprop="name">Predictor MT</span> Inc.</p>

</td>
</tr>

</table>

</td></tr>
</table>

</body>
</html>
