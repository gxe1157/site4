 
	window.onload = function(){
		init();
	}

    function chkBox( adPrice, opt ){
        document.getElementById('checkout').innerHTML ='';
        document.forms['myForm']['itemnumber'].value='';
        for (var i=1; i<=total_ads; i++){
          if( i == opt ){
            if( document.getElementById(i).checked==true ){
                document.getElementById('checkout').innerHTML = document.getElementById(i).value+': $'+dollarValue(adPrice);
                document.getElementById('itemnumber').value = document.getElementById(i).value;
                document.getElementById('itemprice').value = dollarValue(adPrice);
            }
          }else{
            document.getElementById(i).checked=false;
          }

        }
     }


	function chkBox_check(){
         var mess = '';
         var proceed = false;
			
         for (var i=1; i<=total_ads; i++){
            if( document.getElementById(i).checked ){
               proceed =true;
               break;
            }
         }
		 
         if( proceed === false ){
             mess ='<p style="text-align:left; font-size: 14px; font-weight:bold;">We notice you did not pick an Ad. Please choose by checking the box next to the Ad you wish to buy.</p>';
             alert_mess( mess );
             return false;
         }
		return true;
	}

	function validate_ads(opt){
		//alert( document.getElementById('itemnumber').value );

         // chk required fields
		if( chkBox_check() === false )
			return false;
			
		if( val_flds() === false )
			return false;
			
		if( val_terms() === false )
			return false;
			
        if(opt=='use_my_printer')
			print_form();
			
	}


	function validate_adPage(){
		if(document.getElementById('sel_level').value =='Select'){
			alert('Select is not valid');
			return false;
		}
	}
		
	function validate_donor(){
		if(document.getElementById('sel_level').value =='Select'){
		  alert( "Please Select a Sponsor Level.... " )
		  return false;
	   }
	   
	  var sel_level=document.getElementById('sel_level').value;
	  switch( sel_level ){
		 case 'platinum_donor':
		   var hosted_id='XUNR9T65L4LUA';
		   break;
		 case 'gold_donor':
		   var hosted_id='SA3FGYV9XQTXL';
		   break;
		 case 'silver_donor':
		   var hosted_id='WHWCWTZW937QS';
		   break;
		 case 'bronz_donor':
		   var hosted_id='JKUDVR8EY3EGY';
		   break;
		 case 'supporter':
		  var hosted_id='ZZEMMLEH38HUS';
		  break;
	  }

	  document.forms["form1"]["hosted_button_id"].value = hosted_id;
	  
	}
