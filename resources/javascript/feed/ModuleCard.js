import React from "react";
import ModuleFeedCommentForm from "./ModuleFeedCommentForm";
import ModuleFeedComment from "./ModuleFeedComment";

//the props are the properties of the returned rendered component
class ModuleCard extends React.Component{
	constructor(props){
		super(props);
		
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
	
	//component has mounted - for comments
	componentDidMount(){
		var module = this.getParameterByName("module");
		
		//ajax call to fill feed
		$.ajax({
			url: "/ajax/moduleFeedComments.php?module=" + module + "&parent=" + this.props.post.id,
			type: "GET",
			dataType: "json",
			success: function(response) {
				//the response from the php pahe is a json encoded object stored as response
				//set state, two objects, data is storing the data.feed object from the ajax call
				this.setState({ 
					data: response.data.feed, 
					current_user: response.data.current_user
				});
			}.bind(this)/*,
			error: function(xhr, status, error) {
				console.log(error);	
			}*/
		});	
	}
	
	
	handleSubmit(data){
		//this gets the submitted data and stores it as object
		var data = {
			module_code: this.getParameterByName("module"),
			post_body: data.post_body	
		};
		
		//this uses ajax to input data to database for comments
		$.ajax({
			url: "/ajax/moduleFeedComment.php?post=" + this.props.post.id ,
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
					
			}.bind(this)/*,
			error: function(xhr, status, error) {
				console.log(error.toString());	
			}*/
		});
	}
	
	
	renderOptions() {
		var post = this.props.post;
		var user = this.props.user;
		//user undefined after posts locally update
		if (user !== null){
			if (post.user_id == user.id) {
				//this will be  button
				return (
				<div id="Delete">
				<button id="edit">Edit</button>
				<button id="x">X</button>
				</div>
				);	
			}
		}
		
		return <div></div>;
	}
	
	
	//render comments
	renderModuleComments(){
		//make sure current state.data is not empty before attempting to render
		if (this.state.data !== null) {
			//this will map the array
			//the function takes 2 perameters, the first is the current item second is index of item
			//additional peram user added to feed current user object into modulecard property
			return this.state.data.map(function(comment, index, user){
				return <ModuleFeedComment user={this.state.current_user} key={index} comment={comment}  />
			}.bind(this));
		}
	}
	
	render(){
		var moduleComments = this.renderModuleComments();
		var post = this.props.post;
		var postOptions = this.renderOptions();
		
		
		//comment button on click ajax call to get comments 
		return (
			<div id="moduleCardCont">
            	<div id="moduleCard">
					{postOptions}
					<div id="postedBy">
						<a href={'profile.php?user=' + post.user.username}>{post.user.name}</a> 
						<span id="subText"> {post.date} </span> 
					</div> 
					<div id="postBody">{post.post_body} </div>
					<button id="moduleFeedComments">0 comments</button>
					<ModuleFeedCommentForm onSubmit={this.handleSubmit.bind(this)} />  
					{moduleComments}
				</div>
			</div>
		);	
	}
		
}

export default ModuleCard;