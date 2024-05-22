<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    * {
      box-sizing: border-box;
    }

    .contact-section {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #c1e2e2;
      color: black;
      padding: 20px;
    }

    .contact-info {
      width: 50%;
      text-align: center;
    }

    .contact-info h2 {
      font-size: 36px;
      margin-bottom: 20px;
    }

    .contact-info p {
      font-size: 18px;
      margin-bottom: 10px;
    }

    .contact-info ul {
      list-style: none;
      padding: 0;
      margin-left: 20%;
    }

    .contact-info li {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .contact-info i {
      font-size: 24px;
      color: gold;
      margin-right: 10px;
    }

    .contact-form {
      width: 50%;
    }

    .contact-form form {
      width: 80%;
      margin: 0 auto;
    }

    .contact-form label {
      display: block;
      font-size: 18px;
      margin-top: 20px;
      margin-bottom: 10px;
    }

    .contact-form input,
    .contact-form textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid white;
      border-radius: 5px;
      background-color: transparent;
      color: white;
      font-size: 16px;
    }

    .contact-form input:focus,
    .contact-form textarea:focus {
      outline: none;
      border-color: gold;
    }

    .contact-form input[type=submit] {
      margin-top: 20px;
      background-color: #46b7b7;
      color: black;
      cursor: pointer;
    }

    @media screen and (max-width: 768px) {
      .contact-section {
        flex-direction: column;
      }

      .contact-info,
      .contact-form {
        width: 100%;
      }
    }
  </style>
</head>

<body>

  <div class="contact-section">
    <div class="contact-info">
      <h2>Contactez-nous</h2>
      <ul>
        <li><i class="fas fa-map-marker-alt"></i> VGP6+5PJ Yaounde, Derriere usine Bastos</li><br><br><br>
        <li><i class="far fa-clock"></i> Lundi-Dimanche: 24h/24h</li><br><br><br>
        <li><i class="far fa-envelope"></i> TeAm@gmail.com</li><br><br><br>
        <li><i class="fas fa-phone-alt"></i> +237 676 40 58 24</li>
      </ul>
    </div>
    <div class="contact-form">
      <form action="hf/temoignage.php" method="POST" enctype="multipart/form-data">
        <h1> Faites votre temoignage</h1>
        <label for="name">Votre nom</label>
        <input type="text" id="name" name="name" placeholder="Votre nom..">

        <label for="profession">Profession</label>
        <input type="profession" id="profession" name="profession" placeholder="Votre profession.. ">

        <label for="image">Photo</label>
        <input type="file" id="image" name="image" placeholder="votre photo..">

        <label for="temoignage">Temoignage</label>
        <textarea id="temoignage" name="temoignage" placeholder="Écrivez quelque chose.." style="height:200px"></textarea>

        <input type="submit" value="Envoyer le temoignage">
      </form>
    </div>
  </div>
</body>

</html>