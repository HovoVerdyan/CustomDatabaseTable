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
            <?php if ( current_user_can('administrator') ) { ?>
                <th>Delete</th>
            <?php } ?>
        </tr>

        <?php
          require_once "getPets.php";
          $getPets = new GetPets();

          foreach ( $getPets->pets as $pet ) { ?>
            <tr>
                <td><?php echo $pet->favGame ?></td>
                <td><?php echo $pet->favTime ?></td>
                <td><?php echo $pet->petWeight ?></td>
                <td><?php echo $pet->favColor ?></td>
                <?php if ( current_user_can('administrator') ) { ?>
                <td>
                    <form action="<?php echo esc_html(admin_url('admin-post.php')) ?>" method="POST">
                        <input type="hidden" name="action" value="deletePet">
                        <input type="hidden" name="idToDelete" value="<?php echo $pet->id; ?>">
                        <button>X</button>
                    </form>
                </td>
                <?php } ?>
            </tr>
          <?php }
        ?>

</table>

<?php
  if( current_user_can('administrator') )
  { ?>
      <form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="POST">
          <p>Enter new name for the pet. so as others cam see that information before adopting</p>
          <input type="hidden" name="action" value="createpet">
          <input type="text" name="incomingPetName" placeholder="name">
          <button>Add pet</button>
      </form>
  <?php }
?>

<?php get_footer();