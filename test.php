<?php

session_start();

// Initialize teams and individuals arrays
if (!isset($_SESSION['teams'])) {
    $_SESSION['teams'] = [];
}
if (!isset($_SESSION['individuals'])) {
    $_SESSION['individuals'] = [];
}

$team_name = trim($_POST['team_name']);
$member_count = intval($_POST['member_count']);

if ($team_name && $member_count == 4) {
    // Register team
    if (count($_SESSION['teams']) < 5) {
        $_SESSION['teams'][] = ['name' => $team_name, 'members' => 4, 'score' => 0];
        header("Location: index.html#quiz-section");
    } else {
        echo "Maximum of 5 teams allowed!";
    }
} elseif (empty($team_name)) {
    // Register individual
    if (count($_SESSION['individuals']) < 20) {
        $_SESSION['individuals'][] = ['name' => 'Player ' . (count($_SESSION['individuals']) + 1), 'score' => 0];
        header("Location: index.html#quiz-section");
    } else {
        echo "Maximum of 20 individual players allowed!";
    }
} else {
    echo "Invalid registration!";
}

session_start();

// Simulated correct answers
$correct_answers = [
    'q1' => '11',
    'q2' => 'Michael Phelps'
];

// Check submitted answers
$score = 0;
if ($_POST['q1'] == $correct_answers['q1']) {
    $score++;
}
if ($_POST['q2'] == $correct_answers['q2']) {
    $score++;
}

// Add score to the last registered participant (team or individual)
if (!empty($_SESSION['teams'])) {
    $last_team_index = count($_SESSION['teams']) - 1;
    $_SESSION['teams'][$last_team_index]['score'] = $score;
} elseif (!empty($_SESSION['individuals'])) {
    $last_individual_index = count($_SESSION['individuals']) - 1;
    $_SESSION['individuals'][$last_individual_index]['score'] = $score;
}

// Redirect to the scoreboard
header("Location: scoreboard.php");

session_start();

echo "<h2>Scoreboard</h2>";
echo "<ul>";

foreach ($_SESSION['teams'] as $team) {
    echo "<li>Team {$team['name']}: {$team['score']} points</li>";
}

foreach ($_SESSION['individuals'] as $individual) {
    echo "<li>{$individual['name']}: {$individual['score']} points</li>";
}

"</ul>";
include("test.html");
include("test.css");
include("sc.js");


?>