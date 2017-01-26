<p>Register User</p>

<?php foreach($users as $user) { ?>
  <p>
    <?php echo $user->author; ?>
    <a href='?controller=users&action=show&id=<?php echo $user->id; ?>'>See content</a>
  </p>
<?php } ?>