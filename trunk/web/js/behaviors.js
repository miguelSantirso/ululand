
// Comportamiento de la opción de añadir código en el cookbook
//////////////////////////////////////////////////////////

function addCodeAndClose()
{
	newValue = $("codeToAdd").value;
	//newValue = newValue.replace(/</g,'&lt;');
	
	insertAtCursor($("source"), "\n[code " + $("programmingLanguage").value + "]\n" + newValue + "\n[/code]\n");
	
	Modalbox.hide();
}

function insertAtCursor(myField, myValue)
{
	//IE support
	if (document.selection)
	{
		myField.focus();
		sel = document.selection.createRange();
		sel.text = myValue;
	}
	//MOZILLA/NETSCAPE support
	else if (myField.selectionStart || myField.selectionStart == "0")
	{
		var startPos = myField.selectionStart;
		var endPos = myField.selectionEnd;
		myField.value = myField.value.substring(0, startPos)
			+ myValue
			+ myField.value.substring(endPos, myField.value.length);
	} else {
		myField.value += myValue;
	}
}

// Comportamiento de la barra de chat
/////////////////////////////////////

function toggleChat()
{
	chatWindow = $('chatClient');
	
	Element.toggleClassName(chatWindow, 'chatClientUp');
}


// Comportamiento del botón "+", en los enlaces extensibles
//////////////////////////////////////////////////////////

function showMoreMenu(url)
{
	Modalbox.show(url, {title: "Acciones R&aacute;pidas:"});
}


function swapMoreImage(obj, idStatus)
{
	if(idStatus==0)
	{
		obj.src = "/images/more_hover.gif";
	}
	else if(idStatus==1)
	{
		obj.src = "/images/more_active.gif";
	}
	else if(idStatus==2)
	{
		obj.src = "/images/more.gif";
	}
}