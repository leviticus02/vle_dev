import React from "react";
import ReactDOM from "react-dom";
import DocFeed from "./docs/DocFeed";
import ModuleFeed from "./feed/ModuleFeed";

var url = location.hash;

//test if there is no hash, of not set url to '/'
var url = url === "" ? "/" : url;

//store routes as object, url/key
var routes = {
	"/": <ModuleFeed />,
	"#/feed": <ModuleFeed />,
	"#/docs": <DocFeed />
};

//initial render on page load
if (url in routes) {
	ReactDOM.render(routes[url], document.getElementById("moduleFeed"));
}

//function to activate hash change
function locationHashChanged() {
	
	var url = location.hash;
	
	if (url in routes) {
		ReactDOM.render(routes[url], document.getElementById("moduleFeed"));	
	}

}

//render quicklinks here

//event listener for hashchange
window.onhashchange = locationHashChanged;