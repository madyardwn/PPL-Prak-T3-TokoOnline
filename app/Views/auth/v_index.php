<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?php echo $title ?></title>
</head>

<body>

  <center>
    <form action="<?php echo base_url('login'); ?>" method="post">
      <h1>Login</h1>
      <?php if (session()->getFlashdata('pesan')) : ?>
        <div>
          <?php echo session()->getFlashdata('pesan'); ?>
        </div>
      <?php endif; ?>
      <table>
        <tr>
          <td>Username</td>
          <td><input type="text" name="username" id="username" placeholder="username" size="30"></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type="password" name="password" id="password" placeholder="password" size="30"></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" name="login" id="login" value="Submit"></td>
        </tr>
      </table>
    </form>
  </center>
</body>

</html>
