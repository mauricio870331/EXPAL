<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps JavaScript API Example</title>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyAPIlA-pb3Kylm_NmU4UI7MtlZ9r9MYT1w"
      type="text/javascript"></script>
    <script type="text/javascript">

    //<![CDATA[

    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
		
        map.addControl(new GMapTypeControl());
        map.addControl(new GLargeMapControl());
        map.addControl(new GScaleControl());
        map.addControl(new GOverviewMapControl());
        
        map.setCenter(new GLatLng(-19.435514, 48.603516), 5);
      
		map.setMapType(G_HYBRID_TYPE);
			
		function addtag(point, address) {
		var marker = new GMarker(point);
		GEvent.addListener(marker, "click", function() { marker.openInfoWindowHtml(address); } );
		return marker;
		}
		
		var point = new GLatLng(-19.000514,46.603516);
		var address = '<b>MADAGASCAR</b><br/><i>Centro de Madagascar</i><br /><a href="http://www.centrodemadagascar.com">Web del Centro de Madagascar</a>';
		var marker = addtag(point, address);
		
		map.addOverlay(marker);	
		  
      }
    }

    //]]>
    </script>
  </head>
  <body onload="load()" onunload="GUnload()">
    <div id="map" align="center" style="width: 500px; height: 500px"></div>
    <hr/>
    <a>Ejemplo desarrollado para&nbsp;</a><a href="http://www.maestrosdelweb.com">www.maestrosdelweb.com</a><a>&nbsp;por:</a>
    <p><p/>
    <a>Reynier Matos Padilla</a><br/>
    <a href="http://www.maestrosdelweb.com/autores/reynier-matos-padilla/">http://www.maestrosdelweb.com/autores/reynier-matos-padilla/</a>
  </body>
</html>