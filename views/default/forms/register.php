<?php
/**
 * Elgg register form
 *
 * @package Elgg
 * @subpackage Core
 */

if (elgg_is_sticky_form('register')) {
	$values = elgg_get_sticky_values('register');

	// Add the sticky values to $vars so views extending
	// register/extend also get access to them.
	$vars = array_merge($vars, $values);

	elgg_clear_sticky_form('register');
} else {
	$values = array();
}

$password = $password2 = '';
$username = elgg_extract('username', $values, get_input('u'));
$email = elgg_extract('email', $values, get_input('e'));
$name = elgg_extract('name', $values, get_input('n'));

?>
<div class="mtm form-group">
	<label for="name"><?php echo elgg_echo('name'); ?></label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'name',
		'value' => $name,
		'autofocus' => true,
        'id' => 'name',
	));
	?>
</div>
<div class="form-group">
	<label for="email"><?php echo elgg_echo('email'); ?></label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'email',
		'value' => $email,
        'id' => 'email',
	));
	?>
</div>
<div class="form-group">
	<label for="username2"><?php echo elgg_echo('username'); ?></label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'username',
		'value' => $username,
        'id' => 'username2',
	));
	?>
</div>
<div class="form-group">
	<label for="password1"><?php echo elgg_echo('password'); ?></label><br />
	<?php
	echo elgg_view('input/password', array(
		'name' => 'password',
		'value' => $password,
        'id' => 'password1',
	));
	?>
</div>
<div class="form-group">
	<label for="password2"><?php echo elgg_echo('passwordagain'); ?></label><br />
	<?php
	echo elgg_view('input/password', array(
		'name' => 'password2',
		'value' => $password2,
        'id' => 'password2',
	));
	?>
</div>

<?php
// view to extend to add more fields to the registration form
echo elgg_view('register/extend', $vars);

// Add captcha hook
echo elgg_view('input/captcha', $vars);

echo '<div class="elgg-foot">';
echo elgg_view('input/hidden', array('name' => 'friend_guid', 'value' => $vars['friend_guid']));
echo elgg_view('input/hidden', array('name' => 'invitecode', 'value' => $vars['invitecode']));
echo elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('register')));
echo '</div>';
