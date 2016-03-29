import React from "react";

class ModuleFeedComments extends React.Component{
	constructor(props){
		super(props);
		//set state
		this.state = {
				post_type : null,
				post_body : null	
		};
	}
	
	
	
	handlePostBody(e){
		
		var value = e.target.value == "" ? null : e.target.value;
		
		//this is creating a object from input
		this.setState({ post_body : value });
			
	}
	
	handleSubmit(e){
		e.preventDefault();
		
		this.refs.post_body.value = "";
		
		this.props.onSubmit(this.state);
		
		//this nullifies the ability to subit once submitted so no spamming
		this.setState({ 
			post_body: null
		 });
		 
	}
	
	
	render(){
		
		var disabled =  this.state.post_body == null;
		
		return(
			//bind this stuff too
			<div id="moduleFormCommentsCont">
				<form onSubmit={this.handleSubmit.bind(this)} id="moduleFeedComments">
					<input id="moduleFeedcommentInput" type="text" ref="post_body" onChange={this.handlePostBody.bind(this)} placeholder="Reply..." autoComplete="off" />
					<input id="moduleFeedCommentSubmit" disabled={disabled} type="submit" value="Post" />
				</form>
			</div>
		);	
	}
	
}

export default ModuleFeedComments;