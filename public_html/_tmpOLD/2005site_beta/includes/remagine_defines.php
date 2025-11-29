<?
        // Site array controls each section. REMAGINE by Ian Ricci
	$site = array ( 'home'=>array
                                        (
                                        'home'         => '/home/remagine/public_html/includes/home.php',
                                        ),
                        'services'=>array
                                        (
                                        'services'         => '/home/remagine/public_html/includes/services.php',
                                        ),
                        'mission'=>array
                                        (
                                        'mission'         => '/home/remagine/public_html/includes/mission.php',
                                        ),
                        'showcase'=>array
                                        (
                                        'showcase'         => '/home/remagine/public_html/includes/showcase.php',
                                        ),
                        'aboutus'=>array
                                        (
                                        'aboutus'         => '/home/remagine/public_html/includes/aboutus.php',
                                        ),
			'contact'=>array
                                        (
                                        'contact'         => '/home/remagine/public_html/includes/contact.php',
                                        ),
                      );

        $services = array( '1=>test1','2=>test2','3=>test3' );
        $section = $_REQUEST['section'] ? $_REQUEST['section'] : (($_SESSION['mb'] || $mb) ? 'home' : 'home');
        $page = $_REQUEST['page'] ? $_REQUEST['page'] : key($site[$section]);
?>
