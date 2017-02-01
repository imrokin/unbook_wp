<?php if ( has_nav_menu( 'primary' ) ) : // Check if there's a menu assigned to the 'primary' location. ?>

	<nav  style="padding:5px;" <?php hybrid_attr( 'menu', 'primary' ); ?>>

		<div style="width:85%; float:left; text-align:left;" id="menu-primary-title" class="menu-toggle">
			<a href="<?php echo site_url(); ?>" style="color:white;"><h4 style="color:white; margin: 10px;" class="glyphicon glyphicon-home">&nbsp;UnBook</h4></a>
		</div><span  style="padding: 10px; color: white; text-align: right;" class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#myModal"></span><!-- .menu-toggle -->

		<?php /* wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container'       => '',
				'menu_id'         => 'menu-primary-items',
				'menu_class'      => 'menu-items',
				'fallback_cb'     => '',
				'items_wrap'      => '<div class="wrap"><ul id="%s" class="%s">%s</ul>' . get_search_form( false ) . '</div>'
			)
		);*/ ?>

	</nav><!-- #menu-primary -->
	<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add to Notes</h4>
      </div>
      <div class="modal-body">
	   <form id="apfform" action="" method="post"enctype="multipart/form-data">
 
        <div id="apf-text">
 
            <div id="apf-response" style="background-color:#E6E6FA"></div>
 
            <strong>Title </strong> <br/>
            <input type="text" id="apftitle" name="apftitle"/><br />
            
            <textarea id="apfcontents" name="apfcontents" placeholder="Content" rows="5" ></textarea><br />
            <br/>
 
           
 
        </div>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         <a onclick="apfaddpost(apftitle.value,apfcontents.value);" class="btn btn-primary" style="cursor: pointer"><b>Save Note</b></a>
      </div>
    </div>
  </div>
</div>
<script>
var ajax_url_customer = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
function apfaddpost(posttitle,postcontent) {
 
    jQuery.ajax({
 
        type: 'POST',
 
        url: ajax_url_customer,
 
        data: {
            action: 'apf_addpost',
            apftitle: posttitle,
            apfcontents: postcontent
        },
 
        success: function(data, textStatus, XMLHttpRequest) {
            var id = '#apf-response';
            jQuery(id).html('');
            jQuery(id).append(data);
 
            resetvalues();
        },
 
        error: function(MLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        }
 
    });
}
 
function resetvalues() {
 
    var title = document.getElementById("apftitle");
    title.value = '';
 
    var content = document.getElementById("apfcontents");
    content.value = '';
 
}
</script>
	

<?php endif; // End check for menu. ?>