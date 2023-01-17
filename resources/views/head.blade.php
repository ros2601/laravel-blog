<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogger</title>
    <link rel="stylesheet" type="text/css" href="{{asset('http://localhost/z/laravel-blog-project/resources/css/app.css')}}">
    <style>
   * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: arial black;
}

.maincontainer {
    width: 100%;
    height: auto;
}

.navbar {
    display: flex;
    align-items: center;
    /*places the item in center from top bottom */
    justify-content: space-between;
    /**gives spaces betw logos and menus */
    padding: 15px;
    background-color: black;
    color: #fff;
}

.logo{
    font-size: 30px;
    font-family:cursive;
    margin-left: 20px;
}

.menu {
    display: flex;
    font-size: 20px;
    padding: 5px;
}

nav ul {
    display: flex;
    list-style: none;
}

nav ul li {
    margin: 0 5px;
}

nav ul li a,span {
    color: #f2f2f2;
    text-decoration: none;
    font-size: 20px;
    font-weight: 500;
    padding: 10px 15px;
    border-radius: 5px;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    font-family:cursive;
    font-weight:bold;
}
nav ul li a:hover {
    color: #111;
    background: #fff;
}
</style>
</head>
<body>
<div class="maincontainer">

<!-------------------------------Designing of NAV BAR--------------------------->
<nav class="navbar">
  <div class="logo" style="color:white;">Blogger</div>
  <ul class="links"> 
    <div class="menu">
    
       <li><a href="{{url('/home')}}">Home</a></li>
       <li><a href="{{url('/contact')}}">Contact</a></li>
       <li><a href="{{url('/upload')}}"> Upload</a> </li>

	    @if(Auth::user())
        <li><a href="{{url('/user')}}"> Hello, {{ Auth::user()->name }}</a></li>
        <li><a href="{{url('signout')}}">Log Out</a></li>
        @else
            <li><a href="{{url('login')}}">Log In</a></li>         
		@endif
       
       <!-- <li><a onclick="togglePopup1()">Log Out</a></li> -->
    </div>
  </ul>
</nav>