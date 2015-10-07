<?php


$default_markets = [
		[
		'market_name' => 'New York',
        'limit' => 4,
        'template' => '2_city_2' ,
		'market_id' => 1,
            'slug'=>'newyork',
		'url' => '/us/newyork',
		'description' => 'Celebrate New Year\'s in New York with a million of your closest friends. New York City is the worldwide destination for New Year\'s Eve revelers with more than 60 fabulous New Year\'s events showcasing NYC nightlife. The NYC New Year\'s event line up offers something for everyone, swanky and elite nightclubs, sophisticated lounges or just plain ... all-out ... downright fun parties for over and under 21.',
		'latitude' => '40.735747',
		'longitude' => '-73.99056',
	] ,

    [


        'market_name'=>'Times Square',
        'limit'=>3,
        'template' => 'city_3',
        'slug'=>'newyork',
        'url'=>'/us/timessquare',
        'description'=>'',
        'filters' => ['market_nbhd_id' => 449]



    ],

    [
        'market_name' => 'Philly',
        'market_id' => 9,
        'url' => '/us/philadelphia',
        'limit'=>4,
        'template' => 'city_4',
         'slug' => 'philadelphia',
        // 'images' => ['philly1.jpg' , 'philly2.jpg' ],
        'description' => 'The city of the Liberty Bell and brotherly love invites you to sample the delights of New Year\'s Eve done Philly style ... liberate your inner child and get that lov\'n feeling as you celebrate an unforgettable New Year in Philadelphia. Celebrate at the 2nd Annual Mega Party at Xfinity or at the best-of-the best of Philly\'s nightlife hotspots.',
        'latitude' => '39.951859',
        'longitude' => '-75.163651',
    ] ,
    [
       // 'logo' => 'city_boston.jpg'	,
        'slug' => 'boston',
//        'images' => ['boston1.jpg' , 'boston2.jpg' ],
        'market_name' => 'Boston',
        'url' => '/us/boston',
        'limit' => 4,
        'template' => '2_city',
        'market_id' => 2,
        'description' => 'Boston Common may be world famous, but there is nothing common about how Boston celebrates New Year\'s Eve. Its New Year\'s events are renowned for their boisterous fanfare. The Boston Tea Party may still inspire patriots, but today\'s Bostonians are proud to present a very unCOMMON lineup of New Year\'s events showcasing top nightlife venues.',
        'latitude' => '42.358544',
        'longitude' => '-71.065063',
    ] ,
    [
//		'logo' => 'city_chicago.jpg'	,
        'slug' => 'chicago',
//        'images' => ['chi1.jpg' , 'chi2.jpg', 'chi3.jpg' ],

		'market_name' => 'Chicago',
        'limit' => 2,
        'template'=>'1_city_1',
		'market_id' => 11,
        'url' => '/us/chicago',
		'description' => 'When it comes to nightlife and New Year\'s parties Chicago surely lives up to its name as the "windy city" ... not for the gusty wintry winds but for its reputation as braggarts ... and Chicago New Year\'s Eve events at some of the best nightlife hotspots are really something to brag and boast about.',
		'latitude' => '41.853196',
		'longitude' => '-87.648926',
	],

    // TODO : Add DC here

    [
//        'logo' => 'city_miami.jpg'	,
        'slug' => 'miami',
        'images' => ['city_miami.jpg'],
        'market_name' => 'Miami',
        'url'=>'/us/miami',
        'limit'=>1,
        'template' => 'city_1',
        'market_id' => 7,
        'description' => 'Unmatched in nightlife glitz and glamour Miami\'s New Year\'s parties are bold, flashy and frenzied attracting a chic, trendy international party crowd. The swish of swaying palm trees and the subtle ripple of sultry night breezes is quickly overwhelmed by the rhythm and bold beat of sizzling hot New Year\'s Eve parties in Miami.',
        'latitude' => '25.813277',
        'longitude' => '-80.122469',
    ] ,

	[
//		'logo' => 'city_losangeles.jpg'	,
        'slug' => 'losangeles',
//        'images' => ['la1.jpg' ],

		'market_name' => 'Los Angeles',
		'market_id' => 10,
        'url'=>'/us/losangeles',
        'limit'=>4,
        'template'=>'2_city_2',
		'description' => 'A New Year\'s Eve celebration in the City of Angels is nothing short of heavenly in L.A., the nightlife haven of the West Coast. Celebrate in the heart of Hollywood glamour and revel with fellow L.A. residents from all over town. West Hollywood\'s red carpet-worthy venues, Santa Monica\'s lounges and Beverly Hills hippest nightclubs are all yours this New Years Eve 2014 to party in true West Coast style.',
		'latitude' => '34.049246',
		'longitude' => '-118.258209',
	] ,



	// [
	// 	'logo' => 'city_vegas.jpg'	, 
	// 	'market_name' => 'Las Vegas',
	// 	'market_id' => 16,
	// 	'slug' => 'lasvegas',
	// 	'market_summary' => 'sunny miami Aenean in magna vitae tellus blandit aliquam ut id lorem. Sed vehicula purus sit amet lectus aliquam malesuada. Sed tempus, nisi interdum viverra consectetur, nibh tortor semper est, sed.',
	// ],

	

]; 
