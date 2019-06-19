$('#loginButton').click(function(){
  var email= $("#email").val();
  var password = $("#password").val();

let login=$(this).val();
console.log("login", login);

$.ajax({
type:'post',
url:'/verifyUser',
 headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
data:{
	email:$('#email').val(),
	password:$('#password').val(),
},
         success:function(data){
           console.log("data", data);
           if(data.status=="ok"){
                    $("#loginform").removeClass('show');
                    $("#loginform").addClass('hide');
                    $("#otpdiv").removeClass('hide'); 
                    $("#otpdiv").addClass('show'); 

           }
           else{
                alert("something wrong... wrong email or password");
            }

       },

        error:function(xhr, errmsg, err){

           console.log("mistake ajax");
           //alert("something went wrong");
           console.log("error", xhr);
           console.log("register", errmsg);
           console.log("wrong", err)
       }



});
	


$("#otpButton").click(function(){
        var otp = $("#otp").val();
        

        // let otp=$(this).val();
        console.log("---",otp);

        $.ajax({
            type:"post",
            url:'/verifyOtp',
            headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
            data:{
                otp:$('#otp').val(),
            },
            success:function(data){
                console.log("data", data);
                if(data.status=="ok"){
                    location.replace("/nav");
                }
                else{
                    alert("otp didnt not match. Please try again");
                }
            },
            error:function(xhr, errmsg, err){

           console.log("mistake ajax");
           //alert("something went wrong");
           console.log("error", xhr);
           console.log("register", errmsg);
           console.log("wrong", err)
       }

        })
    })


});

