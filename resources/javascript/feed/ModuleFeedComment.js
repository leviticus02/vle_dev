import React from "react";

class ModuleFeedComment extends React.Component{
	
	constructor(props){
		super(props);
	}
	
	renderOptions() {
		var comment = this.props.comment;
		var user = this.props.user;
		if (user !== null){
			if (comment.user_id == user.id) {
				//this will be  button
				return (
				<div id="commentOptions">
					<button id="edit">Edit</button>
					<button id="x">X</button>
				</div>
				);	
			}
		}
		
		return <div></div>;
	}
	
	render(){
		var postOptions = this.renderOptions();
		var comment = this.props.comment;
		
		return(
		<div id="commentCont">
			<div id="postedBy">
				<a href={'profile.php?user=' + comment.user.username}>{comment.user.name}</a> 
				<span id="subText"> {comment.date} | {postOptions}</span> 
			</div>
			<div id="postBody">{comment.comment_body} </div>
		</div>
		);
	}
	
	
}

export default ModuleFeedComment;