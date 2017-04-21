<?php echo form_open('news/create'); ?>

    <label for="title">Title</label>
    <input type="input" name="title" /><br />

    <label for="text">Text</label>
    <textarea name="text"></textarea><br />

    <input type="submit" name="submit" value="Create news item" />

</form>
<!-- 
    <div  class="div-wide" >
		 <b>The NJ Law Enforcement Police Officers Brotherhood<br />
		  195 Paterson Ave, Little Falls NJ 07424<br /><br />
		  Phone:   973-256-7390&nbsp;&nbsp;&nbsp;&nbsp; Fax: 973-256-7391<br />
		  E-Mail: Info@NJLEPOB.com</b>
    </div>

    <div  class="div-wide" style="text-align: right;">

	<script language="JavaScript1.2" type="text/javascript" src="js/myLib.js"></script>
	<script language="JavaScript1.2" type="text/javascript" src="js/popup.js"></script>
	<script language="JavaScript1.2" type="text/javascript" src="js/format_flds.js"></script>		

	<center>
    <form name="myForm" id="myForm" method="POST" action="contact-us.php" onSubmit="return val_flds();">
	    <input type='text' name = 'Title' class="hidden" value="">
		<table width="64%" border="0" BORDERCOLOR="RED" cellspacing="2" cellpadding="2" >
			<tr>
			  <td colspan='2'><span id="form-required-flds">Fields in yellow are required.</span></td>
			</tr>	
			<tr align="left">
				<td width="15%" >First Name:</td>
				<td width="42%"><input name="First_name" id="First_name" type="text" value=""  size="37"  maxlength="30" tabindex=1 onBlur="Javascript: fldCheck( 'A', 1, this ); " /></td>
			</tr>
			 <tr align="left">
				 <td>Last Name:</td>
				<td><input name="Last_name" id="Last_name" type="text"   value="" size="37" maxlength="30" tabindex=2 onBlur="Javascript: fldCheck( 'A', 1, this );" /></td>
			</tr>
			 <tr align="left">
				 <td>Middle Name:</td>
				<td><input name="Middle" id="Middle" type="text"   value="" size="37" maxlength="30" tabindex=3 onBlur="Javascript: fldCheck( 'A', 0, this );" /></td>
			</tr>
			 <tr align="left">
				 <td>Cell Phone:</td>
				<td><input name="Cell_phone" type="text" value="" size="14" maxlength="14" tabindex=4 onkeydown="javascript: formatData(this,event,'DOWN','phone');" onkeyup="javascript:formatData(this,event,'UP','phone');" /></td>
			</tr>
			 <tr align="left">
				<td>Email:</td>
				<td><input name="Email"  id="Email" type="text"  value="" size="37" maxlength="50" tabindex=5 onBlur="Javascript: fldCheck( 'E', 1, this );" /></td>
			</tr>
			 <tr align="left">
				<td>Confirm Email:</td>
				<td><input name="Emailconfirm"  id="Emailconfirm" type="text"   value="" size="37" maxlength="50" tabindex=6  onBlur="Javascript: emailCheck(this); " ></td>
			</tr>
			
          </tr>
            <td align="left">How did you hear about us:</td>
            <td align="left">
              <input type="text" name="Source" size="37" value="" tabindex=7 >
            </td>
          </tr>
          <tr>
            <td colspan="2" align="center" ><b>Comments</b></td>
          </tr>
          <tr>
            <td colspan="2" align="left" >
               <textarea name="Comments" id="Comments" rows=4 cols=37 tabindex=8 ></textarea>
            </td>
          </tr>
          <tr>
            <td colspan="2" align="center">
                   <input type="submit" name="submit" value="Send it!">
				   <input type="button" id="resetBtn" value="Reset" onClick="Javascript: document.myForm.reset();"/>
              </td>
           </tr>
			
		</table>

		    </form>
		</center>
    </div>

    <script language="Javascript">
		 var req_flds =  { 'First_name':'First Name', 'Last_name':'Last Name', 'Email':'Email', 'Emailconfirm':'Confirm Email', 'Comments':'Comments' };

		 function init(){
	 		var name = document.forms[1].name; // alert( 'Form[ '+document.forms.length+' ] '+document.forms[1].name );
			formReset(name);
		}
		

        init();
		
	</script>
	 -->
