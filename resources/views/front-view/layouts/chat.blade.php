{{-- <style>
    #sy-whatshelp {
    right: 25px;
    bottom: 25px;
    position: fixed;
    z-index: 9999;
  }
  
  #sy-whatshelp a {
    position: relative;
  }
  
  #sy-whatshelp a.sywh-open-services {
    background-color: #129bf4;
    color: #fff;
    line-height: 55px;
    margin-top: 10px;
    border: none;
    cursor: pointer;
    font-size: 23px;
    width: 55px;
    height: 55px;
    text-align: center;
    box-shadow: 2px 2px 8px -3px #000;
    border-radius: 100%;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    -ms-border-radius: 100%;
    display: inline-block;
  }
  
  #sy-whatshelp a.sywh-open-services i {
    line-height: 55px;
  }
  
  #sy-whatshelp a.sywh-open-services i.fa-times {
    display: none;
  }
  
  #sy-whatshelp .sywh-services {
    width: 55px;
    height: auto;
  }
  
  #sy-whatshelp .sywh-services a {
    display: none;
  }
  
  #sy-whatshelp .sywh-services a i {
    background-color: #129bf4;
    color: #fff;
    line-height: 55px;
    margin-top: 10px;
    border: none;
    cursor: pointer;
    font-size: 23px;
    width: 55px;
    height: 55px;
    text-align: center;
    box-shadow: 2px 2px 8px -3px #000;
    border-radius: 100%;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    -ms-border-radius: 100%;
  }
  
  #sy-whatshelp .sywh-services a.email i {
    background-color: #b92b27;
  }
  
  #sy-whatshelp .sywh-services a.instagram i {
    background-color: #e4405f;
  }
  
  #sy-whatshelp .sywh-services a.messenger i {
    background-color: #0084ff;
  }
  
  #sy-whatshelp .sywh-services a.whatsapp i {
    background-color: #25d366;
  }
  
  #sy-whatshelp .sywh-services a.call i {
    background-color: #ff6600;
  }
  
  a[data-tooltip] {
    position: relative;
  }
  
  a[data-tooltip]::before,
  a[data-tooltip]::after {
    position: absolute;
    display: none;
    opacity: 0.85;
    transition: all 0.3s ease-in-out;
  }
  
  a[data-tooltip]::before {
    content: attr(data-tooltip);
    background: #000;
    color: #fff;
    font-size: 13px;
    padding: 7px 11px;
    border-radius: 5px;
    white-space: nowrap;
    text-decoration: none;
  }
  
  a[data-tooltip]::after {
    width: 0;
    height: 0;
    border: 6px solid transparent;
    content: "";
  }
  
  a[data-tooltip]:hover::before,
  a[data-tooltip]:hover::after {
    display: block;
  }
  
  a.sywh-open-services[data-tooltip]::before,
  a.sywh-open-services[data-tooltip]::after {
    display: block;
  }
  
  a.data-tooltip-hide[data-tooltip]::before,
  a.data-tooltip-hide[data-tooltip]::after {
    display: none !important;
  }
  
  a.sywh-open-services[data-tooltip][data-placement="left"]::before {
    top: 11px;
  }
  
  a[data-tooltip][data-placement="left"]::before {
    top: -7px;
    right: 100%;
    line-height: normal;
    margin-right: 10px;
  }
  
  a[data-tooltip][data-placement="left"]::after {
    border-left-color: #000;
    border-right: none;
    top: 50%;
    right: 100%;
    margin-top: -6px;
    margin-right: 4px;
  }
  
  a[data-tooltip][data-placement="right"]::before {
    top: -7px;
    left: 100%;
    line-height: normal;
    margin-left: 10px;
  }
  
  a[data-tooltip][data-placement="right"]::after {
    border-right-color: #000;
    border-left: none;
    top: 50%;
    left: 100%;
    margin-top: -6px;
    margin-left: 4px;
  }
  
  a[data-tooltip][data-placement="top"]::before {
    bottom: 100%;
    left: 0;
    margin-bottom: 10px;
  }
  
  a[data-tooltip][data-placement="top"]::after {
    border-top-color: #000;
    border-bottom: none;
    bottom: 100%;
    left: 10px;
    margin-bottom: 4px;
  }
  
  a[data-tooltip][data-placement="bottom"]::before {
    top: 100%;
    left: 0;
    margin-top: 10px;
  }
  
  a[data-tooltip][data-placement="bottom"]::after {
    border-bottom-color: #000;
    border-top: none;
    top: 100%;
    left: 10px;
    margin-top: 4px;
  }
  
  </style>
  
  <div id="sy-whatshelp">
    <div class="sywh-services">
      <a href="" class="messenger" data-tooltip="Livechat" data-placement="left" target="_blank">
        <i class="fa fa-comments"></i>
      </a>
      <a href="" class="whatsapp" data-tooltip="WhatsApp" data-placement="left" target="_blank">
        <i class="fa fa-whatsapp"></i>
      </a>
      <a href="" class="call" data-tooltip="Call" data-placement="left">
        <i class="fa fa-phone"></i>
      </a>
    </div>
    <a class="sywh-open-services whatsapp" data-tooltip="Contact Us" data-placement="left">
                  <i class="fa fa-comments"></i>
      <i class="fa fa-times"></i>
    </a>
  </div> --}}


<style>
  .float{
    position:fixed;
    width:60px;
    height:60px;
    bottom:40px;
    right:40px;
    background-color:#25d366;
    color:#FFF;
    border-radius:50px;
    text-align:center;
    font-size:30px;
    box-shadow: 1px 1px 1px rgb(80, 80, 80);
    z-index:100;
  }
  
  .my-float{
    margin-top:16px;
  }
</style>
<div class="fixed-bottom">
<a href="https://api.whatsapp.com/send?phone=97470125000&text=Hi%21%20," class="float" target="_blank">
<i class="fab fa-whatsapp my-float"></i>
</a>
</div>