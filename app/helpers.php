<?php

use App\Model\Category;
use App\Model\Customer;
use App\Model\Expanse;
use App\Model\Invoice;
use App\Model\InvoiceDetail;
use App\Model\Payment;
use App\Model\PaymentDetail;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\Resource;
use App\Model\Supplier;
use App\Model\Unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

function bn2en($number){
	$en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0","AM","PM","am","pm","Jan","Feb","Mar","Apr","May","Jun",'Jul',"Aug","Sep","Oct","Nov","Dec");
	$bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০","এ.এম","পি.এম","এ.এম","পি.এম","জানুয়ারী","ফেব্রুয়ারী","মার্চ","এপ্রিল","মে","জুন","জুলাই","অগাস্ট","সেপ্টেম্বর","অক্টোবর","নভেম্বর","ডিসেম্বর"); 
	return str_replace($bn, $en, $number);
}

function en2bn($number) {   
	$en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0","AM","PM","am","pm","Jan","Feb","Mar","Apr","May","Jun",'Jul',"Aug","Sep","Oct","Nov","Dec");
	$bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০","এ.এম","পি.এম","এ.এম","জানুয়ারী","ফেব্রুয়ারী","মার্চ","এপ্রিল","মে","জুন","জুলাই","অগাস্ট","সেপ্টেম্বর","অক্টোবর","নভেম্বর","ডিসেম্বর"); 
	return str_replace($en, $bn, $number);
}



