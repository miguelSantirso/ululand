 function flashRow(obj) 
{
	obj.style.backgroundColor = "#FFFF99"; // This is the flash color, typically a light yellow
}
	
function unFlashRow(obj)
{
	obj.style.backgroundColor = "#FFFFFF"; // This is the original background color
}

function startEditingField()
{
	$("editableFieldTest").style.display = "none";
	$("editableFieldTestForm").style.display = "block";
}

function cancelEditingField()
{
	$("editableFieldTest").style.display = "block";
	$("editableFieldTestForm").style.display = "none";
}

function saveEditingField()
{
	$("editableFieldTest").style.display = "block";
	$("editableFieldTestForm").style.display = "none";
	var url = "http://pfc/frontend_dev.php/profile/updateAvatarName/newAvatarName/pepe";
	
	new Ajax.Request(url, {
	  method: 'post',
	  onSuccess: function(transport) {
	    var notice = $('editableFieldTestValue');
	    notice.update(transport.responseText);
	  }
	});
}