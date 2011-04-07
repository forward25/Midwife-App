<html>
	<head>
		<script type='text/javascript' src='https://www.google.com/jsapi'></script>
		<script type='text/javascript'>
			google.load("jquery", "1.5.2");
			google.load('visualization', '1', {packages:['geomap']});
			google.setOnLoadCallback(drawVisualization);			
			function drawVisualization() {
				//auth with facebook
				FB.init({apiKey:'fe16e8696c59ccfad53c70a51df4a079'});
				FB.Canvas.setAutoResize();//auto extend the height of the iframe
				
				
				
				//request spreadsheet
				var query = new google.visualization.Query('https://spreadsheets.google.com/ccc?key=0ApT3nLwQu_ugdFZEZHRRUnBfUUZwQ0U4RzZiRy1RckE&hl=en');
				query.send(handleQueryResponse);
			}
			function handleQueryResponse(response) {
				//check for error
				if (response.isError()) {
					alert('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
					return;
				}
				//draw
				var data = response.getDataTable();
				visualization = new google.visualization.GeoMap(document.getElementById('visualization'));
				var options = {};
				options['dataMode'] = 'regions';
				options['width'] = 725;
				options['height'] = 600;
				options['colors'] = [0x0, 0x00FF00];
				google.visualization.events.addListener(visualization, 'drawingDone', function(region) {
					setTimeout(function(){
						$("#help").html('<h1>Select a country</h1>');
						$("#visualization").css('z-index', '0');
						$("#visualization2").css('z-index', '1');
					}, 2000);					
				});
				visualization.draw(data, options);				
				//click event
				google.visualization.events.addListener(visualization, 'regionClick', function(region) {
					//change zoomed region to region selected
					options['region'] = region.region;
					//draw to a second buffer and flip when drawing is done
					visualization2 = new google.visualization.GeoMap(document.getElementById('visualization2'));					
					google.visualization.events.addListener(visualization2,'drawingDone', function(){
						$("#help").html('<h1>Loading...</h1>');
						setTimeout(function(){
							$("#visualization").css('z-index', '0');
							$("#visualization2").css('z-index', '1');
							$("#help").html('');
						}, 2000);
					});
					visualization2.draw(data, options);					
					//TODO get amount of friends
					//var friends = 100;					
					
					
					
					//TODO find out boundaries in which to draw					
					
					//TODO place stick men inside
					//$("#animation").html('animation');
					
					//TODO fade random ones away based on friend count and mortality rate
					
					//TODO bring up dialog for click through/ i agree .etc
					//$("#doyouagree").html("showdialog");
				});			
			}
    </script>
  </head>
  <body>
	<div id="fb-root"></div>
	<script src="http://connect.facebook.net/en_US/all.js"></script>
	<div id="doyouagree" style="position:absolute;z-index:4"></div>
    <div id="animation" style="position:absolute;z-index:3"></div>
	<div id="help" style="position:absolute;z-index:2"><h1>Loading Map...</h1></div>
	<div id="visualization" style="position:absolute;z-index:1"></div>
	<div id="visualization2" style="position:absolute;z-index:0"></div>	
  </body>
</html>