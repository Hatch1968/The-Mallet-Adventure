<html>
<head>
<title>MSSS - Mallet Scholarsbowl Submittal System</title>


<style type="text/css">
h1 {color: #0054a6}

label {font-weight:bold}

input, select
{
background: #ADD8E6;
border: 1px solid #781351;
}

textarea
{
background: #ADD8E6;
border: 1px solid #781351;
}

.button {
	color: #000;
    border: 1px solid #006;
    background: #808080;
}

</style>
</head>
<body>

<?php
$output_form = false;
$question_text = false;
$answer_text = false;
$submitter_text = false;

if (isset($_POST['question']) && !empty($_POST['question']))
{
	$question_text = true;
	$question = $_POST['question'];
	$question = substr($question, 0, 749);
	$question = htmlentities($question);
}

if (isset($_POST['answer']) && !empty($_POST['answer']))
{
	$answer_text = true;
	$answer = $_POST['answer'];
	$answer = substr($answer, 0, 79);
}

if (isset($_POST['submitter']) && !empty($_POST['submitter']))
{
	$submitter_text = true;
	$submitter = $_POST['submitter'];
	$submitter = substr($submitter, 0, 79);
}

if (($question_text) && ($answer_text) && ($submitter_text))
{

$category = $_POST['category'];
$subcat = $_POST['subcat'];
$subcat = substr($subcat, 0, 40);
$questiontype = $_POST['questiontype'];

if ($_POST['pledge'])
{
echo '<br />Thank you for your submission my good and faithful servant.';
}
else
{
echo '<br />Your loyalty is in question, but your submission will be considered at some point in time.';
}
echo '<br /><br />';

$timestamp = date(DATE_RFC822);

/*$dbc = mysqli_connect('bowldb.noontar.com', 'adminhatch', 'jackass68', 'bowldb');
if (!$dbc) {
    die('Connect Error: ' . mysqli_connect_errno());
}

$question = mysqli_real_escape_string($dbc, $question);
$answer = mysqli_real_escape_string($dbc, $answer);
$subcat = mysqli_real_escape_string($dbc, $subcat);
$submitter = mysqli_real_escape_string($dbc, $submitter);

$query = "INSERT INTO questions VALUES (0, '$question', '$answer', '$category', '$subcat', '$questiontype', '$submitter', '$timestamp', '', '', '', '')";

if (!mysqli_query($dbc, $query)) {
        printf("Error: %s\n", mysqli_error($dbc));
		echo "<br /><br />";
    }


mysqli_close($dbc);	
*/	
echo '<a href="input.php">I wish to Submit Again</a>';
}
else
{
?>

<h1>Mallet Scholarsbowl Submittal System</h1>
<?php
$dbc = mysqli_connect('bowldb.noontar.com', 'adminhatch', 'jackass68', 'bowldb');
if (!$dbc) {
    die('Connect Error: ' . mysqli_connect_errno());
}

$query = "SELECT count(*) FROM `questions`";

$total = mysqli_query($dbc, $query);	
$total = mysqli_fetch_array($total);

mysqli_close($dbc);	
echo '<b><a href="stats.php">' . $total[0] . '</a></b> questions have been submitted so far. <br /><br />'; 	

?>

<form method="post" action="input.php">

<label for="question">Question</label>
<?php
	if (isset($_POST['question']) && empty($_POST['question']))
	{
		echo '<span style="font-size:80%; color:red;"> Please enter text for the Question field.</span>';
	}
	
	echo '<br /><textarea id="question" name="question" rows="4" cols="60">'. $question . '</textarea><br />';
?>



<label for="answer">Answer</label>
<?php
	if (isset($_POST['answer']) && empty($_POST['answer']))
	{
		echo '<span style="font-size:80%; color:red;"> Please enter text for the Answer field.</span>';
	}
	
	echo '<br /><input type="text" id="answer" name="answer" size="80" value="'. $answer . '" /><br /><br />';
?>

<label for="category">Category</label><br />
<select id="category" name="category">
  <option value="history">History</option>
  <option value="geography">Geography</option>
  <option value="langarts">Language Arts</option>
  <option value="finearts">Fine Arts</option>
  <option value="technology">Technology</option>
  <option value="mathematics">Mathematics</option>
  <option value="literature">Literature</option>
  <option value="science">Science</option>
  <option value="currentevents">Current Events</option>
  <option value="relphileco">Religion/Philosophy/Economics</option>
</select><br />

<label for="subcat">Sub-Category</label><br />
<input type="text" id="subcat" name="subcat" size="40" /> (Optional)<br /><br />

<label for="questiontype">Question Type</label><br />
<select id="questiontype" name="questiontype">
  <option value="quicktossup">Quick Tossup</option>
  <option value="tossup">Tossup</option>
  <option value="bonus">Bonus</option>
  <option value="supertossup">Super Tossup</option>
  <option value="worksheet">Worksheet</option>
</select><br /><br />

<label for="submitter">Submitter</label>
<?php
	if (isset($_POST['submitter']) && empty($_POST['submitter']))
	{
		echo '<span style="font-size:80%; color:red;"> Please enter text for the Submitter field.</span>';
	}

echo '<br /><input type="text" id="submitter" name="submitter" size="40" value="'. $submitter . '" /> (Use name or email address.)<br />';

?>

<br />
<input type="checkbox" id="pledge" name = "pledge" />
I will to my Lord Noontar be true and faithful, and love all which he loves and shun all which he shuns.

<br /><br />
<input disabled type="submit" value="Submit" class="button" />
</form>
<?php
}
?>
</body>

</html>