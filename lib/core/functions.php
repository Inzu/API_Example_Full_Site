<?php

function INZU_GET($end_point, $args = false, $return = false){

$url = API_BASE.API_VERSION."/".$end_point."?";

if ( $args ) $url .= http_build_query($args);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_USERPWD, API_KEY . ":" . API_PASS);
$output = curl_exec($ch);

curl_close($ch);

	if ( !$return ) {
		
	return json_decode($output);
	
	} else if ( $return == "raw" ) {
	
	return $output;	
		
	} else if ( $return == "echo" ) {
		
	echo $output;	
		
	}	

}



function INZU_POST($end_point, $args, $return = false){

$url = API_BASE.API_VERSION."/".$end_point;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_USERPWD, API_KEY . ":" . API_PASS);
$output = curl_exec($ch);

curl_close($ch);

	if ( !$return ) {
		
	return json_decode($output);
	
	} else if ( $return == "raw" ) {
	
	return $output;	
		
	} else if ( $return == "echo" ) {
		
	echo $output;	
		
	}	

}



function site_map( ){
	
	///Create the website navigation based on your Inzu site map, this is optional.
	
	$inzu = INZU_GET("general/sitemap");

	$navigation = '<ul>';

	foreach( $inzu as $navigation_item ){

	//Build the navigation
	
		$link = page_views($navigation_item->type);
		
		$id=$navigation_item->id;
		
		if($link){
		$navigation .= '<li><a href="'.$link.'?id='.$id.'">'.$navigation_item->title.'</a>';
		} else {
		$navigation .= '<li>'.$navigation_item->title;
		}

		//If there is a 'child' element that means a sub-menu exists
		if( $navigation_item->child ){
			
			
			//Build the sub-menu
			$navigation .= '<ul class="sub_menu">';
			
			foreach( $navigation_item->child as $sub_menu_item ){
					
				$sub_link = page_views($sub_menu_item->type);
				
				///Send category for store sub-menus
				$cat=$sub_menu_item->category;
				
				$navigation .= '<li><a href="'.$sub_link.'?category='.$cat.'">'.$sub_menu_item->title.'</a></li>';
			}
			
			$navigation .= '</ul>';
		}		

		$navigation .= '</li>';
	}

	$navigation .= '</ul>';

	return $navigation;
}




function page_views($type){
	
		/****************************************
		Here we can assign different Inzu content types to different custom page views. This allows for a range of page design templates. If a page does not require a different design template you can simply use a generic page view file for multiple content types. Many sites will use the "Articles" content type for the majority of pages and a few extra page views. Here we are showing all available content types demonstration purposes.
		****************************************/
		
		
		switch( $type ){
			case('home'): 
				$link = '/home.php'; 
				break;
			case('about'): 
				$link = '/about.php'; 
				break;
			case('news'): 
				$link = '/news.php'; 
				break;
			case('articles'):
				$link = '/articles.php';
				break;
			case('events'):
				$link = '/events.php';
				break;
			case('gallery'):
				$link = '/gallery.php';
				break;
			case('people'):
				$link = '/people.php';
				break;
			case('video'): 
				$link = '/video.php'; 
				break;
			case('sound'):
				$link = '/sound.php';
				break;
			case('press'):
				$link = '/press.php';
				break;
			case('legal'):
				$link = '/legal.php';
				break;
			case('blog'):
				$link = '/blog.php';
				break;
			case('catalogue'):
				$link = '/catalogue.php';
				break;
			case('downloads'):
				$link = '/downloads.php';
				break;
			case('testimonials'):
				$link = '/testimonials.php';
				break;
			case('links'):
				$link = '/links.php';
				break;
			case('contact'):
				$link = '/contact.php';
				break;
			case('store'):
				$link = '/store/store.php';
				break;
			case('booking'):
				$link = '/booking.php';
				break;
			default: 
				$link = '';
				break;
		}
		
		return $link;
}

?>
