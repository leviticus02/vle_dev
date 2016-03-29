//this is importing react framework
import React from "react";
import DocCard from "./DocCard";

class DocFeed extends React.Component {
	constructor(props){
		//super is calling constructor on parent class
		super(props);	
		//set state
		
		this.state = {
			data: null	
		};
	}
	
	getParameterByName(name, url) {
    	if ( ! url) { 
			var url = window.location.href;
		}
		
    	var name = name.replace(/[\[\]]/g, "\\$&");
		
    	var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)")
        var results = regex.exec(url);
		
    	if ( ! results) { 
			return null;
		}
		
    	if ( ! results[2]) {
			return '';
		}
		
    	return decodeURIComponent(results[2].replace(/\+/g, " "));
	}
	
	componentDidMount(){
		var module = this.getParameterByName("module");
		
		$.ajax({
			url: "/ajax/docFeed.php?module=" + module,
			type: "GET",
			dataType: "json",
			success: function(response) {
				this.setState({ data: response.data });
			}.bind(this),
			error: function(xhr, status, error) {
				console.log(error);	
			}
		});	
	}
	
	renderDocCards(){
		if (this.state.data !== null) {
			//this will map the array
			//the function takes 2 perameters, the first is the current item second is index of item
			return this.state.data.map(function(post, index){
				return <ModuleCard key={index} post={post} />
			});
		}
	}
	
	
	render(){
		//get render function output components
		var DocCards = this.renderDocCards();
		
		//render onto screen
		//we use bind to attach current object to handle submit function
		return(
				<div>
					Render docs here, file system by week, allow mods to upload
					{DocCards}
				</div>
			);	
	}
	
}

//if we export we can then import into another file
export default DocFeed;