<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Rename Mdl_perfectmodel to Mdl_[name]
class Mdl_store_items extends MY_Model
{

function __construct( ) {
    parent::__construct();

}

function get_table() {
	// table name goes here	
    $table = "store_items";
    return $table;
}

// Add custom model functions here
 


// David Connelly's work from mdl_perctmodel
// is in applications/core/My_Model.php which
// is extened here.



}