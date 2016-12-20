document.write(`<div class="navbar-fixed">
	<nav id="nav">
	<div class="nav-wrapper grey darken-1">
		<a class="brand-logo center inicioHref">Shiftgig - User Management System</a>
		<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
		<ul class="left hide-on-med-and-down">
			<li><a class="" href="home.html" ><i class="material-icons">home</i></a></li>
		</ul>
		<ul class="right hide-on-med-and-down">
			<li><a onclick="logout()"><i class="material-icons">power_settings_new</i></a></li>
		</ul>
		<ul class="side-nav" id="mobile-demo">
			<li class="liHome"><a href="home.html"><strong>Home</strong></a></li>
			<li class="liUsers"><a href="users.html">Users</a></li>
			<li class="liGroups"><a href="groups.html">Groups</a></li>
			<li><a onclick="logout()">Logout</a></li>
		</ul>
	</div>
</nav></div>`);

function showSubNavBar(menu)
{
    document.write(`<div class="navbar-fixed" id="subnavbar">
	<nav id="navsubnavbar">
		<div class="nav-wrapper green lighten-1">
		    <a class="brand-logo center"><h6  style="color:white" id="textSubNavBar">${menu}</h6></a>
        </div>
    </nav>
    </div>`);
}