
window.onload = function(){
    init();
}


function init(){
   // document.forms["form1"]["sel_level"].value = 'Select';
   document.forms["form1"]["submit_id"].value = 'Select Level then Click Here!';
   document.getElementById('show_plan').innerHTML = mem_plan_benefits[0];
}

function do_post(){
   var sel_level=document.forms["form1"]["sel_level"].value;
   if( sel_level == "0" ){
       alert( "Please Select a Membership Level.... " )
       return false;
   }

   document.form1.mem_appliction.value=document.form1.mem_type.value;
   document.form1.print_opt.value='yes';
   document.form1.action="/members/admin/adm_mem_form.php";
   document.form1.submit();
}

function select_mem(){
	
   for ( i=0; i<mem_level.length-1; i++){
	  if( i>0 )
	  document.getElementById(mem_level[i]).style.backgroundColor = '#fff';
   }
   

   var sel_level=document.forms["form1"]["sel_level"].value;
   if( sel_level == "0" ){
      alert( "Please Select a Membership Level.... " )
      document.forms["form1"]["submit_id"].value = "Select Level then Click Here!";
      document.getElementById('show_plan').innerHTML =  mem_plan_benefits[sel_level];
	  //  show_plan.innerHTML = mem_plan_benefits[sel_level];
      return;
   }
   document.forms["form1"]["submit_id"].value = "Click to apply for: "+mem_level[sel_level];
   document.forms["form1"]["mem_type"].value = mem_level[sel_level];

   //   show_plan.innerHTML = mem_plan_benefits[sel_level];
   document.getElementById('show_plan').innerHTML =  mem_plan_benefits[sel_level];
   document.getElementById(mem_level[sel_level]).style.backgroundColor = '#FFFF99';
}


function select_mem1(){
   var sel_level=document.forms["form1"]["sel_level"].value;
   if( sel_level == "0" ){
      alert( "Please Select a Membership Level.... " )
      document.forms["form1"]["submit_id"].value = "Select Level then Click Here!";
      return;
   }
   document.forms["form1"]["submit_id"].value = "Click Here to apply for: "+sel_level;
   document.forms["form1"]["mem_type"].value = sel_level;

}


function validate(){
   var sel_level=document.forms["form1"]["sel_level"].value;
   if( sel_level == "0" ){
      alert( "Please Select a Membership Level.... " )
      return false;
   }
   // var x = document.form1.action;
   // alert("here2: "+x )
   document.form1.print_opt.value='';

}


function select_donor(){
   var sel_level=document.forms["form1"]["sel_level"].value;
   if( sel_level == "0" ){
      alert( "Please Select a Sponsor Level.... " )
      return;
   }
   // document.forms["form1"]["donor_type"].value = sel_level;
}


function validate_donor(){
   var sel_level=document.forms["form1"]["sel_level"].value;
   if( sel_level == "0" ){
      alert( "Please Select a Sponsor Level.... " )
      return false;
   }

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
