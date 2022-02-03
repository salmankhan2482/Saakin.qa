<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
</head>
<style>
    body {
        font-size: 14px;
        font-family: Arial, Helvetica, sans-serif;
    }

</style>

<body>
    <table cellpadding="0" cellspacing="0" width="60%"
        style="margin:0 auto;border:1px solid rgba(0, 0, 0, 0.2);padding:20px;">
        <tr style="border:0">
            <td style="text-align:center">
                <a href="{{ url('/') }}" target="_blank">
                    <img src="{{ URL::asset('upload/logo.png') }}" alt="Logo" style="width: 150px;height: 150px;">
                </a>
            </td>
        </tr>
        <tr style="border:0">
            <td>
                Hello {{ $name }},
            </td>
        </tr>
        <tr>
            <td style="padding: 20px 0 30px 0;line-height:22px;">
                <strong>{{ $agency_ }}</strong> has created your agent account, now you can login using below
                credentials
                <br><br>

                <b>Name:</b> {{ $name }}<br>
                <b>Email:</b> {{ $email }}<br>
                <b>Phone:</b> {{ $phone }}<br>

                <b>Password:</b> {{ $password }}<br>

                <b>Login URL: <a href="https://www.saakin.qa/login">https://www.saakin.qa/login</a></b>

            </td>
        </tr>

        <tr>
            <td style="line-height:20px">
                Thanks!
                <br />- {{ getcong('site_name') }}
            </td>
        </tr>
    </table>
    <p style="font-size: 13px;text-align: right;margin-top: 10px;position: relative;right: 27.5%;">&copy;
        {{ getcong('site_name') }}</p>
</body>

</html>
