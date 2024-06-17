
<h1>Le super blog de l'AVBN !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<h2>Modifiez le commentaires</h2>
<?var_dump($com);?>
<form action="index.php?action=viewNewComment&id=<?= $id ?>&post_id=<?=$post_id?>" method="post">
   <div>
      <label for="author">Auteur</label><br />
      <input type="text" id="author" name="author" value="<?=$author?>"/>
   </div>
   <div>
      <label for="comment">Commentaire</label><br />
      <textarea id="comment" name="comment"><?=$com?></textarea>
   </div>
   <div>
      <input type="submit" />
   </div>
</form>


