<?php
session_start();

include "../hopital/connexion.php";
if (!isset($_SESSION['unique_id'])) {
  header("location: ../index.php");
}
?>
<?php include_once "header.php"; ?>

<body>
  <main style="margin-top: 200px;">

    <div class="wrapper">
      <section class="chat-area">
        <header>
          <?php
          $id = mysqli_real_escape_string($connexion, $_GET['id']);
          $sql = mysqli_query($connexion, "SELECT * FROM hopital WHERE unique_id = {$id}");
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          } else {
            header("location: users.php");
          }
          ?>
          <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
          <img src="../hopital/gestion_hopital/<?php echo $row['image']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['hopitalname'] . " " . $row['hopitaladress'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </header>
        <div class="chat-box">

        </div>
        <form action="#" class="typing-area">
          <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $id; ?>" hidden>
          <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
          <button><i class="fab fa-telegram-plane"></i></button>
        </form>
      </section>
    </div>
  </main>

  <script src="javascript/chat.js"></script>

</body>

</html>