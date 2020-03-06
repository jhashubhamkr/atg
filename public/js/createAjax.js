var emailReg=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var pinReg=/^\d+$/;
	var namePass=false;
	var emailPass=false;
	var pinPass=false;
	function checkPass() {
		if (namePass==true && emailPass==true && pinPass==true) {
			$("#submit").removeAttr("disabled");
		}else{
			$("#submit").attr("disabled","disabled");
		}
	}
	$("#name").change(function(){
		var val=$(this).val();
		if(val==""){
            $('.name-error').html("<small class='error'>Name cannot be empty</small>");
            namePass=false;
		}
		if(val.length>30){
            $('.name-error').html("<small class='error'>Name cannot be more than 30 characters</small>");
            namePass=false;
		}
		if(val.length>0 && val.length<=30){
            $('.name-error').html("");
            namePass=true;
		}
		checkPass();
	});
	$("#email").change(function(){
		var val=$(this).val();
		if(val==""){
            $('.email-error').html("<small class='error'>Email cannot be empty</small>");
            emailPass=false;
		}else if(!(emailReg.test(val))){
            $('.email-error').html("<small class='error'>Email format is incorrect</small>");
			emailPass=false;
		}
		if(emailReg.test(val)){
            $('.email-error').html("");
			emailPass=true;
		}
		checkPass();
	});
	$("#pincode").change(function(){
		var val=$(this).val();
		if(val==""){
            $('.pincode-error').html("<small class='error'>Pincode cannot be empty</small>");
            pinPass=false;
		}
		if(val.length!=6){
            $('.pincode-error').html("<small class='error'>Pincode must be 6 digits</small>");
			pinPass=false;
		}
		if(pinReg.test(val)==false){
            $('.pincode-error').html("<small class='error'>Pincode must be 6 digits</small>");
			pinPass=false;
		}
		if(val.length==6 && pinReg.test(val)==true){
            $('.pincode-error').html("");
			pinPass=true;
		}
		checkPass();
	});

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#userForm").submit(function(e){
        e.preventDefault();
        var name = $("input[name=name]").val();
        var email = $("input[name=email]").val()
        var pincode = $("input[name=pincode]").val();
        var url=$(this).attr('action');
        	$.ajax({
           	type:'POST',
           	url:url,
           	data:{name:name, email:email, pincode:pincode},
           	beforeSend: function(){
		        $('.loader-parent').css("display","block");
		    },
		    complete: function(){
		        $('.loader-parent').css("display","none");		        
		    },
           	success:function(data){
           		if(typeof(data)==="string"){
           			data=JSON.parse(data);
           		}
				$("#submit").attr("disabled","disabled");
              	if(data.status==1){
              		$("#success-message").html("<div class='success-message'>"+data.message+"</div>");
              		$("input[name=name]").val("");
        			$("input[name=email]").val("")
        			$("input[name=pincode]").val("");
              		$('.name-error').html("");
              		$('.email-error').html("");
              		$('.pincode-error').html("");
              		namePass=false;
					emailPass=false;
					pinPass=false;
              	}else{
              		checkPass();
              		$("#success-message").html("");
              		if(data.errors.name==null){
              			$('.name-error').html("");
              		}else{
              			$('.name-error').html("<small class='error'>"+data.errors.name[0]+"</small>");
              		}
              		if(data.errors.email==null){
              			$('.email-error').html("");
              		}else{
              			$('.email-error').html("<small class='error'>"+data.errors.email[0]+"</small>");
              		}
              		if(data.errors.pincode==null){
              			$('.pincode-error').html("");
              		}else{
              			$('.pincode-error').html("<small class='error'>"+data.errors.pincode[0]+"</small>");
              		}
              	}
           }
        });       
	});