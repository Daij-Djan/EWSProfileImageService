//
//  EWSProfileImages.swift
//
//  Created by Dominik Pich on 7/8/16.
//  Copyright © 2016 Dominik Pich. All rights reserved.
//

function EWSProfileImages(host, proxy) {
    //setup our manager class
    this.host = host
    this.proxy = proxy
	
    //MARK: image loading

    this.get = function(email, imageSize) {
        if(!this.host && !this.proxy) {
            return null
        }

        //make object
        
        var baseUrl = "";
        if(this.proxy) {
	        baseUrl = this.proxy;
		}
		else {
	        baseUrl = "https://"+this.host+"/ews/Exchange.asmx/s/GetUserPhoto";
	    }
        var ewsUrl = baseUrl+"?email="+email+"&size="+imageSize;
    	profileImage = new EWSProfileImages.Image(email, imageSize, ewsUrl);
		
    	return profileImage
    }
}

//MARK: - objects & types

EWSProfileImages.State = {
	untried: 0,
	loading: 1,
	failed: 2,
	loaded: 3
}

EWSProfileImages.ImageSize = {
	small: "HR48x48",
	regular: "HR360x360",
	big: "HR648x648"
}
    
EWSProfileImages.Image = function(email, size, image_url) {
	this.email = email
	this.size = size
	this.image_url = image_url
}

//provide a shared instance
EWSProfileImages.shared = new EWSProfileImages(null)