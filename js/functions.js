function toasty(text,style,time)
{
	if(time == undefined) time=2000;
	if(style == undefined) style='default';
	if(text == undefined) return;
	
	style = style.toLowerCase();
	var bgColor,fColor;
	switch(style)
	{
		case 'error':
			bgColor = '#e53935';
			color = 'white';
			break;
		case 'success':
			bgColor = '#388e3c';
			color = 'white';
			break;
		case 'sahara':
			bgColor = '#fb8c00';
			color = 'white';
			break;
		case 'prince':
			bgColor = '#5e35b1';
			color = 'white';
			break;
		default:
			 bgColor = 'black';
			 color = 'white';
			 break;
	}

	var $toastContent = $(`<span class="just">${text}</span>`);
	Materialize.toast($toastContent, time);
	$('.toast').css('background-color',bgColor);
	$('.toast').css('color',color);
	$('#toast-container').css('width','100%');
	$('#toast-container').css('top','auto');
	$('#toast-container').css('bottom','50%');
	$('.toast').css('width','100%');
	$('.toast').css('text-align','center');
	$('.toast span').css('width','100%');
}

const storage = window.localStorage;
const options = {
	'home':'liHome',
	'users':'liUsers',
	'groups':'liGroups'
};

function getLoc()
{
	return window.location.pathname.split('/')[(window.location.pathname.split('/')).length - 1].split('.')[0];
}

function redirect(url)
{
	window.location.replace(url);
}

function checkLogin() {
	if(getLoc() != 'index') {
		const param = {
			action:'isLogged',
		};

		$.ajax({
			type:'POST',
			url:'./api/userAppController.php',
			data:param,
			success:function(response) {
				const r = parse(response);
				if(!r.success) {
					redirect('index.html');
				}
			},
			error:function(msg) {
				console.log(msg);
			}
		});
	}
}

checkLogin();

function getItem(item)
{
	return storage.getItem(item);
}

function removeItem(item)
{
	storage.removeItem(item);
}

function setItem(item,val)
{
	storage.setItem(item,val);
}

function logout()
{
	const param = {
		action:'logout',
	};
	$.ajax({
		type: "POST",
		url: './api/userAppController.php',
		data: param,
		success: function(response)
		{
			window.location.replace('index.html');
		},
		error: function(msg)
		{
			toasty(`Se ha producido un error de conexión.`,'error');
		}
	});
}

function emptyCheck(data,type)
{
	let vData = data;
	if(type == 's')
	{
		vData = data.split(',');
	}

	for(let i = 0; i < vData.length; i++)
	{
		let vE = vData[i].split('--');
		let e = document.getElementById(vE[0]);
		let errMessage = vE[1];
		if(e == null) continue;
		if(e.value.trim() == "")
		{
			toasty(errMessage,'error');
			e.focus();
			return true;
		}
	}
	return false;
}

function checkVacio(data,type)
{
	let vData = data;
	if(type == 's')
	{
		vData = data.split(',');
	}
	let empty = false;
	for(let i = 0; i < vData.length; i++)
	{
		let e = document.getElementById(vData[i]);
		if(e == null) continue;
		if(e.value.trim() == "")
		{
			if(e.classList)
			{
				e.classList.add('errorTextBox');
			}
			else
			{
				e.className += ' errorTextBox';
			}
			e.focus();
			empty = true;
		}
	}
	return empty;
}

function sacarColor(me)
{
	$(me).css('box-shadow','0px 0px 0px 0px #ccc');
	$(me).removeClass('errorTextBox');
}

function getCard(cT,cC)
{
	return `<div class="row"><div class="col s12">
			<div class="card blue-grey darken-1">
			<div class="card-content white-text">
			<span class="card-title">${cT}</span>
			<p class="center-align">${cC}</p>
			</div></div></div></div>`;
}

function parse(json)
{
	return JSON.parse(json);
}

function setLocation()
{
	setItem('location',getLoc());
}


function getOptions(data,valueFrom,valueTo)
{
	var dLength = data.length;
	let options = '';
	for(var i = 0; i < dLength; i++)
	{
		let selected = (valueTo) ? ((data[i][valueFrom].toLowerCase() == valueTo.toLowerCase()) ? ' selected' : '' ) : '';
		options += `<option value="${data[i].id}"${selected}>${data[i].name}</option>`;
	}
	return options;
}

function checkSelectedOption()
{
	const l = getLoc();
	const name = `.${options[l]}`;
	$(name).addClass('selectedOption');
}

class Loader
{
	constructor(contents = [])
	{
		this.loader = document.getElementById('loader');
		this.stop();
	}

	stop()
	{
		this.loader.style.display = 'none';
	}

	start()
	{
		this.loader.style.display = 'block';
	}
}

//document.addEventListener("DOMContentLoaded", checkMenu, false);
document.addEventListener("DOMContentLoaded", checkSelectedOption, false);