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
{{-- @dd($data); --}}
<body>

    <table border="0" cellpadding="0" cellspacing="0" width="60%"
        style="margin:0 auto;border:1px solid rgba(0, 0, 0, 0.2);padding:20px;">
        <tr style="border:0">
            <td style="text-align:center">
                <a href="www.saakin.qa" target="_blank">
                    <img src="{{ URL::asset('assets/images/black_logo.png') }}" alt="Page Logo"
                        style="width: 150px;height: 150px;"></a>
            </td>
        </tr>
        <tr style="border:0">
            <td>
                Hello Saakin,
            </td>
        </tr>
        <tr>
            <td style="padding: 20px 20px 30px 20px;line-height:22px;">
                We have Recieved the Details
                <br><br>

                <b>Name:</b> {{ $data['name'] }}<br>
                <b>Email:</b> {{ $data['email'] }}<br>
                <b>Phone:</b> {{ $data['phone'] }}<br>
                <b>Subject:</b> {{ $data['subject'] }}<br>
                <b>Message:</b> {{ $data['your_message'] }}<br><br>

                Thanks!
                <br />
                <div>
                    <a href="www.saakin.qa">Saakin Qatar</a> 
                    | 
                    
                    <a class="link-hov style2"
                        href="https://www.saakin.qa/properties?property_type=1&property_purpose=Rent&keyword=qatar">
                        Apartments for rent in Qatar
                    </a>
                    | 
                    <a class="link-hov style2"
                        href="https://www.saakin.qa/properties?property_type=1&property_purpose=Sale&keyword=qatar">
                        Apartments for sale in Qatar
                    </a>
                    | 
                    <a class="link-hov style2" href="https://www.saakin.qa/buy/properties-for-sale">
                        Real Estate Investment in Qatar
                    </a>
                    | 
                    <a class="link-hov style2" href="https://www.saakin.qa/city-guide">
                        Doha City Guide
                    </a>
                    |
                    <a class="link-hov style2" href="https://www.saakin.qa/blogs">
                        Qatar Blogs
                    </a>
                </div>


            </td>
        </tr>
    </table>
</body>

</html>
