$(document).ready(function(){
	var linhas = $('.memberTableLine');
	linhas.each(function(index, value){
		//value is the actual line being 'looped'
		var lineLastTD = value.children[value.children.length-1]; // the last HTML ellement on the line
		var button = lineLastTD.children[lineLastTD.children.length-1]; // the last HTML ellement on the lineLastTD
		var link = button.getAttribute("diretion"); // get the link to delete user
		console.log(link);
		var buttonAsJqueryObj = $(button); // creating a jQuery object from the HTML ellement button to let's use 'popover'
		var div = $("<div>", {class: "btn-group"}); // create a new 'div' jQuery HTML Object 
		var anchor = $("<a>", {href: link, text: "Sim"}); // create a new 'a' jQuery HTML Object 
		var sim = $("<button>", {type: "button", class: "btn btn-default link"}); // create a new 'button' jQuery HTML Object 
		sim.append(anchor); // append the 'a' to the yes button
		var nao = $("<button>", {type: "button", class: "btn btn-default", text: "Não"}); // create a new 'button' jQuery HTML Object 
		nao.click(function(){ //set the 'onclick' method of the 'not' button to toggle the respective popover
	   		buttonAsJqueryObj.popover('toggle');
		});
		div.append(sim); // append the 'yes' button to the 'div'
		div.append(nao); // append the 'not' button to the 'div'
		buttonAsJqueryObj.popover({ // create the popover on the respective button
			animation: true,
			content: div,
			html: true
		});	
	});
});
