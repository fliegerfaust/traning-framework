<title>Управление анкетами</title>

<div class="container"><br>
<form action=""  method="post" >

<table class='table table-bordered'>
  <tr>
    <td><b>Имя файла</b></td> 
    <td><b>Имя</b></td>
    <td><b>E-mail</b></td>
    <td><b>Год рождения</b></td>
    <td><b>Количество конечностей</b></td>
    <td><b>Пол</b></td>
    <td><b>Суперспособности</b></td>
    <td><b>Краткая биография</b></td>
    <td></td>
  </tr>
<?php  
foreach ($c['users'] as $file => $user) {
?>
  <tr>
    <td><?php print($user['filename']); ?></td>
    <td><?php print($user['name']); ?></td>
    <td><?php print($user['email']); ?></td>
    <td><?php print($user['year_of_birth']); ?></td>
    <td><?php print($user['number_of_extremities']); ?></td>
    <td><?php print($user['sex']); ?></td>
    <td><?php print($user['superabilities']); ?></td>
    <td><?php print($user['bio']); ?></td>
    <td><input type="hidden" name="userfile" value="<?=$user['filename']?>"></input>
    <input type="submit" value="Удалить" class="btn btn-danger"> </td>
  </tr> 

<?php 
}
?>
</table>
</form>
</div>