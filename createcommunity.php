<?php
include 'core/init.php';
include 'includes/overall/header.php';

if (empty($_POST) === false) {
	$required_fields = array('name');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'You must fill out the required fields';
			break 1;
		}
	}
	
	
	if (empty($errors) === true) {
		if (community_exists($_POST['name']) === true) {
			$errors[] = 'Sorry, the community \'' . $_POST['name'] . '\' already exists';
			
		}
	}
}


if (isset($_GET['s']) === true && empty($_GET['s']) === true) {
	echo 'Community Created!';
} else {
	
	
	if (empty($_POST) === false && empty($errors) === true) {
		
		
			$data = array(
				'name' 		=> $_POST['name'],
				'state' 		=> $_POST['state']
			);
	
			create_community($data);
			header('Location: createcommunity.php?s');
			exit();
					
	}else if (empty($errors) === false) {
	
		echo output_errors($errors);
	}
	

?>


<form action="" method="post">
	
	<ul>
		
		<li>
			
			Community Name:<input type= 'text' name = 'name'>
			
		</li>
		<li>
		
			State:<select name="state"> 
			<option value="" selected="selected">Select a State</option> 
			<option value="AL">Alabama</option> 
			<option value="AK">Alaska</option> 
			<option value="AZ">Arizona</option> 
			<option value="AR">Arkansas</option> 
			<option value="CA">California</option> 
			<option value="CO">Colorado</option> 
			<option value="CT">Connecticut</option> 
			<option value="DE">Delaware</option> 
			<option value="DC">District Of Columbia</option> 
			<option value="FL">Florida</option> 
			<option value="GA">Georgia</option> 
			<option value="HI">Hawaii</option> 
			<option value="ID">Idaho</option> 
			<option value="IL">Illinois</option> 
			<option value="IN">Indiana</option> 
			<option value="IA">Iowa</option> 
			<option value="KS">Kansas</option> 
			<option value="KY">Kentucky</option> 
			<option value="LA">Louisiana</option> 
			<option value="ME">Maine</option> 
			<option value="MD">Maryland</option> 
			<option value="MA">Massachusetts</option> 
			<option value="MI">Michigan</option> 
			<option value="MN">Minnesota</option> 
			<option value="MS">Mississippi</option> 
			<option value="MO">Missouri</option> 
			<option value="MT">Montana</option> 
			<option value="NE">Nebraska</option> 
			<option value="NV">Nevada</option> 
			<option value="NH">New Hampshire</option> 
			<option value="NJ">New Jersey</option> 
			<option value="NM">New Mexico</option> 
			<option value="NY">New York</option> 
			<option value="NC">North Carolina</option> 
			<option value="ND">North Dakota</option> 
			<option value="OH">Ohio</option> 
			<option value="OK">Oklahoma</option> 
			<option value="OR">Oregon</option> 
			<option value="PA">Pennsylvania</option> 
			<option value="RI">Rhode Island</option> 
			<option value="SC">South Carolina</option> 
			<option value="SD">South Dakota</option> 
			<option value="TN">Tennessee</option> 
			<option value="TX">Texas</option> 
			<option value="UT">Utah</option> 
			<option value="VT">Vermont</option> 
			<option value="VA">Virginia</option> 
			<option value="WA">Washington</option> 
			<option value="WV">West Virginia</option> 
			<option value="WI">Wisconsin</option> 
			<option value="WY">Wyoming</option>
		</li>
</select>
	<li>

<input type = 'submit'>
	</li>

	</ul>

</form>

<?php 

}
include 'includes/overall/footer.php'; ?>