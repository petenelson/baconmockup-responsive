<?php 
	get_header(  );
?>
			<div id="content" role="main" >
			<?php

				while(have_posts()) {
					the_post();
					the_content( );
				}

			?></div><!-- #content -->
<?php 
get_footer(  );
