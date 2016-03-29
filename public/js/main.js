// JavaScript Document

$('#loginBtn').click(function(e){    
    $('#loginBtn').fadeOut('fast', function(){
        $('#loginOverlay').fadeIn('fast');
    });
});

$('#optionDiv1').click(function(e){    
    $('#optionDiv1').fadeOut('fast', function(){
        $('#optionForm1').fadeIn('fast');
    });
});

$('#optionDiv2').click(function(e){    
    $('#optionDiv2').fadeOut('fast', function(){
        $('#optionForm2').fadeIn('fast');
    });
});


$(document).mouseup(function (e)
{

	
	var container = $("#loginOverlay");
	var button = $("#loginFormContainer");

    if (container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.hide();
		$('#loginBtn').fadeIn('fast');
    }
	
	var container = $("#regForm");
	var button = $("#registration_form");

    if (container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.hide();
		$('#btn3').fadeIn('fast');
    }
	
	
	var container = $("#modalAlert");

    if (container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0 ||
		!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.hide();
    }
	
});



var fixmeTop = $('#sidePanel').offset().top;       // get initial position of the element

$(window).scroll(function() {                  // assign scroll event listener

    var currentScroll = $(window).scrollTop(); // get current position
	var viewWidth = $(window).width();
	var width = null;
	
	if (viewWidth > 1500){
		width = '253px';
	}else{
		width = '16.5%';	
	}

    if (currentScroll >= fixmeTop - 20) {           // apply position: fixed if you
        $('#sidePanel').css({                      // scroll to that element or below it
            position: 'fixed',
            top: '0',
			"max-width":width
        });
		
    } else {                                   // apply position: static
        $('#sidePanel').css({                      // if you scroll above it
            position: 'relative',
			"max-width":'22%'
        });
    }

});


function del(id, type, extra1, extra2){
	$.ajax({
		url: "includes/delete.php?id=" + id + "&type=" + type + "&extra1=" + extra1 + "&extra2=" + extra2,
		type: "POST",
		dataType: "json",
		content: "",
		cache: true,
		success: $("#id" + id).fadeOut(),
		error: function(xhr, status, error) {
			console.error(xhr, status, error.toString());	
		}
	});
}

function rep(id, parent){
	$.ajax({
		url: "ajax/reply.php?id=" + id + "&parent=" + parent,
		type: "POST",
		dataType: "json",
		content: "",
		cache: true,
		success: function(name) {
			//$('#replyUser' + parent).html('Replying to ' + name + '');
			document.getElementById('replyPost' + parent).placeholder='Replying to ' + name + '';
			document.getElementById("replyTo" + parent).value = id;	
		},
		error: function(xhr, status, error) {
			console.error(xhr, status, error.toString());	
		}
	});
}

$("#courseFilter").keyup(function(){
 
        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val(), count = 0;
 
        // Loop through the comment list
        $(".courselist li").each(function(){
 
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
 
            // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).show();
                count++;
            }
        });
 
        // Update the count
       // var numberItems = count;
        //$("#filter-count").text("Number of Comments = "+count);
    });
	
$("#memberFilter").keyup(function(){
 
        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val(), count = 0;
 
        // Loop through the comment list
        $(".memberList li").each(function(){
 
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
 
            // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).show();
                count++;
            }
        });
 
        // Update the count
       // var numberItems = count;
        $("#filter-count").text("Results : "+ count);
    });
	




// arguments are jquery selectors of search field and select field respectively
// third parameter is name of array to save the option fields, shuld be unique
function bind_select_search(srch, select, arr_staff) {    
    window[arr_staff] = []
    $(select + " option").each(function(){                    
          window[arr_staff][this.value] = this.text
    })
	
    $(srch).keyup(function(e) {
        text = $(srch).val()

        if (text != '' || e.keyCode == 8) {
              arr = window[arr_staff]
              $(select + " option").remove()    
			  console.log(window[arr_staff]);                     
            tmp  = ''
            for (key in arr) {
                option_text = arr[key].toLowerCase()
                if (option_text.search(text.toLowerCase()) > -1 ) {                     
                    tmp += '<option value="'+key+'">'+ arr[key] +'</option>'
                }
            }
            $(select).append(tmp)
         }
     })
	 
    $(srch).keydown(function(e) {
            if (e.keyCode == 8) // Backspace
                $(srch).trigger('keyup')
    })
          
};

$(document).ready(function() {
   bind_select_search('#srch', '#staffName', 'staff_option');
});


function bind_select_search_course(srch, select, arr_course) {    
    window[arr_course] = []
    $(select + " option").each(function(){                    
          window[arr_course][this.value] = this.text
    })
    $(srch).keyup(function(e) {
        text = $(srch).val()
        if (text != '' || e.keyCode == 8) {
              arr = window[arr_course]
              $(select + " option").remove()   
			                         
            tmp  = ''
            for (key in arr) {
                option_text = arr[key].toLowerCase()
                if (option_text.search(text.toLowerCase()) > -1 ) {                     
                    tmp += '<option value="'+key+'">'+ arr[key] +'</option>'
                }
            }
            $(select).append(tmp)
         }
     })
    $(srch).keydown(function(e) {
            if (e.keyCode == 8) // Backspace
                $(srch).trigger('keyup')
    })
          
};

$(document).ready(function() {
   bind_select_search_course('#srchCourse', '#courseSelect', 'options');
});

$(function(){
    $("#feedUploadAlias").on('click', function(e){
        e.preventDefault();
        $("#feedUp:hidden").trigger('click');
    });
});

