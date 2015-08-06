jQuery(document).ready(function() {
	InitImgPopUp();
		
	jQuery('.photo_set').each(function(){
		
		jQuery(this).montage({
			fillLastRow	: false,
			alternateHeight	: true,
			alternateHeightRange : {
				min	: 100,
				max	: 100
			},
			fixedHeight: 100,
			margin : 1
		});	
	});
	

	
});

function InitImgPopUp(){
	jQuery(".clickable_img").each(function(){
		jQuery(this).fancybox({
	        helpers: {
	            title : {
	                type : 'float'
	            }
	        }
	    });			
	});	
}

ls.hook.add('ls_comments_load_after',function(){
	InitImgPopUp();
});
ls.hook.add('ls_comment_inject_after',function(){
	InitImgPopUp();
});
ls.hook.add('ls_comments_add_after',function(){
	InitImgPopUp();
});

ls.hook.inject (
	[ls,'ajaxUploadImg'], 
	"jQuery('#sToLoad').val(sToLoad);",
	'ajaxUploadImgBefore'
);

