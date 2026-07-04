<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TRENZYCH Admin Panel</title>

<link rel="stylesheet" href="/assets/css/style.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{
background:#0f172a;
color:#fff;
font-family:Arial,sans-serif;
}

.admin-wrapper{
display:flex;
min-height:100vh;
}

.main-content{
flex:1;
padding:25px;
margin-left:260px;
}

.card{
background:#1e293b;
border-radius:18px;
padding:20px;
margin-bottom:20px;
box-shadow:0 10px 30px rgba(0,0,0,.30);
}

@media(max-width:768px){

.admin-wrapper{
display:block;
}

.main-content{
margin-left:0;
padding:15px;
}

}

</style>

</head>

<body>

<div class="admin-wrapper">
