
// Comportamiento de la opción de añadir código en el cookbook
//////////////////////////////////////////////////////////

function addCodeAndClose()
{
	newValue = $("codeToAdd").value;
	
	//newValue = newValue.replace(/ /g,'&nbsp;');
	newValue = newValue.replace(/</g,'&lt;');
	//newValue = newValue.replace(/\n/gm,'&nbsp;<br>')

	//insertAtCursor($("source"), "\n[code=\"" + $("programmingLanguage").value + "\"]\n" + $("codeToAdd").value + "\n[/code]\n");
	insertAtCursor($("source"), "\n<pre name=\"code\" class=\"" + $("programmingLanguage").value + "\">\n" + newValue + "\n</pre>\n");
	//insertAtCursor($("source"), "\n<textarea name=\"code\" class=\"" + $("programmingLanguage").value + "\">\n" + $("codeToAdd").value + "\n</textarea>\n");
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