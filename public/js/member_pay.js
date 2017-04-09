/* Member_pay.js  - Evelio Velez Jr. 04-14-2014 */


	window.onload = function(){
		init();
	}

	/* Lookup Member  Member_renew.php */
	function validate_member(){

		if( val_flds() === false )
			return false;
				
		if( val_terms() === false ){
			document.getElementById("mySubmit").disabled = true;
			document.getElementById("mySubmit").style.color='#000';
			return false;
		}else{
			document.getElementById("mySubmit").disabled = false;
			document.getElementById("mySubmit").style.color='red';
		}
		
	}
