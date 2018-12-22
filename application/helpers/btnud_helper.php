<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function btnud($text)
{
    $text = ("<button type='button' class='btn btn-sm btn-warning btn-flat' data-toggle='tooltip' data-placement='top' title='Edit' onclick='edit_data(".$text.")'><i class='glyphicon glyphicon-pencil'></i></button>
    	<button type='button' class='btn btn-sm btn-danger btn-flat' data-toggle='tooltip' data-placement='top' title='Hapus' onclick='hapus_data(".$text.")'><i class='glyphicon glyphicon-trash'></i></button>");
 
    return $text;
}

function btnu($text)
{
    $text = ("<button type='button' class='btn btn-sm btn-warning btn-flat' data-toggle='tooltip' data-placement='top' title='Edit' onclick='edit_data(".$text.")'><i class='glyphicon glyphicon-pencil'></i></button>");
 
    return $text;
}
 
?>