/*uploadJS Javascript NJLEPOB March 2016 */
/* Evelio Velez Jr. 03-23-2016  */
	
	function _(el){
		return document.getElementById(el);
	}
	
	/* Adam Khoury Uplaod with progess bar */
	function uploadFile( fn, path, divTarget ){
		//var file = _(fn.name).files[0];
		//console.log( fn.files[1].name );
		//return false;
		
        if( _('file1').value == _('file2').value ){
			alert( 'Error:_.......\nYou already selected '+_('file2').value+'\nPlease try again.' );
			_('file2').value ='';
			return false;		
		}
		
		if( _('file1').value && _('file2').value ){
			var sendFile1 = _('file1').files[0];
			dataSetup( sendFile1, _('file1').value, null, _('id').value, 'show_file1',1);

			var sendFile2 = _('file2').files[0];			
			setTimeout(function(){ dataSetup( sendFile2, _('file2').value, null, _('id').value, 'show_file2',2) }, 500);
		}
		if( _('file1').value ) _('ok1').innerHTML = '<img src="/images/download_ok.jpg" alt="download_ok" height="20" width="20">';
		if( _('file2').value ) _('ok2').innerHTML = '<img src="/images/download_ok.jpg" alt="download_ok" height="20" width="20">';
		
	}	
	
	function removeUpload( divTarget ) {

		if ( confirm( 'You are about to remove your Law Enforcement ID information') ) {
			var fileName = "/members/file_upload_id.php?ID="+(new Date()).getTime()+"&Cat="+(new Date()).getTime()+312 ;		

			var formdata = new FormData();
			formdata.append('Remove', true);
			formdata.append("id", _('id').value );				
			formdata.append("uploadNo", 2 );								
			runAjax(formdata, fileName, divTarget );			
		}		
    }/* End removeUpload */	
	
	
	function dataSetup( file, uploadName, path, id, divTarget,uploadNo ){
		    var uploadSelection = _('Le_id').value;
			var fileName = "/members/file_upload_id.php?ID="+(new Date()).getTime()+"&Cat="+(new Date()).getTime()+312 ;		
			var formdata = new FormData();
			formdata.append(uploadName, file);
			formdata.append("path", path );
			formdata.append("id", id );		
			formdata.append("uploadNo", uploadNo );					
			formdata.append("uploadSelection", uploadSelection );								
			runAjax(formdata, fileName, divTarget );
	}	


	function runAjax(formdata, fileName, divTarget ){
		var ajax = new XMLHttpRequest();
		ajax.upload.addEventListener("progress", function (event){ progressHandler( event, divTarget );}, false);
		ajax.addEventListener("load", function (event){ completeHandler( event, divTarget );}, false);
		ajax.addEventListener("load", function (event){ doneHandler( event, divTarget );}, false);
		//ajax.addEventListener("load", doneHandler, true);		
		ajax.addEventListener("error", errorHandler, false);
		ajax.addEventListener("abort", abortHandler, false);
		ajax.open("POST", fileName);
		ajax.send(formdata);	
	}

	/* Adam Khoury Uplaod with progess bar */
		function doneHandler(event, params){
			var data = event.target.responseText;
			//0-Status | 1-Key | 2-FileName | 3-Response
			var mess = [];
			var mess =data.split("|");

			//showArray(mess);
			
			switch(mess[0]) {
				case 'fileUpload':
					//showImgName( mess[2], mess[1], mess[4], mess[5]);
					_('image-BtnLeId2').style.visibility = 'visible';
					_(params).innerHTML = "upload was successful.....";
					
					// Change from required to not required (  X|20|1 to X|20|0 )
					fld_t[fld_n.indexOf('le_id')] = fld_t[fld_n.indexOf('le_id')].substr(0,5)+'0'; 							
					Update_Select( 'Le_id' );
				
					if( params == 'show_file1' ) activateImgBox();
					
					var newImg = 'archives/member_images/'+this_id+'/'+mess[1];
					_( 'Img-'+params ).src= newImg;
							
					break;
				
				case 'fileRemove':
					//showArray(mess);
					_('image-BtnLeId2').style.visibility = 'hidden';				
					_('show_file1').innerHTML = '<progress id=\"progressBar-show_file1\" value=\"0\" max=\"100\" style=\"width:90%\"></progress>';
					_('show_file2').innerHTML = '<progress id=\"progressBar-show_file2\" value=\"0\" max=\"100\" style=\"width:90%\"></progress>';					
					fld_t[fld_n.indexOf('le_id')] = fld_t[fld_n.indexOf('le_id')].substr(0,5)+'1'; 												

					_('Le_id').disabled = false;
					_('Le_id').selectedIndex = 0;
					Update_Select( 'Le_id' );
					activateImgBox();
					
					var messAlert = mess[1]+'\n'+mess[2];
					
					alert(messAlert);
					
					break;

				default:
					// failed
					_(params).innerHTML =  'System Error.. call webmaster<br />'+mess[3];
					
			}
		}		
		
		function progressHandler(event, params){
			if( params != "Btn-remove"){
				var percent = (event.loaded / event.total) * 100;			
				_("progressBar-"+params).value = Math.round(percent);
				//_("percent"-params).innerHTML = Math.round(percent)+"% uploaded... please wait";
			}	
		}

		function completeHandler(event, params){
			if( params != "Btn-remove"){
				var percent = 100;
				_("progressBar-"+params).value = Math.round(percent);
				//_("percent"-params).innerHTML = Math.round(percent)+"% upload Complete....";
			}			
		}

		function errorHandler(event){
			_('show_error').display = block;
			_("status").innerHTML = event.target.responseText; // use this to error div on screen bottom
		}
		
		function abortHandler(event){
			_('show_error').display = block;			
			_("status").innerHTML = "Upload Aborted";
		}

	

    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
