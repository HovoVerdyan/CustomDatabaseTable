<?php

get_header(); ?>

<div class="wp-container container-narrow pagepage-section">
	<p>Here we are going to echo all the details about the pets we do have</p>
</div>
    <table class="wp-container container-narrow pagepage-section">
        <tr>
            <th>Game</th>
            <th>Time</th>
            <th>Weight</th>
            <th>Color</th>
        </tr>

        <?php
          require_once "getPets.php";
          $getPets = new GetPets();

          foreach ( $getPets->pets as $pet ) { ?>
            <tr>
                <th><?php echo $pet->favGame ?></th>
                <th><?php echo $pet->favTime ?></th>
                <th><?php echo $pet->petWeight ?></th>
                <th><?php echo $pet->favColor ?></th>
            </tr>
          <?php }
        ?>

</table>

<?php
  if( current_user_can('administrator') )
  { ?>
      <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="POST">
          <p>Enter new name for the pet. so as others cam see that information before adopting</p>
          <input type="text" name="incomingPetName" placeholder="name">
          <button>Add pet</button>
      </form>
  <?php }
?>

<?php get_footer();