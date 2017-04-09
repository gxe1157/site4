/* Artwork Javascript NJLEPOB 2015 */
/* Evelio Velez Jr. 06-2015        */

	window.onload = function(){
		init();
	}
	
	function init(){
		var name = document.forms[0].name;  //alert( 'Form[ '+document.forms.length+' ] '+document.forms[0].name );
		formReset(name);
		clearMessages();
		if( showMess.length ){
			alert_mess(showMess);
		}
	}
	
	function _(el){
		return document.getElementById(el);
	}

	/* Same as the one defined in OpenJS */
	function getFrameByName(name) {
	  for (var i = 0; i < frames.length; i++)
		if (frames[i].name == name)
		  return frames[i];
	 
	  return null;
	}
	 
	function uploadDone(name) {
	   var frame = getFrameByName(name);
	   if (frame) {
		 ret = frame.document.getElementsByTagName("body")[0].innerHTML;
		 if (ret.length) {
		   /* Process data in json ... */
		   //alert( ret);
		   completeHandler(ret);
		 }
	  }
  
	}
	/* Same as the one defined in OpenJS */
	 

	function completeHandler(data){
		clearMessages(); 
		var mess = [];
		var mess =data.split("|");

		switch(mess[0]) {
			case 'fileUpload':
				_("artStatus").innerHTML = mess[1];
				_("status").innerHTML = mess[2];			
				break;
				
			case 'fileRemove':
				_("artStatus").innerHTML = 'removed';
				_("status").innerHTML = mess[1];			
				break;
				
			case 'uploadError':
				_("loaded_n_total").innerHTML = '';
				
				break;

			default:
				// failed
				_("loaded_n_total").innerHTML = 'System Error <br />';
				
		}
		
	}


	function uploadFile(){
		if( _('file1').value == '' ){
			alert('Select a File to Upoad.');
			return false
		}
		
		if( _('file1').value == _('artStatus').innerHTML ){
			alert('You have already selected and uploaded '+_('file1').value+'.\n');
			return false
		}
		
		showFname();
	
	}
	
	function removeUpload(sel_opt_id) {
		_("sel_document").value = sel_opt_id;
		_('Sel_text').value = _("sel_document").options[_("sel_document").selectedIndex].text;
		var remove = new Array();
		var removeFile = _(sel_opt_id+'2').innerHTML;
		var remove =removeFile.split("<");
		var buildGet ="sel_document="+sel_opt_id+"&Orderid="+_('Orderid').value+"&DBF="+_('DBF').value+"&RemoveFile="+remove[0]+"&Sel_text="+_('Sel_text').value;
		location.href = "/members/file_upload_remove.php?"+buildGet;
	}

	
	function showFname(){
		clearMessages();
		var newName = new Array();
		var baseName = document.forms[0]['file1'].value;
		if( baseName.slice(0,3) == 'C:\\' ){
			newName = baseName.split("\\");
			var baseName = newName[2];
			_('sendFile').innerHTML = baseName;
		}
	}
	
	function clearMessages() {
		_("status").innerHTML = '';
		_('sendFile').innerHTML = '';
        _('loaded_n_total').innerHTML = '';
	}
