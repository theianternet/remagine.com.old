<?
        // Site array controls each section. REMAGINE by Ian Ricci
	$site = array ( 'home'=>array
                                        (
                                        'home'         => 'includes/home.php',
                                        ),
                        'datam'=>array
                                        (
                                        'datam'         => 'includes/datam.php',
					),
			'aboutus'=>array
                                        (
                                        'aboutus'         => 'includes/aboutus.php',
                                        ),
                        'testtelecom'=>array
                                        (
                                        'testtelecom'         => 'includes/testtelecom.php',
                                        ),

                        'affiliates'=>array
                                        (
                                        'affiliates'         => 'includes/affiliates.php',
                                        ),

                        'contact'=>array
                                        (
                                        'contact'         => 'includes/contact.php',
                                        ),

                        'support'=>array
                                        (
                                        'support'         => 'includes/support.php',
                                        ),
                        'isolutions'=>array
                                        (
                                        'isolutions'         => 'includes/isolutions.php',
                                        ),
                        'telecom'=>array
                                        (
                                        'telecom'         => 'includes/telecom.php',
                                        ),
                        'mission'=>array
                                        (
                                        'mission'         => 'includes/mission.php',
                                        ),
                        'services'=>array
                                        (
                                        'services'         => 'includes/services.php',
                                        ),

			'press'=>array
                                        (
                                        'press'         => 'includes/press.php',
                                        ),
);

        $section = $_REQUEST['section'] ? $_REQUEST['section'] : (($_SESSION['mb'] || $mb) ? 'home' : 'home');
        $page = $_REQUEST['page'] ? $_REQUEST['page'] : key($site[$section]);
?>
