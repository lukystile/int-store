<?php
/*
 * Option Tree Functions
 */

/**
 * Menu Select option type.
 */
if ( ! function_exists( 'ot_type_menu_select' ) ) {

  function ot_type_menu_select( $args = array() ) {

    /* turns arguments array into variables */
    extract( $args );

    /* verify a description */
    $has_desc = $field_desc ? true : false;

    /* format setting outer wrapper */
    echo '<div class="format-setting type-menu-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
        /* build menu */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';
        /* get menu array */
        $menus = get_terms('nav_menu');
        /* has cats */
        if ( ! empty( $menus ) ) {
          echo '<option value="">-- ' . __( 'Choose One', 'juster' ) . ' --</option>';
          foreach ( $menus as $menu ) {
            echo '<option value="' . esc_attr( $menu->slug ) . '"' . selected( $field_value, $menu->slug, false ) . '>' . esc_attr( $menu->name ) . '</option>';
          }
        } else {
          echo '<option value="">' . __( 'No Menus Found', 'juster' ) . '</option>';
        }
        echo '</select>';
      echo '</div>';
    echo '</div>';

  }

}

/* Remove Color Property from Menu Font Color */
function filter_ot_color_fields_for_menu( $array, $field_id ) {
	if ( $field_id == 'menu_color' ) {
		$array = array(
			'Standard',
			'Active',
			'Hover',
		);
	}
	if ( $field_id == 'sub_menu_color' ) {
		$array = array(
			'Standard',
			'Active',
			'Hover',
		);
	}
	if ( $field_id == 'front_menu_color' ) {
		$array = array(
			'Standard',
			'Active',
			'Hover',
		);
	}
	if ( $field_id == 'front_sub_menu_color' ) {
		$array = array(
			'Standard',
			'Active',
			'Hover',
		);
	}
	return $array;
}
add_filter( 'ot_recognized_link_color_fields', 'filter_ot_color_fields_for_menu', 10, 2 );

/* Remove Typography Font For Menu Font */
function filter_ot_typography_fields_for_heading_font( $array, $field_id ) {
	if ( $field_id == 'menu_font' ) {
    $array = array(
		'font-family',
		'font-size',
		'font-style',
		'font-variant',
        'font-weight',
        'letter-spacing',
        'line-height',
        'text-decoration',
        'text-transform',
		);
	}

  return $array;
}
// add_filter( 'ot_recognized_typography_fields', 'filter_ot_typography_fields_for_heading_font', 10, 2 );

function filter_ot_recognized_font_families( $array, $field_id ) {
    $array = array(
		'Helvetica,+Arial' => 'Helvetica, Arial, sans-serif',
		'Courier' => 'Courier',
		'Tahoma,+Geneva' => 'Tahoma, Geneva, sans-serif',
		'Century Gothic,+sans-serif' => 'Century Gothic, sans-serif',
		'ABeeZee' => 'ABeeZee',
		'Abel' => 'Abel',
		'Abril+Fatface' => 'Abril Fatface',
		'Aclonica' => 'Aclonica',
		'Acme' => 'Acme',
		'Actor' => 'Actor',
		'Adamina' => 'Adamina',
		'Advent+Pro' => 'Advent Pro',
		'Aguafina+Script' => 'Aguafina Script',
		'Akronim' => 'Akronim',
		'Aladin' => 'Aladin',
		'Aldrich' => 'Aldrich',
		'Alef' => 'Alef',
		'Alegreya' => 'Alegreya',
		'Alegreya+SC' => 'Alegreya SC',
		'Alegreya+Sans' => 'Alegreya Sans',
		'Alegreya+Sans+SC' => 'Alegreya Sans SC',
		'Alex+Brush' => 'Alex Brush',
		'Alfa+Slab+One' => 'Alfa Slab One',
		'Alice' => 'Alice',
		'Alike' => 'Alike',
		'Alike+Angular' => 'Alike Angular',
		'Allan' => 'Allan',
		'Allerta' => 'Allerta',
		'Allerta+Stencil' => 'Allerta Stencil',
		'Allura' => 'Allura',
		'Almendra' => 'Almendra',
		'Almendra+Display' => 'Almendra Display',
		'Almendra+SC' => 'Almendra SC',
		'Amarante' => 'Amarante',
		'Amaranth' => 'Amaranth',
		'Amatic+SC' => 'Amatic SC',
		'Amethysta' => 'Amethysta',
		'Amiri' => 'Amiri',
		'Anaheim' => 'Anaheim',
		'Andada' => 'Andada',
		'Andika' => 'Andika',
		'Angkor' => 'Angkor',
		'Annie+Use+Your+Telescope' => 'Annie Use Your Telescope',
		'Anonymous+Pro' => 'Anonymous Pro',
		'Antic' => 'Antic',
		'Antic+Didone' => 'Antic Didone',
		'Antic+Slab' => 'Antic Slab',
		'Anton' => 'Anton',
		'Arapey' => 'Arapey',
		'Arbutus' => 'Arbutus',
		'Arbutus+Slab' => 'Arbutus Slab',
		'Architects+Daughter' => 'Architects Daughter',
		'Archivo+Black' => 'Archivo Black',
		'Archivo+Narrow' => 'Archivo Narrow',
		'Arimo' => 'Arimo',
		'Arizonia' => 'Arizonia',
		'Armata' => 'Armata',
		'Artifika' => 'Artifika',
		'Arvo' => 'Arvo',
		'Asap' => 'Asap',
		'Asset' => 'Asset',
		'Astloch' => 'Astloch',
		'Asul' => 'Asul',
		'Atomic+Age' => 'Atomic Age',
		'Aubrey' => 'Aubrey',
		'Audiowide' => 'Audiowide',
		'Autour+One' => 'Autour One',
		'Average' => 'Average',
		'Average+Sans' => 'Average Sans',
		'Averia+Gruesa+Libre' => 'Averia Gruesa Libre',
		'Averia+Libre' => 'Averia Libre',
		'Averia+Sans+Libre' => 'Averia Sans Libre',
		'Averia+Serif+Libre' => 'Averia Serif Libre',
		'Bad+Script' => 'Bad Script',
		'Balthazar' => 'Balthazar',
		'Bangers' => 'Bangers',
		'Basic' => 'Basic',
		'Battambang' => 'Battambang',
		'Baumans' => 'Baumans',
		'Bayon' => 'Bayon',
		'Belgrano' => 'Belgrano',
		'Belleza' => 'Belleza',
		'BenchNine' => 'BenchNine',
		'Bentham' => 'Bentham',
		'Berkshire+Swash' => 'Berkshire Swash',
		'Bevan' => 'Bevan',
		'Bigelow+Rules' => 'Bigelow Rules',
		'Bigshot+One' => 'Bigshot One',
		'Bilbo' => 'Bilbo',
		'Bilbo+Swash+Caps' => 'Bilbo Swash Caps',
		'Bitter' => 'Bitter',
		'Black+Ops+One' => 'Black Ops One',
		'Bokor' => 'Bokor',
		'Bonbon' => 'Bonbon',
		'Boogaloo' => 'Boogaloo',
		'Bowlby+One' => 'Bowlby One',
		'Bowlby+One+SC' => 'Bowlby One SC',
		'Brawler' => 'Brawler',
		'Bree+Serif' => 'Bree Serif',
		'Bubblegum+Sans' => 'Bubblegum Sans',
		'Bubbler+One' => 'Bubbler One',
		'Buda' => 'Buda',
		'Buenard' => 'Buenard',
		'Butcherman' => 'Butcherman',
		'Butterfly+Kids' => 'Butterfly Kids',
		'Cabin' => 'Cabin',
		'Cabin+Condensed' => 'Cabin Condensed',
		'Cabin+Sketch' => 'Cabin Sketch',
		'Caesar+Dressing' => 'Caesar Dressing',
		'Cagliostro' => 'Cagliostro',
		'Calligraffitti' => 'Calligraffitti',
		'Cambo' => 'Cambo',
		'Candal' => 'Candal',
		'Cantarell' => 'Cantarell',
		'Cantata+One' => 'Cantata One',
		'Cantora+One' => 'Cantora One',
		'Capriola' => 'Capriola',
		'Cardo' => 'Cardo',
		'Carme' => 'Carme',
		'Carrois+Gothic' => 'Carrois Gothic',
		'Carrois+Gothic+SC' => 'Carrois Gothic SC',
		'Carter+One' => 'Carter One',
		'Caudex' => 'Caudex',
		'Cedarville+Cursive' => 'Cedarville Cursive',
		'Ceviche+One' => 'Ceviche One',
		'Changa+One' => 'Changa One',
		'Chango' => 'Chango',
		'Chau+Philomene+One' => 'Chau Philomene One',
		'Chela+One' => 'Chela One',
		'Chelsea+Market' => 'Chelsea Market',
		'Chenla' => 'Chenla',
		'Cherry+Cream+Soda' => 'Cherry Cream Soda',
		'Cherry+Swash' => 'Cherry Swash',
		'Chewy' => 'Chewy',
		'Chicle' => 'Chicle',
		'Chivo' => 'Chivo',
		'Cinzel' => 'Cinzel',
		'Cinzel+Decorative' => 'Cinzel Decorative',
		'Clicker+Script' => 'Clicker Script',
		'Coda' => 'Coda',
		'Coda+Caption' => 'Coda Caption',
		'Codystar' => 'Codystar',
		'Combo' => 'Combo',
		'Comfortaa' => 'Comfortaa',
		'Coming+Soon' => 'Coming Soon',
		'Concert+One' => 'Concert One',
		'Condiment' => 'Condiment',
		'Content' => 'Content',
		'Contrail+One' => 'Contrail One',
		'Convergence' => 'Convergence',
		'Cookie' => 'Cookie',
		'Copse' => 'Copse',
		'Corben' => 'Corben',
		'Courgette' => 'Courgette',
		'Cousine' => 'Cousine',
		'Coustard' => 'Coustard',
		'Covered+By+Your+Grace' => 'Covered By Your Grace',
		'Crafty+Girls' => 'Crafty Girls',
		'Creepster' => 'Creepster',
		'Crete+Round' => 'Crete Round',
		'Crimson+Text' => 'Crimson Text',
		'Croissant+One' => 'Croissant One',
		'Crushed' => 'Crushed',
		'Cuprum' => 'Cuprum',
		'Cutive' => 'Cutive',
		'Cutive+Mono' => 'Cutive Mono',
		'Damion' => 'Damion',
		'Dancing+Script' => 'Dancing Script',
		'Dangrek' => 'Dangrek',
		'Dawning+of+a+New+Day' => 'Dawning of a New Day',
		'Days+One' => 'Days One',
		'Delius' => 'Delius',
		'Delius+Swash+Caps' => 'Delius Swash Caps',
		'Delius+Unicase' => 'Delius Unicase',
		'Della+Respira' => 'Della Respira',
		'Denk+One' => 'Denk One',
		'Devonshire' => 'Devonshire',
		'Didact+Gothic' => 'Didact Gothic',
		'Diplomata' => 'Diplomata',
		'Diplomata+SC' => 'Diplomata SC',
		'Domine' => 'Domine',
		'Donegal+One' => 'Donegal One',
		'Doppio+One' => 'Doppio One',
		'Dorsa' => 'Dorsa',
		'Dosis' => 'Dosis',
		'Dr+Sugiyama' => 'Dr Sugiyama',
		'Droid+Sans' => 'Droid Sans',
		'Droid+Sans+Mono' => 'Droid Sans Mono',
		'Droid+Serif' => 'Droid Serif',
		'Duru+Sans' => 'Duru Sans',
		'Dynalight' => 'Dynalight',
		'EB+Garamond' => 'EB Garamond',
		'Eagle+Lake' => 'Eagle Lake',
		'Eater' => 'Eater',
		'Economica' => 'Economica',
		'Ek+Mukta' => 'Ek Mukta',
		'Electrolize' => 'Electrolize',
		'Elsie' => 'Elsie',
		'Elsie+Swash+Caps' => 'Elsie Swash Caps',
		'Emblema+One' => 'Emblema One',
		'Emilys+Candy' => 'Emilys Candy',
		'Engagement' => 'Engagement',
		'Englebert' => 'Englebert',
		'Enriqueta' => 'Enriqueta',
		'Erica+One' => 'Erica One',
		'Esteban' => 'Esteban',
		'Euphoria+Script' => 'Euphoria Script',
		'Ewert' => 'Ewert',
		'Exo' => 'Exo',
		'Exo+2' => 'Exo 2',
		'Expletus+Sans' => 'Expletus Sans',
		'Fanwood+Text' => 'Fanwood Text',
		'Fascinate' => 'Fascinate',
		'Fascinate+Inline' => 'Fascinate Inline',
		'Faster+One' => 'Faster One',
		'Fasthand' => 'Fasthand',
		'Fauna+One' => 'Fauna One',
		'Federant' => 'Federant',
		'Federo' => 'Federo',
		'Felipa' => 'Felipa',
		'Fenix' => 'Fenix',
		'Finger+Paint' => 'Finger Paint',
		'Fira+Mono' => 'Fira Mono',
		'Fira+Sans' => 'Fira Sans',
		'Fjalla+One' => 'Fjalla One',
		'Fjord+One' => 'Fjord One',
		'Flamenco' => 'Flamenco',
		'Flavors' => 'Flavors',
		'Fondamento' => 'Fondamento',
		'Fontdiner+Swanky' => 'Fontdiner Swanky',
		'Forum' => 'Forum',
		'Francois+One' => 'Francois One',
		'Freckle+Face' => 'Freckle Face',
		'Fredericka+the+Great' => 'Fredericka the Great',
		'Fredoka+One' => 'Fredoka One',
		'Freehand' => 'Freehand',
		'Fresca' => 'Fresca',
		'Frijole' => 'Frijole',
		'Fruktur' => 'Fruktur',
		'Fugaz+One' => 'Fugaz One',
		'GFS+Didot' => 'GFS Didot',
		'GFS+Neohellenic' => 'GFS Neohellenic',
		'Gabriela' => 'Gabriela',
		'Gafata' => 'Gafata',
		'Galdeano' => 'Galdeano',
		'Galindo' => 'Galindo',
		'Gentium+Basic' => 'Gentium Basic',
		'Gentium+Book+Basic' => 'Gentium Book Basic',
		'Geo' => 'Geo',
		'Geostar' => 'Geostar',
		'Geostar+Fill' => 'Geostar Fill',
		'Germania+One' => 'Germania One',
		'Gilda+Display' => 'Gilda Display',
		'Give+You+Glory' => 'Give You Glory',
		'Glass+Antiqua' => 'Glass Antiqua',
		'Glegoo' => 'Glegoo',
		'Gloria+Hallelujah' => 'Gloria Hallelujah',
		'Goblin+One' => 'Goblin One',
		'Gochi+Hand' => 'Gochi Hand',
		'Gorditas' => 'Gorditas',
		'Goudy+Bookletter+1911' => 'Goudy Bookletter 1911',
		'Graduate' => 'Graduate',
		'Grand+Hotel' => 'Grand Hotel',
		'Gravitas+One' => 'Gravitas One',
		'Great+Vibes' => 'Great Vibes',
		'Griffy' => 'Griffy',
		'Gruppo' => 'Gruppo',
		'Gudea' => 'Gudea',
		'Habibi' => 'Habibi',
		'Hammersmith+One' => 'Hammersmith One',
		'Hanalei' => 'Hanalei',
		'Hanalei+Fill' => 'Hanalei Fill',
		'Handlee' => 'Handlee',
		'Hanuman' => 'Hanuman',
		'Happy+Monkey' => 'Happy Monkey',
		'Headland+One' => 'Headland One',
		'Henny+Penny' => 'Henny Penny',
		'Herr+Von+Muellerhoff' => 'Herr Von Muellerhoff',
		'Holtwood+One+SC' => 'Holtwood One SC',
		'Homemade+Apple' => 'Homemade Apple',
		'Homenaje' => 'Homenaje',
		'IM+Fell+DW+Pica' => 'IM Fell DW Pica',
		'IM+Fell+DW+Pica+SC' => 'IM Fell DW Pica SC',
		'IM+Fell+Double+Pica' => 'IM Fell Double Pica',
		'IM+Fell+Double+Pica+SC' => 'IM Fell Double Pica SC',
		'IM+Fell+English' => 'IM Fell English',
		'IM+Fell+English+SC' => 'IM Fell English SC',
		'IM+Fell+French+Canon' => 'IM Fell French Canon',
		'IM+Fell+French+Canon+SC' => 'IM Fell French Canon SC',
		'IM+Fell+Great+Primer' => 'IM Fell Great Primer',
		'IM+Fell+Great+Primer+SC' => 'IM Fell Great Primer SC',
		'Iceberg' => 'Iceberg',
		'Iceland' => 'Iceland',
		'Imprima' => 'Imprima',
		'Inconsolata' => 'Inconsolata',
		'Inder' => 'Inder',
		'Indie+Flower' => 'Indie Flower',
		'Inika' => 'Inika',
		'Irish+Grover' => 'Irish Grover',
		'Istok+Web' => 'Istok Web',
		'Italiana' => 'Italiana',
		'Italianno' => 'Italianno',
		'Jacques+Francois' => 'Jacques Francois',
		'Jacques+Francois+Shadow' => 'Jacques Francois Shadow',
		'Jim+Nightshade' => 'Jim Nightshade',
		'Jockey+One' => 'Jockey One',
		'Jolly+Lodger' => 'Jolly Lodger',
		'Josefin+Sans' => 'Josefin Sans',
		'Josefin+Slab' => 'Josefin Slab',
		'Joti+One' => 'Joti One',
		'Judson' => 'Judson',
		'Julee' => 'Julee',
		'Julius+Sans+One' => 'Julius Sans One',
		'Junge' => 'Junge',
		'Jura' => 'Jura',
		'Just+Another+Hand' => 'Just Another Hand',
		'Just+Me+Again+Down+Here' => 'Just Me Again Down Here',
		'Kameron' => 'Kameron',
		'Kantumruy' => 'Kantumruy',
		'Karla' => 'Karla',
		'Kaushan+Script' => 'Kaushan Script',
		'Kavoon' => 'Kavoon',
		'Kdam+Thmor' => 'Kdam Thmor',
		'Keania+One' => 'Keania One',
		'Kelly+Slab' => 'Kelly Slab',
		'Kenia' => 'Kenia',
		'Khmer' => 'Khmer',
		'Kite+One' => 'Kite One',
		'Knewave' => 'Knewave',
		'Kotta+One' => 'Kotta One',
		'Koulen' => 'Koulen',
		'Kranky' => 'Kranky',
		'Kreon' => 'Kreon',
		'Kristi' => 'Kristi',
		'Krona+One' => 'Krona One',
		'La+Belle+Aurore' => 'La Belle Aurore',
		'Lancelot' => 'Lancelot',
		'Lato' => 'Lato',
		'League+Script' => 'League Script',
		'Leckerli+One' => 'Leckerli One',
		'Ledger' => 'Ledger',
		'Lekton' => 'Lekton',
		'Lemon' => 'Lemon',
		'Libre+Baskerville' => 'Libre Baskerville',
		'Life+Savers' => 'Life Savers',
		'Lilita+One' => 'Lilita One',
		'Lily+Script+One' => 'Lily Script One',
		'Limelight' => 'Limelight',
		'Linden+Hill' => 'Linden Hill',
		'Lobster' => 'Lobster',
		'Lobster+Two' => 'Lobster Two',
		'Londrina+Outline' => 'Londrina Outline',
		'Londrina+Shadow' => 'Londrina Shadow',
		'Londrina+Sketch' => 'Londrina Sketch',
		'Londrina+Solid' => 'Londrina Solid',
		'Lora' => 'Lora',
		'Love+Ya+Like+A+Sister' => 'Love Ya Like A Sister',
		'Loved+by+the+King' => 'Loved by the King',
		'Lovers+Quarrel' => 'Lovers Quarrel',
		'Luckiest+Guy' => 'Luckiest Guy',
		'Lusitana' => 'Lusitana',
		'Lustria' => 'Lustria',
		'Macondo' => 'Macondo',
		'Macondo+Swash+Caps' => 'Macondo Swash Caps',
		'Magra' => 'Magra',
		'Maiden+Orange' => 'Maiden Orange',
		'Mako' => 'Mako',
		'Marcellus' => 'Marcellus',
		'Marcellus+SC' => 'Marcellus SC',
		'Marck+Script' => 'Marck Script',
		'Margarine' => 'Margarine',
		'Marko+One' => 'Marko One',
		'Marmelad' => 'Marmelad',
		'Marvel' => 'Marvel',
		'Mate' => 'Mate',
		'Mate+SC' => 'Mate SC',
		'Maven+Pro' => 'Maven Pro',
		'McLaren' => 'McLaren',
		'Meddon' => 'Meddon',
		'MedievalSharp' => 'MedievalSharp',
		'Medula+One' => 'Medula One',
		'Megrim' => 'Megrim',
		'Meie+Script' => 'Meie Script',
		'Merienda' => 'Merienda',
		'Merienda+One' => 'Merienda One',
		'Merriweather' => 'Merriweather',
		'Merriweather+Sans' => 'Merriweather Sans',
		'Metal' => 'Metal',
		'Metal+Mania' => 'Metal Mania',
		'Metamorphous' => 'Metamorphous',
		'Metrophobic' => 'Metrophobic',
		'Michroma' => 'Michroma',
		'Milonga' => 'Milonga',
		'Miltonian' => 'Miltonian',
		'Miltonian+Tattoo' => 'Miltonian Tattoo',
		'Miniver' => 'Miniver',
		'Miss+Fajardose' => 'Miss Fajardose',
		'Modern+Antiqua' => 'Modern Antiqua',
		'Molengo' => 'Molengo',
		'Molle' => 'Molle',
		'Monda' => 'Monda',
		'Monofett' => 'Monofett',
		'Monoton' => 'Monoton',
		'Monsieur+La+Doulaise' => 'Monsieur La Doulaise',
		'Montaga' => 'Montaga',
		'Montez' => 'Montez',
		'Montserrat' => 'Montserrat',
		'Montserrat+Alternates' => 'Montserrat Alternates',
		'Montserrat+Subrayada' => 'Montserrat Subrayada',
		'Moul' => 'Moul',
		'Moulpali' => 'Moulpali',
		'Mountains+of+Christmas' => 'Mountains of Christmas',
		'Mouse+Memoirs' => 'Mouse Memoirs',
		'Mr+Bedfort' => 'Mr Bedfort',
		'Mr+Dafoe' => 'Mr Dafoe',
		'Mr+De+Haviland' => 'Mr De Haviland',
		'Mrs+Saint+Delafield' => 'Mrs Saint Delafield',
		'Mrs+Sheppards' => 'Mrs Sheppards',
		'Muli' => 'Muli',
		'Mystery+Quest' => 'Mystery Quest',
		'Neucha' => 'Neucha',
		'Neuton' => 'Neuton',
		'New+Rocker' => 'New Rocker',
		'News+Cycle' => 'News Cycle',
		'Niconne' => 'Niconne',
		'Nixie+One' => 'Nixie One',
		'Nobile' => 'Nobile',
		'Nokora' => 'Nokora',
		'Norican' => 'Norican',
		'Nosifer' => 'Nosifer',
		'Nothing+You+Could+Do' => 'Nothing You Could Do',
		'Noticia+Text' => 'Noticia Text',
		'Noto+Sans' => 'Noto Sans',
		'Noto+Serif' => 'Noto Serif',
		'Nova+Cut' => 'Nova Cut',
		'Nova+Flat' => 'Nova Flat',
		'Nova+Mono' => 'Nova Mono',
		'Nova+Oval' => 'Nova Oval',
		'Nova+Round' => 'Nova Round',
		'Nova+Script' => 'Nova Script',
		'Nova+Slim' => 'Nova Slim',
		'Nova+Square' => 'Nova Square',
		'Numans' => 'Numans',
		'Nunito' => 'Nunito',
		'Odor+Mean+Chey' => 'Odor Mean Chey',
		'Offside' => 'Offside',
		'Old+Standard+TT' => 'Old Standard TT',
		'Oldenburg' => 'Oldenburg',
		'Oleo+Script' => 'Oleo Script',
		'Oleo+Script+Swash+Caps' => 'Oleo Script Swash Caps',
		'Open+Sans' => 'Open Sans',
		'Open+Sans+Condensed' => 'Open Sans Condensed',
		'Oranienbaum' => 'Oranienbaum',
		'Orbitron' => 'Orbitron',
		'Oregano' => 'Oregano',
		'Orienta' => 'Orienta',
		'Original+Surfer' => 'Original Surfer',
		'Oswald' => 'Oswald',
		'Over+the+Rainbow' => 'Over the Rainbow',
		'Overlock' => 'Overlock',
		'Overlock+SC' => 'Overlock SC',
		'Ovo' => 'Ovo',
		'Oxygen' => 'Oxygen',
		'Oxygen+Mono' => 'Oxygen Mono',
		'PT+Mono' => 'PT Mono',
		'PT+Sans' => 'PT Sans',
		'PT+Sans+Caption' => 'PT Sans Caption',
		'PT+Sans+Narrow' => 'PT Sans Narrow',
		'PT+Serif' => 'PT Serif',
		'PT+Serif+Caption' => 'PT Serif Caption',
		'Pacifico' => 'Pacifico',
		'Paprika' => 'Paprika',
		'Parisienne' => 'Parisienne',
		'Passero+One' => 'Passero One',
		'Passion+One' => 'Passion One',
		'Pathway+Gothic+One' => 'Pathway Gothic One',
		'Patrick+Hand' => 'Patrick Hand',
		'Patrick+Hand+SC' => 'Patrick Hand SC',
		'Patua+One' => 'Patua One',
		'Paytone+One' => 'Paytone One',
		'Peralta' => 'Peralta',
		'Permanent+Marker' => 'Permanent Marker',
		'Petit+Formal+Script' => 'Petit Formal Script',
		'Petrona' => 'Petrona',
		'Philosopher' => 'Philosopher',
		'Piedra' => 'Piedra',
		'Pinyon+Script' => 'Pinyon Script',
		'Pirata+One' => 'Pirata One',
		'Plaster' => 'Plaster',
		'Play' => 'Play',
		'Playball' => 'Playball',
		'Playfair+Display' => 'Playfair Display',
		'Playfair+Display+SC' => 'Playfair Display SC',
		'Podkova' => 'Podkova',
		'Poiret+One' => 'Poiret One',
		'Poller+One' => 'Poller One',
		'Poly' => 'Poly',
		'Pompiere' => 'Pompiere',
		'Pontano+Sans' => 'Pontano Sans',
		'Poppins' => 'Poppins',
		'Port+Lligat+Sans' => 'Port Lligat Sans',
		'Port+Lligat+Slab' => 'Port Lligat Slab',
		'Prata' => 'Prata',
		'Preahvihear' => 'Preahvihear',
		'Press+Start+2P' => 'Press Start 2P',
		'Princess+Sofia' => 'Princess Sofia',
		'Prociono' => 'Prociono',
		'Prosto+One' => 'Prosto One',
		'Puritan' => 'Puritan',
		'Purple+Purse' => 'Purple Purse',
		'Quando' => 'Quando',
		'Quantico' => 'Quantico',
		'Quattrocento' => 'Quattrocento',
		'Quattrocento+Sans' => 'Quattrocento Sans',
		'Questrial' => 'Questrial',
		'Quicksand' => 'Quicksand',
		'Quintessential' => 'Quintessential',
		'Qwigley' => 'Qwigley',
		'Racing+Sans+One' => 'Racing Sans One',
		'Radley' => 'Radley',
		'Raleway' => 'Raleway',
		'Raleway+Dots' => 'Raleway Dots',
		'Rambla' => 'Rambla',
		'Rammetto+One' => 'Rammetto One',
		'Ranchers' => 'Ranchers',
		'Rancho' => 'Rancho',
		'Rationale' => 'Rationale',
		'Redressed' => 'Redressed',
		'Reenie+Beanie' => 'Reenie Beanie',
		'Revalia' => 'Revalia',
		'Ribeye' => 'Ribeye',
		'Ribeye+Marrow' => 'Ribeye Marrow',
		'Righteous' => 'Righteous',
		'Risque' => 'Risque',
		'Roboto' => 'Roboto',
		'Roboto+Condensed' => 'Roboto Condensed',
		'Roboto+Slab' => 'Roboto Slab',
		'Rochester' => 'Rochester',
		'Rock+Salt' => 'Rock Salt',
		'Rokkitt' => 'Rokkitt',
		'Romanesco' => 'Romanesco',
		'Ropa+Sans' => 'Ropa Sans',
		'Rosario' => 'Rosario',
		'Rosarivo' => 'Rosarivo',
		'Rouge+Script' => 'Rouge Script',
		'Rubik+Mono+One' => 'Rubik Mono One',
		'Rubik+One' => 'Rubik One',
		'Ruda' => 'Ruda',
		'Rufina' => 'Rufina',
		'Ruge+Boogie' => 'Ruge Boogie',
		'Ruluko' => 'Ruluko',
		'Rum+Raisin' => 'Rum Raisin',
		'Ruslan+Display' => 'Ruslan Display',
		'Russo+One' => 'Russo One',
		'Ruthie' => 'Ruthie',
		'Rye' => 'Rye',
		'Sacramento' => 'Sacramento',
		'Sail' => 'Sail',
		'Salsa' => 'Salsa',
		'Sanchez' => 'Sanchez',
		'Sancreek' => 'Sancreek',
		'Sansita+One' => 'Sansita One',
		'Sarina' => 'Sarina',
		'Satisfy' => 'Satisfy',
		'Scada' => 'Scada',
		'Schoolbell' => 'Schoolbell',
		'Seaweed+Script' => 'Seaweed Script',
		'Sevillana' => 'Sevillana',
		'Seymour+One' => 'Seymour One',
		'Shadows+Into+Light' => 'Shadows Into Light',
		'Shadows+Into+Light+Two' => 'Shadows Into Light Two',
		'Shanti' => 'Shanti',
		'Share' => 'Share',
		'Share+Tech' => 'Share Tech',
		'Share+Tech+Mono' => 'Share Tech Mono',
		'Shojumaru' => 'Shojumaru',
		'Short+Stack' => 'Short Stack',
		'Siemreap' => 'Siemreap',
		'Sigmar+One' => 'Sigmar One',
		'Signika' => 'Signika',
		'Signika+Negative' => 'Signika Negative',
		'Simonetta' => 'Simonetta',
		'Sintony' => 'Sintony',
		'Sirin+Stencil' => 'Sirin Stencil',
		'Six+Caps' => 'Six Caps',
		'Skranji' => 'Skranji',
		'Slackey' => 'Slackey',
		'Smokum' => 'Smokum',
		'Smythe' => 'Smythe',
		'Sniglet' => 'Sniglet',
		'Snippet' => 'Snippet',
		'Snowburst+One' => 'Snowburst One',
		'Sofadi+One' => 'Sofadi One',
		'Sofia' => 'Sofia',
		'Sonsie+One' => 'Sonsie One',
		'Sorts+Mill+Goudy' => 'Sorts Mill Goudy',
		'Source+Code+Pro' => 'Source Code Pro',
		'Source+Sans+Pro' => 'Source Sans Pro',
		'Special+Elite' => 'Special Elite',
		'Spicy+Rice' => 'Spicy Rice',
		'Spinnaker' => 'Spinnaker',
		'Spirax' => 'Spirax',
		'Squada+One' => 'Squada One',
		'Stalemate' => 'Stalemate',
		'Stalinist+One' => 'Stalinist One',
		'Stardos+Stencil' => 'Stardos Stencil',
		'Stint+Ultra+Condensed' => 'Stint Ultra Condensed',
		'Stint+Ultra+Expanded' => 'Stint Ultra Expanded',
		'Stoke' => 'Stoke',
		'Strait' => 'Strait',
		'Sue+Ellen+Francisco' => 'Sue Ellen Francisco',
		'Sunshiney' => 'Sunshiney',
		'Supermercado+One' => 'Supermercado One',
		'Suwannaphum' => 'Suwannaphum',
		'Swanky+and+Moo+Moo' => 'Swanky and Moo Moo',
		'Syncopate' => 'Syncopate',
		'Tangerine' => 'Tangerine',
		'Taprom' => 'Taprom',
		'Tauri' => 'Tauri',
		'Telex' => 'Telex',
		'Tenor+Sans' => 'Tenor Sans',
		'Text+Me+One' => 'Text Me One',
		'The+Girl+Next+Door' => 'The Girl Next Door',
		'Tienne' => 'Tienne',
		'Tinos' => 'Tinos',
		'Titan+One' => 'Titan One',
		'Titillium+Web' => 'Titillium Web',
		'Trade+Winds' => 'Trade Winds',
		'Trocchi' => 'Trocchi',
		'Trochut' => 'Trochut',
		'Trykker' => 'Trykker',
		'Tulpen+One' => 'Tulpen One',
		'Ubuntu' => 'Ubuntu',
		'Ubuntu+Condensed' => 'Ubuntu Condensed',
		'Ubuntu+Mono' => 'Ubuntu Mono',
		'Ultra' => 'Ultra',
		'Uncial+Antiqua' => 'Uncial Antiqua',
		'Underdog' => 'Underdog',
		'Unica+One' => 'Unica One',
		'UnifrakturCook' => 'UnifrakturCook',
		'UnifrakturMaguntia' => 'UnifrakturMaguntia',
		'Unkempt' => 'Unkempt',
		'Unlock' => 'Unlock',
		'Unna' => 'Unna',
		'VT323' => 'VT323',
		'Vampiro+One' => 'Vampiro One',
		'Varela' => 'Varela',
		'Varela+Round' => 'Varela Round',
		'Vast+Shadow' => 'Vast Shadow',
		'Vibur' => 'Vibur',
		'Vidaloka' => 'Vidaloka',
		'Viga' => 'Viga',
		'Voces' => 'Voces',
		'Volkhov' => 'Volkhov',
		'Vollkorn' => 'Vollkorn',
		'Voltaire' => 'Voltaire',
		'Waiting+for+the+Sunrise' => 'Waiting for the Sunrise',
		'Wallpoet' => 'Wallpoet',
		'Walter+Turncoat' => 'Walter Turncoat',
		'Warnes' => 'Warnes',
		'Wellfleet' => 'Wellfleet',
		'Wendy+One' => 'Wendy One',
		'Wire+One' => 'Wire One',
		'Yanone+Kaffeesatz' => 'Yanone Kaffeesatz',
		'Yellowtail' => 'Yellowtail',
		'Yeseva+One' => 'Yeseva One',
		'Yesteryear' => 'Yesteryear',
		'Zeyada' => 'Zeyada',
    );

  return $array;

}
add_filter( 'ot_recognized_font_families', 'filter_ot_recognized_font_families', 10, 2 );

// Build & enqueue google font link
function juster_add_google_fonts() {

	$google_body_font 				= ot_get_option('body_font');
	$google_body_font_link 			= ot_get_option('body_font_link');
	$google_sidebar_p_tag 			= ot_get_option('sidebar_p_tag');
	$google_footer_p_tag 			= ot_get_option('footer_p_tag');
	$google_menu_font 				= ot_get_option('menu_font');
	$google_sidebar_heading_font 	= ot_get_option('sidebar_heading_font');
	$google_footer_heading_font 	= ot_get_option('footer_heading_font');
	$google_custom_font 			= ot_get_option('custom_font');
	$google_content_heading_font 	= ot_get_option('content_heading_font');

	if(!empty($google_body_font)) {
		$body_font = $google_body_font['font-family'];
	} else { $body_font = ''; }
	if(!empty($google_body_font_link)) {
		$body_font_link = $google_body_font_link['font-family'];
	} else { $body_font_link = ''; }
	if(!empty($google_sidebar_p_tag)) {
		$sidebar_p_tag = $google_sidebar_p_tag['font-family'];
	} else { $sidebar_p_tag = ''; }
	if(!empty($google_footer_p_tag)) {
		$footer_p_tag = $google_footer_p_tag['font-family'];
	} else { $footer_p_tag = ''; }
	if(!empty($google_menu_font)) {
		$menu_font = $google_menu_font['font-family'];
	} else { $menu_font = ''; }
	if(!empty($google_sidebar_heading_font)) {
		$sidebar_heading_font = $google_sidebar_heading_font['font-family'];
	} else { $sidebar_heading_font = ''; }
	if(!empty($google_footer_heading_font)) {
		$footer_heading_font = $google_footer_heading_font['font-family'];
	} else { $footer_heading_font = ''; }
	if(!empty($google_custom_font)) {
		$custom_font = $google_custom_font['font-family'];
	} else { $custom_font = ''; }
	if(!empty($google_content_heading_font)) {
		$content_heading_font = $google_content_heading_font['font-family'];
	} else { $content_heading_font = ''; }

	$font_1 = '';
	$font_2 = '';
	$font_3 = '';
	$font_4 = '';
	$font_5 = '';
	$font_6 = '';
	$font_7 = '';
	$font_8 = '';
	$font_9 = '';

	if(!($body_font == 'Arial,+Helvetica' || $body_font == 'Courier' || $body_font == 'Tahoma,+Geneva' )) {
		$font_1 = $body_font;
	}
	if(!($body_font_link == 'Arial,+Helvetica' || $body_font_link == 'Courier' || $body_font_link == 'Tahoma,+Geneva' )) {
		$font_2 = $body_font_link;
	}
	if(!($sidebar_p_tag == 'Arial,+Helvetica' || $sidebar_p_tag == 'Courier' || $sidebar_p_tag == 'Tahoma,+Geneva' )) {
		$font_3 = $sidebar_p_tag;
	}
	if(!($footer_p_tag == 'Arial,+Helvetica' || $footer_p_tag == 'Courier' || $footer_p_tag == 'Tahoma,+Geneva' )) {
		$font_4 = $footer_p_tag;
	}
	if(!($menu_font == 'Arial,+Helvetica' || $menu_font == 'Courier' || $menu_font == 'Tahoma,+Geneva' )) {
		$font_5 = $menu_font;
	}
	if(!($sidebar_heading_font == 'Arial,+Helvetica' || $sidebar_heading_font == 'Courier' || $sidebar_heading_font == 'Tahoma,+Geneva' )) {
		$font_6 = $sidebar_heading_font;
	}
	if(!($footer_heading_font == 'Arial,+Helvetica' || $footer_heading_font == 'Courier' || $footer_heading_font == 'Tahoma,+Geneva' )) {
		$font_7 = $footer_heading_font;
	}
	if(!($custom_font == 'Arial,+Helvetica' || $custom_font == 'Courier' || $custom_font == 'Tahoma,+Geneva' )) {
		$font_8 = $custom_font;
	}
	if(!($content_heading_font == 'Arial,+Helvetica' || $content_heading_font == 'Courier' || $content_heading_font == 'Tahoma,+Geneva' )) {
		$font_9 = $content_heading_font;
	}

	if(!(empty($font_1) && empty($font_2) && empty($font_3) && empty($font_4) && empty($font_5) && empty($font_6) && empty($font_7) && empty($font_8) && empty($font_9))){

		$all_fonts = array($font_1, $font_2, $font_3, $font_4, $font_5, $font_6, $font_7, $font_8, $font_9);
		$all_fonts  = array_unique($all_fonts);

		foreach ($all_fonts as $single_font) {
			if(! empty( $single_font ) ){
				$font_link[] = $single_font . ':lighter,normal,semi-bold,bold';
			}
		}

		$enque_font = implode('|', $font_link);

		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family='. $enque_font, false, '', 'all' );
	}
}
add_action('wp_enqueue_scripts', 'juster_add_google_fonts');
