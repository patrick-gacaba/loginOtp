$(function(){
    $("#loginButton").click(function(){

        var email= $("#password").val();
        var password = $("#password").val();
        var token = $("#csrf").val();


       $.ajax({
        url:'/verifyUser',
        type:'POST',
        data:{
            _token:token,
            
            email:email,
            password:password},

        success:function(result){
            var result = JSON.parse(result);
            // alert(result);
            if(result.statusCode == 200){
                    $("#loginform").removeClass('show');
                    $("#loginform").addClass('hide');
                    $("#otpdiv").removeClass('hide'); 
                    $("#otpdiv").addClass('show'); 
                    }
            else{
                alert("something wrong... please try later");
            }
        }
       })
    })

    $("#otpSubmit").click(function(){
        var otp = $("#otp").val();
        otp = otp.trim();
        var token = $("#csrf").val();
        console.log("---",otp);

        $.ajax({
            type:"post",
            url:'/verifyUser',
            data:{
                _token:token,
                otp:otp
            },
            success:function(otpResult){
                otpResult = JSON.parse(otpResult);
                if(otpResult.statusCode == 200){
                    location.replace("/login");
                }
                else{
                    alert("otp not match. Please try again");
                }
            }
        })
    })
})














