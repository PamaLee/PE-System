<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>开发者工坊</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
	 <meta name="author" content="greaty">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="theme-color" content="#3f51b5">
    <link rel="icon" href="/photos/ico.ico">
    <link rel="stylesheet" href="public/material.css"/>
    <link rel="stylesheet" href="public/css/mdui.css"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script defer src="public/material.js"></script>
<style>
.demo-layout-transparent {
  background: url(http://i2.tiimg.com/629849/64a38fda5d57de18.png) center / cover;
}
.demo-layout-transparent .mdl-layout__header,
.demo-layout-transparent .mdl-layout__drawer-button {
  color: white;
}
	.main{
    text-align: center;
    border-radius: 10px;
    width: 400px;
    height: 300px;
    margin: auto;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
        z-index: 100000;
}
</style>
</head>
<body>

<div class="demo-layout-transparent mdl-layout mdl-js-layout">
  <header class="mdl-layout__header mdl-layout__header--transparent">
    <div class="mdl-layout__header-row">
      <span class="mdl-layout-title"><font color="white">开发者工坊</font></span>
      <div class="mdl-layout-spacer"></div>
    </div>
  </header>
	<div class="main" style="padding-top: -100px">
		<h3 style="color: white">
	  体育评测系统-内测
  </h3>
		<h1 style="color: white">
		欢迎回来!
		</h1>
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" onClick="window.location.href='log/' ">
            点击登录
        </button>
	</div>

</div>
</body>
</html>
