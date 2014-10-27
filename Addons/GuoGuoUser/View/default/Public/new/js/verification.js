
//验证姓名，电话，地址
$(function(){
	//验证
				var  up_ts = $('<div class="input_ts_father"><div class="input_ts"><span class="ts_guide"></span><div class="ts_content"><div class="ts_expression"></div><span class="ts_text">亲，不能为空哦</span></div></div></div>'),
					up_ts_01 = $('<div class="input_ts_father"><div class="input_ts"><span class="ts_guide"></span><div class="ts_content"><div class="ts_expression"></div><span class="ts_text">亲，电话号码格式错误哦</span></div></div></div>');
				var reg =  /^1[34589]\d{9}$/,       //电话号码验证
					filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;    //邮箱验证
				var ts = $('.input_ts_father');
				$('.submit_input').focus(function(){
					$('.input_ts_father').hide();
				});
				//submit_input
				$('#b-submit').click(function(){
					if($('#name').val() == '')
					{
						//alert(222)
						$('#name').parent().append(up_ts);
						$('.input_ts_father').show();
						//ts.show();
						return false;
					}
					/*else if($('#address').text() == '')
					{
						$('#address').parent().append(up_ts);
						$('.input_ts_father').show();
						//ts.show();
						return false;
						
					}
					else if($('#tel').val() == '')
					{
						//alert(444)
						$('#tel').parent().append(up_ts);
						$('.input_ts_father').show();
						//ts.show();
						return false;
					}
					else if(!reg.test($('#tel').val()))
					{
						//alert(555)
						$('#tel').parent().append(up_ts_01);
						$('.input_ts_father').show();
						return false;
					}*/
					else
					{
						return true;	
					}

				})
				$('#b-submit1').click(function(){

					 if($('#address').text() == '')
					{
						$('#address').parent().append(up_ts);
						$('.input_ts_father').show();
						//ts.show();
						return false;
						
					}/*
					else if($('#tel').val() == '')
					{
						//alert(444)
						$('#tel').parent().append(up_ts);
						$('.input_ts_father').show();
						//ts.show();
						return false;
					}
					else if(!reg.test($('#tel').val()))
					{
						//alert(555)
						$('#tel').parent().append(up_ts_01);
						$('.input_ts_father').show();
						return false;
					}*/
					else
					{
						return true;	
					}

				})
				$('#b-submit2').click(function(){

					if($('#tel').val() == '')
					{
						//alert(444)
						$('#tel').parent().append(up_ts);
						$('.input_ts_father').show();
						//ts.show();
						return false;
					}
					else if(!reg.test($('#tel').val()))
					{
						//alert(555)
						$('#tel').parent().append(up_ts_01);
						$('.input_ts_father').show();
						return false;
					}
					else
					{
						return true;	
					}

				})
				

})

 