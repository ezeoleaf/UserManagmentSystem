document.write(`<div class="navbar-fixed">
	<nav id="nav">
	<div class="nav-wrapper blue darken-4">
		<a class="brand-logo center inicioHref">Infocard</a>
		<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
		<ul class="left hide-on-med-and-down">
			<li><a class="" href="home.html" ><i class="material-icons">home</i></a></li>
		</ul>
		<ul class="right hide-on-med-and-down">
			<li><a onclick="logout()"><i class="material-icons">power_settings_new</i></a></li>
		</ul>
		<ul class="side-nav" id="mobile-demo">
			<li class="liHome"><a href="home.html"><strong>Infocard</strong></a></li>
			<li class="liComercio"><a href="comercio.html">Comercio</a></li>
			<li class="liCiudad"><a href="ciudad.html">Ciudad</a></li>
			<li class="liRubro"><a href="rubro.html">Rubro</a></li>
			<li class="liRubro"><a href="alerta.html">Alerta</a></li>
			<li class="liPerfil"><a class="perfilHref">Perfil</a></li>
			<li><a onclick="logout()">Cerrar Sesión</a></li>
		</ul>
	</div>
</nav></div>`);

function showSubNavBar(menu)
{
    document.write(`<div class="navbar-fixed" id="subnavbar">
	<nav id="navsubnavbar">
		<div class="nav-wrapper teal lighten-1">
		    <a class="brand-logo center"><h6  style="color:white" id="textSubNavBar">${menu}</h6></a>
        </div>
    </nav>
    </div>`);
}