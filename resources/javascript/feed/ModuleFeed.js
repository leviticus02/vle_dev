//this is importing react framework
import React from "react";
import ModuleCard from "./ModuleCard";
import ModuleFeedForm from "./ModuleFeedForm";

class ModuleFeed extends React.Component {
	constructor(props){
		//super is calling constructor on parent class
		super(props);	
		//set state
		//initialise all data to null
		this.state = {
			data: null,
			current_user: null
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
	
	//component has mounted
	componentDidMount(){
		var module = this.getParameterByName("module");
		
		//ajax call to fill feed initially
		$.ajax({
			url: "/ajax/moduleFeed.php?module=" + module,
			type: "GET",
			dataType: "json",
			success: function(response) {
				//the response from the php pahe is a json encoded object stored as response
				//set state, two objects, data is storing the data.feed object from the ajax call
				this.setState({ 
					data: response.data.feed, 
					current_user: response.data.current_user
				});
			}.bind(this),
			error: function(xhr, status, error) {
				console.log(error);	
			}
		});	
	}
	
	
	handleSubmit(data){
		//this gets the submitted data and stores it as object
		var data = {
			module_code: this.getParameterByName("module"),
			post_body: data.post_body	
		};
		
		//this uses ajax to input data to database
		$.ajax({
			url: "/ajax/moduleFeedPost.php",
			type: "POST",
			data: data,
			dataType: "json",
			success: function(response) {
				
				//test if array is empty from set state
				if (this.state.data == null){
					//this means it's the first post
					var updatedPosts = [response];
				} else {
					// take the newly added data
					var updatedPosts = this.state.data.slice();
					
					//add to front of array so it's is at the top of feed
					updatedPosts.unshift(response);
				}
				
				//update the state object: data so it stores the new post and all old ones
				this.setState({ 
					data: updatedPosts
				 });
					
			}.bind(this),
			error: function(xhr, status, error) {
				console.log(error.toString());	
			}
		});
	}
	
	
	renderModuleCards(){
		//make sure current state.data is not empty before attempting to render
		if (this.state.data !== null) {
			//this will map the array
			//the function takes 2 perameters, the first is the current item second is index of item
			//additional peram user added to feed current user object into modulecard property
			return this.state.data.map(function(post, index, user){
				return <ModuleCard user={this.state.current_user} key={index} post={post} />
			}.bind(this));
		}
	}

	render(){
	
		//get render function output components
		var ModuleCards = this.renderModuleCards();
		
		//render onto screen
		//we use bind to attach current object to handle submit function
		return(
				<div id="moduleFeedContainer">
					<ModuleFeedForm onSubmit={this.handleSubmit.bind(this)} />
					{ModuleCards}
				</div>
			);	
	}
	
}

//if we export we can then import into another file
export default ModuleFeed;