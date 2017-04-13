function Ymd_format(str,inpt){
	if (str.length == 2){
		$(inpt).val(str+"/"); 
	} else if (str.length == 5){
		$(inpt).val(str+"/");
	} 
};

function format_time(str,inpt){
	if (str.length == 2){
		$(inpt).val(str+":"); 
	} else if (str.length == 5){
		$(inpt).val(str+" ");
	} 
};

function AustralianDate_Input_Format(inputdate){
	$(inputdate).keyup(function(){
			Ymd_format($(inputdate).val(),inputdate);
		});
		$(inputdate).keypress(function(){
			Ymd_format($(inputdate).val(),inputdate);
		});
		$(inputdate).blur(function(){
			Ymd_format($(inputdate).val(),inputdate);
		});
};

function Time_Format(inputtime){
	$(inputtime).keyup(function(){
			format_time($(inputtime).val(),inputtime);
		});
		$(inputtime).keypress(function(){
			format_time($(inputtime).val(),inputtime);
		});
		$(inputtime).blur(function(){
			format_time($(inputtime).val(),inputtime);
		});
};
