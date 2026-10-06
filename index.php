<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<?php
	    $db = new SQLite3("players.db");
		$db->exec ("
			CREATE TABLE IF NOT EXISTS player (
				id INTEGER PRIMARY KEY AUTOINCREMENT,
				name TEXT,
				score INTEGER,
				created_at DATETIME
			)
		");

		$player_count = $db->querySingle("SELECT COUNT(*) FROM player");
		
		if ($player_count == 0) {
			$db->exec ("INSERT INTO player (name, score, created_at) VALUES ('VaporShift','2320','2023-06-23 10:45:20')");
			$db->exec ("INSERT INTO player (name, score, created_at) VALUES ('Aethelgard','1850','2026-07-12 10:02:60')");
			$db->exec ("INSERT INTO player (name, score, created_at) VALUES ('NullPointer','1675','2022-09-30 10:10:08')");
			$db->exec ("INSERT INTO player (name, score, created_at) VALUES ('ObsidianEcho','1520','2023-02-14 10:30:03')");
			$db->exec ("INSERT INTO player (name, score, created_at) VALUES ('KineticVoid','1400','2021-01-21 10:53:12')");
		}
		echo "<h4>Sort By:</h4>";
		echo "<button onclick=\"sortScores('Highest Score')\">Highest Score</button>";
		echo "<button onclick=\"sortScores('Most Recent')\">Most Recent</button>";
		echo "<button onclick=\"sortScores('Oldest')\">Oldest</button>";
		echo "<button onclick=\"sortScores('Player Name')\">Player Name</button>";

		$queryStuff = isset($_GET['q']) ? $_GET['q'] : "SELECT * FROM player ORDER BY score DESC";
		$result = $db->query ($queryStuff); 
		echo "<table border='1'>";
		echo"<tr> <th>Name</th> <th>Score</th> <th>Created At</th> </tr>";
		while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
			echo "<tr>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['score'] . "</td>";
			echo "<td>" . $row['created_at'] . "</td>";
			echo "</tr>"; 
		}
		echo "</table>";

		$db->close ();
	?>

	<script>
	var sorting = '';
    function sortScores (buttonType) {
    	if (buttonType == "Highest Score"){
			sorting = "SELECT * FROM player ORDER BY score DESC";
			console.log ("button1");
		}
		if (buttonType == "Most Recent"){
			sorting = "SELECT * FROM player ORDER BY created_at DESC";
			console.log ("button2");
		}
		if (buttonType == "Oldest"){
			sorting = "SELECT * FROM player ORDER BY created_at ASC";
			console.log ("button3");
		}
		if (buttonType == "Player Name"){
			sorting = "SELECT * FROM player ORDER BY name ASC";
			console.log ("button4");
		}

		window.location.href = '?q=' + encodeURIComponent(sorting);
	}
    </script>
</body>
</html>
