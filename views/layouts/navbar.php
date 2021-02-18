<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Navbar</title>
    <link rel="stylesheet" href="css/style.css" >
  </head>
  <body>
    <header>
      <nav>
        <ul class="nav_links" >
          <li><a href="/">Home</a> </li>
          <li><a href="/login">Login</a> </li>
          <li><a href="/register">Register</a> </li>
        </ul>
      </nav>
      <a class="cta" href="/contact"> <button type="button" name="button">Contact</button></a>
    </header>
      <div class="container">
        {{content}}
      </div>

  </body>
</html>
