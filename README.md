#about
a simple php endpoint that calls an exchange endpoint that lets you get profile image. a demo website is included

#To use:
1. you can host this wherever php works .. e.g. heroku. 
2. edit the php file and set the host, user & password

		$host = "webmail.sapient.com";//fix
		$user = "TODO";//fix
		$password = "TODO";//fix

3. call it as shown in the javascript. you can see the markup in the demo.

		HTTP_GET: URL_TO/EWSProfileImageService.php?email=%EMAIL%&size=%EWSSIZE%
		
		EWSSize = {
			small: "HR48x48",
			regular: "HR360x360",
			big: "HR648x648"
		}
		
P.S. the php basically takes care of the NTLM authentication of the exchange server