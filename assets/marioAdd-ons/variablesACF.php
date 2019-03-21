<?php
$rows = get_field('paisDetalle' );
$country1      = $rows[0];
$country2      = $rows[1];
$country3      = $rows[2];
$country4      = $rows[3];
$country5      = $rows[4];
$country6      = $rows[5];
$country7      = $rows[6];

$BelizeTitle        = $country1['paisTitulo' ];
$BelizeDetalle      = $country1['paiscomentario' ];

$GuatemalaTitle     = $country2['paisTitulo' ];
$GuatemalaDetalle   = $country2['paiscomentario' ];

$SalvadorTitle      = $country3['paisTitulo' ];
$SalvadorDetalle    = $country3['paiscomentario' ];

$HondurasTitle      = $country4['paisTitulo' ];
$HondurasDetalle    = $country4['paiscomentario' ];

$NicaraguaTitle     = $country5['paisTitulo' ];
$NicaraguaDetalle   = $country5['paiscomentario' ];

$CrTitle            = $country6['paisTitulo' ];
$CrDetalle          = $country6['paiscomentario' ];

$PnTitle            = $country7['paisTitulo' ];
$PnDetalle          = $country7['paiscomentario' ];


///               Section 2 y 3 del home
//////////////////////////////////////////////////////
$sec2_title           = get_field('sec2_title');
$sec2_Content         = get_field('sec2_postContent');

$postsFeatured          = get_field('featured');
$featuredprincipal      = get_field('featuredprincipal');

$featured_horizontales = get_field('featured_horizontales');

///               Section2 y 3 del home
//////////////////////////////////////////////////////
?>
