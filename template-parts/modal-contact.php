<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
  <img class="modal_content" src="<?php echo get_stylesheet_directory_uri().'./assets/images/contact_header.png'?> " alt="logo">
  <span class="close"></span>
  <div class="backround_contact"> </div>
<!------------- APPEL LE PLUGIN CONTACT FORM 7 ------------------------>
      <?php echo do_shortcode( '[contact-form-7 id="26" title="Contact"]' ); ?>
</div>
</div>
