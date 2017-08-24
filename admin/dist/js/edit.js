$('#editInfo').click(function(){
//Get current variables
var courseName = $('#courseName');
var courseAuth = $('#courseAuthor');
var courseDesc = $('#courseDesc');
var coursePrice = $('#coursePrice');
var editButton = $('#edit');


courseName.html("<input type='text' name='courseName' id='courseNameText' value='"+courseName.text()+"' class='form-control' />");
coursePrice.html("<input type='text' id='coursePriceText' value='"+price+"' class='form-control' />");
courseDesc.html("<textarea id='courseDescText' class='form-control name='courseDescText' rows='10'>"+courseDesc.text()+"</textarea>");
editButton.html("<button class='btn btn-success' id='saveCourseInfo'>Save</button>");

// Enable navigation prompt
window.onbeforeunload = function() {
    return true;
};


});


$(document).on("click", "#saveCourseInfo", function ()
{
	//Post the data to the save form
	$.post('./dist/js/ajax/editCourse.php', {act: 'updateCourse', id: id, name: $('#courseNameText').val(), price: $('#coursePriceText').val(), desc: $('#courseDescText').val()}, function(data){
		if(data == "Updated")
		{
		 $('#courseName').html($('#courseNameText').val());
		 $('#coursePrice').html($('#coursePriceText').val());
		 $('#courseDesc').html($('#courseDescText').val());
		 $('#editInfo').html("<a id='editInfo'><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></a>");
		}else
		{
			console.log(data);
		}
	});



	//Allow the user to click away. 
	window.onbeforeunload = null;
});