/**
 * fitnessMaps.js
 *
 * copyright James Little 2009
 *
 * Author: James Little
 * Version: $Id: fitnessMaps.js 32 2009-03-12 02:07:49Z alphafoobar $
 */

//http://maps.forum.nu/gm_plot.html
//http://mapki.com/wiki/Knowledge_Base#Developer_Tools
//http://particletree.com/gmaps/workoutTracker.php
//http://code.google.com/apis/maps/documentation/reference.html
var map = null;
var geocoder = null;
var lastPoint = null;

/**
 * A linked list seems to make more sense...
 */
function MarkerLinkedList()
{
	this.count = 0;
	this.lastMarker = null;
	this.firstMarker = null;
}

/**
 * Adds a marker
 */
MarkerLinkedList.prototype.addPoint = function(point) 
{
	var marker = createPointMarker(point);
	var polyline = null;
	if(null != this.lastMarker){
		var points = [this.lastMarker.getLatLng(), point];
		polyline = new GPolyline(points, "#0000ff",3,1);
		map.addOverlay(polyline);
		
		// make it a linked list
		marker.nextMarker = null;
		marker.prevMarker = this.lastMarker;	
		this.lastMarker.polylineNext = polyline;
		this.lastMarker.nextMarker = marker;
		marker.polylinePrev = polyline;
		marker.polylineNext = null;
	}
	else
	{
		marker.prevMarker = null;
		marker.polylinePrev = null;
	}
	map.addOverlay(marker);
	this.lastMarker = marker;
	if(this.count == 0)
	{
		this.firstMarker = marker;
	}
	this.count++;
	return marker;
}

/**
 * Adds a marker
 */
MarkerLinkedList.prototype.removeMarker = function(marker) 
{
	this.count--;
	map.removeOverlay(marker);
	map.removeOverlay(marker.polylinePrev);
	this.lastMarker = marker.prevMarker;
	this.lastMarker.polylineNext = null;
	this.lastMarker.nextMarker = null;
}

/**
 * Adds a marker
 */
MarkerLinkedList.prototype.removeLast = function() 
{
	this.count--;
	marker = this.lastMarker;
	map.removeOverlay(marker);
	map.removeOverlay(marker.polylinePrev);
	this.lastMarker = marker.prevMarker;
	return this.lastMarker;
}

PathPoints.prototype.getLast = function() 
{
	return this.lastMarker;
}

MarkerLinkedList.prototype.length = function() 
{
	return this.count;
}

MarkerLinkedList.prototype.toString = function() 
{
	var path = "[";
	for(var marker = this.firstMarker; null != marker; marker = marker.nextMarker)
	{
		path += "["+marker.getLatLng().lat()+","+marker.getLatLng().lng()+((null!=marker.nextMarker)?"],":"]");
	}
	path += "]"
	return path;
}

/**
 * Returns distance in meters
 */
MarkerLinkedList.prototype.getDistance = function() 
{
	var dist = 0;
	for(var marker = this.firstMarker; null != marker; marker = marker.nextMarker)
	{
		if(null != marker.nextMarker)
		{
			dist += marker.getLatLng().distanceFrom(marker.nextMarker.getLatLng());
		}
	}
	return Math.round(dist);
}

	
/**
 * I'm not using the array.. linked list is easier.
 */
function PathPoints() {
	this.count = 0;
	this.polylineArray = new Array();
}

		
/**
 * Adds a point, line duple.
 */
PathPoints.prototype.addPoint = function(point, polyline) 
{	
	this.polylineArray[this.count] = { point: point, polyline: polyline };
	this.count++;
}

PathPoints.prototype.removeLastPoint = function() 
{
	var temp = null;
	if(this.count > 0)
	{
		this.count--;
		temp = this.polylineArray[this.count];
		if(temp.polyline)
		{
			map.removeOverlay(temp.polyline);
		}
		this.polylineArray[this.count] = null;
	}
	return temp;
}

PathPoints.prototype.getLastPoint = function() 
{
	var temp = null;
	if(this.count > 0)
	{
		temp = this.polylineArray[this.count-1];
		if(null != temp)
		{
			return temp.point;
		}
	}
	return temp;
}

PathPoints.prototype.length = function() 
{
	return this.count;
}

PathPoints.prototype.toString = function() 
{
	var path = "[";
	for(var i=0; i<this.count; i++)
	{
		path += "["+this.polylineArray[i].point.lat()+","+this.polylineArray[i].point.lng()+((i+1<this.count)?"],":"]");
	}
	path += "]"
	return path;
}

/**
 * Returns distance in meters
 */
PathPoints.prototype.getDistance = function() 
{
	var dist = 0;
	for(var i=1; i<this.count; i++)
	{
		dist += this.polylineArray[i-1].point.distanceFrom(this.polylineArray[i].point);
	}
	return Math.round(dist);
}	

var pathpoints = new MarkerLinkedList();
var started = false;

   function initialize(location, lat, lng) {
     if (GBrowserIsCompatible()) {
       map = new GMap2(document.getElementById("map_canvas"));
	//map.addControl(new GLargeMapControl());
	map.addControl(new GMapTypeControl());
	//map.addControl(new GScaleControl());
	if(location){
		// if location then also lat lng?!
		point = new GLatLng(lat, lng);
		map.setCenter(point, 13);
		marker = new GMarker(point);
       	map.addOverlay(marker);
      		marker.openInfoWindowHtml(location);
	} else {
		map.setCenter(new GLatLng(0, 0), 1);
	}
       geocoder = new GClientGeocoder();      
	
	// hack to load the lines quickly
	new GPolyline([new GLatLng(0, 0),new GLatLng(0, 0)], "#0000ff",3,1);
	
	map.enableScrollWheelZoom();
	//map.addControl(new GMouseWheelControl());
	GEvent.addListener(map,"click", function(overlay, point) {     
	  //var myHtml = "The GPoint value is: " + map.fromLatLngToDivPixel(point) + " at zoom level " + map.getZoom();
	  //map.openInfoWindow(point, myHtml);
	  //map.addOverlay(createMarker(point, myHtml));
	  	  
		if(started)
		{
			pathpoints.addPoint(point);
		}
	});
	
	// bind a search control to the map, suppress result list
       // map.addControl(new google.maps.LocalSearch(), new GControlPosition(G_ANCHOR_BOTTOM_RIGHT, new GSize(10,20)));
	
	//showAddress(document.getElementById("address").value);
     }
   }

function startPath()
{
	started = true;
}

function removeLast()
{
	pathpoints.removeLast();
	// lastPoint = pathpoints.getLast();
}

function stopPath()
{
	started = false;
	var distanceEl = document.getElementById("distance");
	distanceEl.value = pathpoints.getDistance();
	var pathEl = document.getElementById("path");
	pathEl.value = pathpoints.toString();
}

/**
 * Creates our special point marker.. a little dot.
 */
function createPointMarker(point, i) 
{
	var tinyIcon = new GIcon(G_DEFAULT_ICON);
	tinyIcon.image = "images/red.png";
	tinyIcon.shadow = null;
	tinyIcon.iconAnchor = new GPoint(3, 3);
	tinyIcon.iconSize = new GSize(7, 7);
	
	var marker = new GMarker(point,{
		draggable: true,
		bouncy: false,
		icon: tinyIcon,
		dragCrossMove: false});
	marker.index = i;
	
	//GEvent.addListener(marker, "click", function() {
	 //   marker.openInfoWindowHtml(myHtml);
	//});
	GEvent.addListener(marker, "dragstart", function() {
	  map.closeInfoWindow();
	});
	GEvent.addListener(marker, "dragend", function() {
		//marker.openInfoWindowHtml("Just bouncing along..." + marker.getLatLng());
		if(null != marker.prevMarker)
		{
			map.removeOverlay(marker.polylinePrev);
			var points = [marker.prevMarker.getLatLng(), marker.getLatLng()];
			var polyline = new GPolyline(points, "#0000ff",3,1);
			map.addOverlay(polyline);
			marker.polylinePrev = polyline;
			marker.prevMarker.polylineNext = polyline;
		}
		
		if(null != marker.nextMarker)
		{
			map.removeOverlay(marker.polylineNext);
			var points = [marker.getLatLng(), marker.nextMarker.getLatLng()];
			var polyline = new GPolyline(points, "#0000ff",3,1);
			map.addOverlay(polyline);
			marker.polylineNext = polyline;
			marker.nextMarker.polylinePrev = polyline;
		}
	});
	lastPoint = point;
	return marker;
}

function createMarker(point, myHtml) {
	var marker = new GMarker(point,{
		draggable: true,
		bouncy: true,
		dragCrossMove: true});
	GEvent.addListener(marker, "click", function() {
	    marker.openInfoWindowHtml(myHtml);
	});
	return marker;
}

function windowWidth() {
	if (window.innerWidth) return window.innerWidth;
	if (document.documentElement && document.documentElement.clientWidth) return document.documentElement.clientWidth;
	return document.body.offsetWidth;
}

function windowHeight() {
	if (window.innerHeight) return window.innerHeight;
	if (document.documentElement && document.documentElement.clientHeight) return document.documentElement.clientHeight;
	return document.body.clientHeight;
}

   function showAddress(address, callbackFunction) {
     if (geocoder) {
	geocoder.getLocations(address, addAddressToMap);
	/* geocoder.getLatLng( address,drawPoint);*/
     }
   }

function drawPoint(point) {
	if (!point) {
		alert(address + " not found");
	} else {
		map.setCenter(point, 13);
		var marker = new GMarker(point);
		map.addOverlay(marker);
		marker.openInfoWindowHtml(address);
	}
}
	  
// addAddressToMap() is called when the geocoder returns an
   // answer.  It adds a marker to the map with an open info window
   // showing the nicely formatted version of the address and the country code.
   function addAddressToMap(response) {
     map.clearOverlays();
     if (!response || response.Status.code != 200) {
       alert("Sorry, we were unable to geocode that address");
     } else {
       place = response.Placemark[0];
       point = new GLatLng(place.Point.coordinates[1],
                           place.Point.coordinates[0]);
       marker = new GMarker(point);
       map.addOverlay(marker);
       marker.openInfoWindowHtml(place.address + '<br>' +
         '<b>Country code:</b> ' + place.AddressDetails.Country.CountryNameCode);
	
	map.setCenter(point, 13);
	// who would have thought that google would be using OASIS xAL?
	// map stuff: http://code.google.com/apis/maps/documentation/services.html#Geocoding_Object
	// stepping through this in JS Debugger is also useful.
       document.getElementById('location_name').value = place.address;
       document.getElementById('lat').value = place.Point.coordinates[1];
       document.getElementById('lng').value = place.Point.coordinates[0];
       document.getElementById('country').value = place.AddressDetails.Country.CountryName;
       // document.getElementById('country').value = place.AddressDetails.Country.CountryNameCode;
       adminArea = getAdminArea(place.AddressDetails.Country.AdministrativeArea);
    document.getElementById('city').value = adminArea;
       document.getElementById('postcode').value = place.AddressDetails.Country.AdministrativeArea.Locality.PostalCode.PostalCodeNumber;
     }
   }
   
   /**
    * Function uses xAL to return decreasing levels of accuracy. Depending on 
    * how accurate the provided information has been. 
    *
    * SubAdmin Locality, then Admin locality, finally admin area.
    */
   function getAdminArea(adminArea) {
   	result = null;
   	
   	if(adminArea.SubAdministrativeArea) {
    	result = adminArea.SubAdministrativeArea.Locality.LocalityName;
   	}
   	
   	if(!result) {
   		result = adminArea.Locality.LocalityName;
    }
    
   	if(!result) {
    	result = adminArea.AdministrativeAreaName;
    }
    
    return result;
   }

