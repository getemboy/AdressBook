<?php 
mb_internal_encoding('UTF-8');

$title = "Форма";

include './includes/header.php';


$username = trim($_POST['username']);
$username = str_replace('!', '', $username);
$phone = trim($_POST['phone']);
$phone = str_replace('!', '', $phone);
$selectedGroup = (int)$_POST['group'];
$error = FALSE;

if(mb_strlen($username) < 4) {
    echo '<p>Името е праклено късо </p>';
    $error = TRUE;
}

if(mb_strlen($phone) < 6 || mb_strlen($phone) > 12) {
    echo '<p>Въведемоят телефон е невалиден</p>';
    $error = TRUE;
}

if (!array_key_exists($selectedGroup, $groups)) {
    echo '<p>Невалидна група</p>';    
    $error = TRUE;
}

if(!$error) {
    $result = $username. '!'.$phone. '!'. $selectedGroup. "\n";
    echo $result , PHP_EOL;
    file_put_contents('data.txt', $result, FILE_APPEND);
    echo 'Запис';
}

?>
<a href="index.php">Списък</a>

<form method = "POST">

	<div> Име:<input type="text" name="username" /> </div>
	<div> Телефон<input type="text" name="phone" /> </div>
	<div>
		<select name="group">
 <?php 
 foreach ($groups as $key => $values) { echo '<option value = "' .$key. '">' .$values. '</option>'; }
 ?>
 
		</select> 
	</div>
	<div> <input type="submit" name="Добави"></div>
	</form>

<?php 
include './includes/footer.php';
?>