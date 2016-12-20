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
	//$('#toast-container').css('right','auto');
	$('#toast-container').css('bottom','50%');
	$('.toast').css('width','100%');
	$('.toast').css('text-align','center');
	$('.toast span').css('width','100%');
}

const excludedLoc = ['index','registro','restauraPass'];
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

function getIds(data)
{
	let excludedIds = '(';
	for(let i = 0; i < data.length; i++)
	{
		if(excludedIds != '(')
		{
			excludedIds += ',';
		}
		excludedIds += data[i].id;
	}
	excludedIds += ')';
	excludedIds = (excludedIds == '()') ? '(0)' : excludedIds;

	return excludedIds;
}

function logout()
{
	const param = {
		action:'logout',
	};
	$.ajax({
		type: "POST",
		url: './api/userController.php',
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

function checkMenu()
{
	if(excludedLoc.indexOf(getLoc()) != -1) return;
	let cH,pH,eH,dH,pfH,iH,gH,nH;
	hH = 'home.html';
	cmH = 'comercio.html';
	rH = 'rubro.html';
	cH = 'ciudad.html';

	
	addClick('homeHref',hH);
	addClick('comercioHref',cmH);
	addClick('ciudadHref',cmH);
	addClick('rubroHref',cmH);
}

function addClick(classN,url)
{
	const arr = document.getElementsByClassName(classN);
	for(let i = 0; i < arr.length; i++)
	{
		arr[i].addEventListener('click',function(){redirect(url)});
	}
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

function unformatDate(d)
{
	let vD = d.split('-');
	let year = ", "+vD[0];
	let day = parseInt(vD[2]);
	
	let month = "";
	switch(vD[1])
	{
		case "01": month = ' January'; break;
		case "02": month = ' February'; break;
		case "03": month = ' March'; break;
		case "04": month = ' April'; break;
		case "05": month = ' May'; break;
		case "06": month = ' June'; break;
		case "07": month = ' July'; break;
		case "08": month = ' August'; break;
		case "09": month = ' September'; break;
		case "10": month = ' October'; break;
		case "11": month = ' November'; break;
		case "12": month = ' December'; break;
	}
	
	return `${day}${month}${year}`;
}

function formatDate(date)
{
	let vDate = date.split(',');
	let year = vDate[1].trim();
	let monthName = vDate[0].split(' ')[1].toLowerCase();
	let day = vDate[0].split(' ')[0];
	let month = 0;
	switch(monthName)
	{
		case 'january': month = 1; break;
		case 'february': month = 2; break;
		case 'march': month = 3; break;
		case 'april': month = 4; break;
		case 'may': month = 5; break;
		case 'june': month = 6; break;
		case 'july': month = 7; break;
		case 'august': month = 8; break;
		case 'september': month = 9; break;
		case 'october': month = 10; break;
		case 'november': month = 11; break;
		case 'december': month = 12; break;
	}
	
	return `${year}-${month}-${day}`;
}

function formatDateFromDB(date)
{
	return date.split('-').reverse().join('/');
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