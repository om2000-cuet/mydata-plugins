 
jQuery(document).ready(function(){

jQuery('input[type="button"]').on('click',function(){
var mydata_name = jQuery('input[name="name"]').val();
var mydata_email = jQuery('input[name="email"]').val();
var mydata_age = jQuery('input[name="age"]').val();
alert("hi om 1");
console.log(mydata_name,mydata_email,mydata_age);

jQuery.ajax({

    url: mydataAjax.ajaxurl,
type:"POST",
	contentType: "application/x-www-form-urlencoded;charset=UTF-8",
    data:{
    action: 'mydata',
    name: mydata_name,
    age: mydata_age,
    email: mydata_email,
    },
    
success: function(response){
jQuery("#showresult").html(response);
console.log(response);

}


});





});

});

 