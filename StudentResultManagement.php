HTML CODE

<!DOCTYPE html>
<html>
<head>
	<title>Student Result Management System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<h1>Student Result Management System</h1>
		<form action="process.php" method="POST">
			<label for="name">Student Name:</label>
			<input type="text" id="name" name="name" required>
			<br>
			<label for="roll">Roll Number:</label>
			<input type="text" id="roll" name="roll" required>
			<br>
			<label for="maths">Maths:</label>
			<input type="number" id="maths" name="maths" min="0" max="100" required>
			<br>
			<label for="science">Science:</label>
			<input type="number" id="science" name="science" min="0" max="100" required>
			<br>
			<label for="english">English:</label>
			<input type="number" id="english" name="english" min="0" max="100" required>
			<br>
			<input type="submit" value="Submit">
		</form>
	</div>

	<script src="script.js"></script>
</body>
</html>

STYLE.CSS

.container {
	max-width: 500px;
	margin: 0 auto;
}

h1 {
	text-align: center;
}

form {
	display: flex;
	flex-direction: column;
	align-items: center;
}

label {
	margin-bottom: 10px;
}

input[type="text"],
input[type="number"],
input[type="submit"] {
	padding: 5px;
	margin-bottom: 10px;
	width: 100%;
	box-sizing: border-box;
}

input[type="submit"] {
	background-color: #4CAF50;
	color: white;
	border: none;
	cursor: pointer;
}

SCRIPT.JS

// Prevent form submission if any input is invalid
const form = document.querySelector('form');
form.addEventListener('submit', (event) => {
    const inputs = event.target.querySelectorAll('input');
    let isFormValid = true;
    for (const input of inputs) {
        if (!input.checkValidity()) {
            isFormValid = false;
            break;
        }
    }
    if (!isFormValid) {
        event.preventDefault();
    }
});

// Show message after form submission
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.get('result') === 'success') {
    const message = document.createElement('p');
    message.textContent = 'Result submitted successfully.';
    message.style.color = 'green';
    form.appendChild(message);
}
else if (urlParams.get('result') === 'error') {
    const message = document.createElement('p');
    message.textContent = 'There was an error submitting the result.';
    message.style.color = 'red';
    form.appendChild(message);
}

PROCESS.PHP

<?php
// Retrieve form data
$name = $_POST['name'];
$roll = $_POST['roll'];
$maths = $_POST['maths'];
$science = $_POST['science'];
$english = $_POST['english'];

// Calculate total and percentage
$total = $maths + $science + $english;
$percentage = round($total / 3, 2);

// Connect to database
$servername = "localhost";
$username = "username";
