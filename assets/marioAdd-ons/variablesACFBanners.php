<?php

if( have_rows('banners', 1014) ):

//Get vaiable from banner pg
		while( have_rows('banners', 1014) ): the_row();

//If im category get all data
if(get_sub_field('banner_location') == "Category")
	{

				//if my category id is = to the one I choose on the site then show
				if (in_array($category_id, get_sub_field('category_choose')))
				{
					//echo get_sub_field('banner_code'); // puet one banner
					$BannerArray[] =  get_sub_field('banner_code');
				}
}
	endwhile;
 endif;

//get the array of banners and put them random
$rand_Banner = $BannerArray[ array_rand( $BannerArray ) ];
