//////////////////////////////////////////////////////////
// Comportamiento del botón "+", en los enlaces extensibles
//////////////////////////////////////////////////////////

function showMoreMenu(url)
{
	Modalbox.show(url, {title: "Acciones R&aacute;pidas:"});
}


function swapMoreImage(obj, idStatus)
{
	if(idStatus==0){
		obj.src = "/images/more_hover.gif";
	} else if(idStatus==1){
		obj.src = "/images/more_active.gif";
	} else if(idStatus==2){
		obj.src = "/images/more.gif";
	}
	
}