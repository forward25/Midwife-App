<html>

    <div id="fb-root" name="fb-root"></div>
    <script src="http://connect.facebook.net/en_US/all.js"></script>
    <script>
        FB.init({
            appId  : '215359871811504',
            status : true, // check login status
            cookie : true, // enable cookies to allow the server to access the session
            xfbml  : true  // parse XFBML
        });
    </script>

    lol
    <script>
        FB.login(function(response) {
            if (response.session) {
                if (response.perms) {
                    // user is logged in and granted some permissions.
                    // perms is a comma separated list of granted permissions
                } else {
                    // user is logged in, but did not grant any permissions
                }
            } else {
                // user is not logged in
            }
        }, {perms:'user_about_me'});

    </script>
    <script>
        FB.api('/me/friends', function(response) {
            console.log(response);
        });
    </script>

</html>