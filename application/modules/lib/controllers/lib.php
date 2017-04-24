<?php
class Lib // extends MX_Controller 
{


// function __construct() {
//     parent::__construct();
// }

// mylib
function quit($output){
    exit('<h3>'.$output.'</h3>');
}

function checkArray( $array = array(), $exit){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    if( empty($exit) ){
        exit();  
    }
}

function checkField( $fld = null, $exit){
    echo "<h4>fld| ".$fld." |</h4>";
    if( empty($exit) ){
        exit();  
    }
}


function image_pagination( $imgDir ){
    $bm_pages = array();

    $dirHandle = opendir( './'.$imgDir );    
    while($file = readdir($dirHandle)){
        if ( $file != 'Thumbs.db' && $file != "." && $file != ".." ) {
            $bm_pages[] = $imgDir."/".$file;
         }
    }
    closedir($dirHandle);
    return $bm_pages;
}


function show_partial( $bm_pages, $page, $nav_to, $img_dir, $show_page, $img_hgt, $img_width, $dir_function = null ) {
    $x = 0;
    $get_link = 'Page: ';
    if( $dir_function == null ) $dir_function ='public_main';

    foreach( $bm_pages as $key => $value)
    {   
        $x++;
        if( $key == $show_page-1 ){
            echo '<img src="'.base_url().$bm_pages[$key].'" width="'.$img_width.'" height="'.$img_hgt.'"/>';
            $get_link .= '<a id="selected_page" href="'.base_url().'templates/'.$dir_function.'/'.$page.'/'.$nav_to.'/'.$img_dir.'/'.$x.'" >&nbsp;&nbsp;'.$x.' </a> ';                    
        }else{
            $get_link .= '<a id="page" href="'.base_url().'templates/'.$dir_function.'/'.$page.'/'.$nav_to.'/'.$img_dir.'/'.$x.'" >&nbsp;&nbsp;'.$x.' </a> ';
        }
    }
    // http://localhost/site4/templates/public_main/bluemass.php
    // http://localhost/site4/templates/public_blueMass/bluemass_pages.php/Blue-Mass/bm2005/2    

    $get_link .= '<a id="page" href="'.base_url().'/templates/public_main/bluemass.php ">&nbsp;&nbsp; Main Page</a>';

    return $get_link;
}


function checkPermission(){
    if(Token::check(Input::get('token')) === false && isset( $_SESSION["token"] )=== false ) {
        Session::endSession(); 
        Redirect::to('protected.php');
        exit();
    }
}


function displyMess($location,$divfloat){
    $filename = ABSPATH.'/members_admin/admin_utils/myfile.txt';
    if( file_exists($filename) &&  filesize($filename) ){
        $contents ='';
        $handle = fopen($filename, "r");
        $contents .= stripslashes(fread($handle, filesize($filename)));
        fclose($handle);
        
        return '<div style="float:'.$divfloat.'; width:580px; padding: 10px;  border: #000 solid 0px;">'.$contents.'</div>';    
        //return    $contents;
    }
    
}

function getToday(){
    $d = getdate(); // php funtion
    If( $d['mon']<10 ){$d['mon']="0".$d['mon'];}
    If( $d['mday']<10 ){$d['mday']="0".$d['mday'];} 
    return $d['mon']."-".$d['mday']."-".$d['year'];
}

function timeStamp(){
    // Return date/time info of a timestamp; then format the output
    $mydate=getdate(date("U"));
    return "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]"; 
}

function add_date($givendate,$day=0,$mth=0,$yr=0) {
      $cd = strtotime($givendate);
      $newdate = date('Y-m-d h:i:s', mktime(date('h',$cd),
    date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
    date('d',$cd)+$day, date('Y',$cd)+$yr));
      return $newdate;
}   

function days_till_expire( $exp_date ){
    //$date1 =  date("Y-m-d");
    $datetimeObj1 = new DateTime( date("Y-m-d") );
    $datetimeObj2 = new DateTime($exp_date);
    $dateDiff = $datetimeObj1->diff($datetimeObj2)->format('%R%a');   // to neg value use %R%a
    //$dateDays = $datetimeObj1->diff($datetimeObj2)->format('%a');   // to neg value use %R%a
    if($dateDiff <=0 )
        return $dateDiff;
    
}
    

function email($type, $temp_ecode, $temp_userid, $temp_pswrd){
    //$_SESSION
    $emailParam = DB::getInstance()->get('admin_emails', array( 'type', '=', trim($type) ) );
    
    if( !DB::getInstance()->error()){
        $to     = $_SESSION['email'].', supervisor@netcart-dev.com';
        foreach($emailParam->results()  as $key=>$emailDtl){
            $from   = $emailDtl->from;
            $subject= $emailDtl->subject;
            $message= $emailDtl->body;
        }
        $message = sprintf($message,DOMAIN_NAME,$temp_ecode, $temp_userid, $temp_pswrd);
    }else{
        errorLog("Email: {$type}");
        return false;   
    }

    // email notification of errors
    $admin   = 'admin@netcart-dev.com';
    $from    = "from: {$from}\r\n";
    $subject = "{$subject}\r\n";
    $message = "{$message}\r\n";
    $message = wordwrap($message, 70, "\r\n");
    
    mail($admin, $subject, $message, $from );
    mail($to, $subject, $message, $from);
    
}

function emailAlert($subject, $message){
    foreach($_SESSION as $key=>$value){
         $emailMess .= sprintf( "%'.-15s", $key ).". ".$value."\r\n";
    }
    $emailMess .="\r\n";
    // email notification of errors
    $message .= "{$emailMess}\r\n";
    $message = wordwrap($message, 90, "\r\n");
    
    mail('gx1157@yahoo.com', $subject, $message);
}

function errorLog($errorCode ){
    $dataDump = "|".$errorCode."|";
    foreach($_SESSION as $key=>$value){
         $dataDump .= $key." : ".$value."|";
    }
    $dataDump .= "eol:eol";
    
    $log = new Logging();
    // set path and name of log file (optional)
    $log->lfile('/home/mikesica/tmp/mylog.txt');

    // write message to the log file
    $log->lwrite($dataDump);
    $log->lclose();
    
    // email notification of errors
    $message = "{$errorCode} has occurred\r\n\r\nThe following information is recorded in the logs\r\n\r\n";
    $subject='An error has occurred at NJLEB website';
    emailAlert($subject, $message);
}
 
function confirmAction($errorMessage, $incFile){
    if( DB::getInstance()-> error()) {
        throw new Exception("Error from ".$incFile."[".$errorMessage."]");
    }
}


function escape($string) {
    return htmlentities($string);
}

// A function that strips harmful data.
function escape_data ($data) {
    $data = stripslashes($data);
    
    // This function escapes characters that could be used for sql injection
    $data = mysql_escape_string (trim($data));
    $data = strip_tags($data);

    // Return the escaped value.
     return $data;
}

// Function to get the client ip address  Author: http://techtalk.virendrachandak.com/author/virendrachandak/
function get_client_ip() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}


// written by Edgar Mkrtchyan - http://mkrtchyan.co.uk/checking-if-value-exists-in-a-multidimensional-array-with-php
function search_array($needle, $haystack) {
    if(in_array($needle, $haystack)) {
      return true;
    }
    foreach($haystack as $element) {
      if(is_array($element) && search_array($needle, $element))
           return true;
    }
    return false;
}

function SQLformat_date($date){
    $temp=$date[6].$date[7].$date[8].$date[9].'-'.$date[0].$date[1].'-'.$date[3].$date[4];
    return $temp;
}

function format_date($date){
    $temp=$date[5].$date[6].'/'.$date[8].$date[9].'/'.$date[0].$date[1].$date[2].$date[3];
    return $temp == '00/00/0000' ? null : $temp;
}

function close_window(){
    ?>
        <script language=JavaScript>
            window.opener.document.location.href="/members/admin/adm_mem_updt.php?div_id=Payments";
            self.close( );
        </script>
    <?php
    exit();
}

function getFieldHeader($getDbf){
    $sql = "SHOW FULL COLUMNS from {$getDbf}";
    $query = DB::getInstance()->doPDO()->query($sql);
    $query->setFetchMode(PDO::FETCH_OBJ);
    $nRows = $query->rowCount();
    // echo $getDbf." [ ".$nRows." field(s) ]<br />";
    
    while($result = $query->fetch()){
        $flds[$result->Field][0] = $result->Field;
        $flds[$result->Field][1] = $result->Comment;
        $flds[$result->Field][2] = $getDbf;
    }

    return $flds;
    
}

function jasonFieldHeader($getDbf){
    $sql = "SHOW FULL COLUMNS from {$getDbf}";
    $query = DB::getInstance()->doPDO()->query($sql);
    $query->setFetchMode(PDO::FETCH_OBJ);
    $nRows = $query->rowCount();
    // echo $getDbf." [ ".$nRows." field(s) ]<br />";
    
    $jsonData = '{';
    $x=0;

    while($result = $query->fetch()){
        $jsonData .= '"fld'.$x.'":{ "fld_name":"'.$result->Field.'","fld_type":"'.$result->Comment.'" },';
        $x++;
    }
    
    $jsonData = chop($jsonData, ",");
    $jsonData .= '}';
    return $jsonData;

}
    
function getSocial($id){
    $user_info = DB::getInstance()->get( 'user_info', array( 'id', '=', $id ) )->first();
    return $user_info->social;
}

function maskSocial($SocSec ){
    $crypt = new Cipher( Config::get('Cipher/Signature') );     
    $display = '**-***-'.substr($crypt->decrypt( $SocSec ),-4);
    return $display;
}

}