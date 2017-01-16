<html>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Bienvenido</a>
          <!--img src="C:\xampp\htdocs\Intranet\public\images\cegasa.png" alt="Lights" style="width:100%"-->
        </div>
        <ul class="nav navbar-nav">
          <!--li class="{{ setActive('/') }}"><a href="/">Home</a></li-->
          <li class="{{ setActive('department') }} {{ setActive('department/add') }}"><a href="/department">Departamentos</a></li>
          <li class="{{ setActive('section') }} {{ setActive('section/add') }}"><a href="/section">Secciones</a></li>
          <li class="{{ setActive('article') }} {{ setActive('article/add') }}"><a href="/article">Artículos</a></li>
          <li class="{{ setActive('user') }} {{ setActive('user/add') }}"><a href="/user">Usuarios</a></li>
          <li class="{{ setActive('request') }}"><a href="/request">Solicitudes</a></li>
        </ul>
      </div>
    </nav>       
</html>